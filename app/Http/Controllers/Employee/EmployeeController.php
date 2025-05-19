<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Resume;
use Illuminate\Http\Request;
use App\Models\EmployeeApplication;
use App\Models\Hiring;
use App\Models\EmployeeBookmark;
use App\Mail\WebsiteMailController; // The WebMail class for sending emails
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Illuminate\Support\Str;
use Orhanerday\OpenAi\OpenAi;

class EmployeeController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('employee'); // <-- Gọi đúng ở đây
//    }

    public function index()
    {
        /** @var \App\Models\Employee $employee */
        $employee = Auth::guard('employee')->user()->employee;

        // Nếu vì lý do nào đó user không có bản ghi employee, xử lý lỗi
        if (!$employee) {
            abort(404, 'Không tìm thấy hồ sơ nhân viên');
        }

        $employeeId = $employee->id;

        $appliedJobs = EmployeeApplication::where('employee_id', $employeeId)->count();
        $bookmarkedJobs = EmployeeBookmark::where('employee_id', $employeeId)->count();
        $approvedJobs = EmployeeApplication::where('employee_id', $employeeId)
            ->where('status', 'approved')->count();
        $rejectedJobs = EmployeeApplication::where('employee_id', $employeeId)
            ->where('status', 'rejected')->count();

        return view('employee.dashboard', compact(
            'appliedJobs',
            'bookmarkedJobs',
            'approvedJobs',
            'rejectedJobs'
        ));
    }


    public function apply($id)
    {
        $userId = Auth::guard('employee')->user()->id;

        // Lấy employee thông qua user_id
        $employee = Employee::where('user_id', $userId)->first();
        if (!$employee) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhân viên.');
        }

        $employeeId = $employee->id;

        // Kiểm tra đã apply chưa
        $applicationCheck = EmployeeApplication::where('employee_id', $employeeId)
            ->where('hiring_id', $id)
            ->exists();

        if ($applicationCheck) {
            return redirect()->back()->with('error', 'Bạn đã Apply tin tuyển dụng này trước đó rồi.');
        }

        $jobDetails = Hiring::find($id);
        $employeeUser = $employee->user ?? null;

        // Lấy danh sách các CVs đã upload
        $resumes = Resume::where('employee_id', $employee->id)->get();

        return view('Frontend.application', compact('id', 'jobDetails', 'employee', 'employeeUser', 'resumes'));
    }



    public function applyConfirm(Request $request)
    {
        $request->validate([
            'resume_id' => 'required|exists:resumes,id',
            'hiring_id' => 'required|exists:hirings,id',
            'cover_letter' => 'nullable|string',
        ]);

        $userId = Auth::guard('employee')->user()->id;

        // Lấy đúng employee_id từ bảng employees
        $employee = Employee::where('user_id', $userId)->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhân viên.');
        }

        $employeeId = $employee->id;

        // Kiểm tra nếu đã ứng tuyển rồi
        $alreadyApplied = EmployeeApplication::where('employee_id', $employeeId)
            ->where('hiring_id', $request->hiring_id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'Bạn đã ứng tuyển vào tin tuyển dụng này trước đó.');
        }

        // Tạo ứng tuyển mới
        $application = new EmployeeApplication();
        $application->employee_id = $employeeId;
        $application->hiring_id = $request->hiring_id;
        $application->resume_id = $request->resume_id;
        $application->cover_letter = $request->cover_letter;
        $application->status = 'pending';
        $application->similarityScore = 0;
        $application->save();

        return redirect()->route('employee.dashboard')->with('success', 'Ứng tuyển thành công!');
    }

    public function addBookmark($id)
    {
        $user = Auth::guard('employee')->user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin tài khoản nhân viên.');
        }

        $existing = EmployeeBookmark::where('employee_id', $employee->id)
            ->where('hiring_id', $id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Công việc đã được lưu trước đó.');
        }

        EmployeeBookmark::create([
            'employee_id' => $employee->id,
            'hiring_id' => $id,
        ]);

        return redirect()->back()->with('success', 'Đã lưu công việc thành công.');
    }



    public function checkBookmark(Request $request)
    {

        $userId = Auth::guard('employee')->id();
        $employee = Employee::where('user_id', $userId)->firstOrFail();
        $employeeId = $employee->id;

        $query = EmployeeBookmark::with(['hiring.jobType'])
            ->where('employee_id', $employeeId);

        if ($request->filled('job_type')) {
            $query->whereHas('hiring.jobType', function ($q) use ($request) {
                $q->where('name', $request->job_type);
            });
        }

        $perPageOptions = [20, 30, 40, 50, 100, 250];
        $perPage = $request->input('per_page', 20);

        $bookmarks = $query->paginate($perPage);

        $jobTypes = \App\Models\JobType::pluck('name');
        return view('employee.bookmarks', compact('bookmarks', 'jobTypes', 'perPageOptions'));
    }


    public function deleteBookmark($id)
    {
        $userId = Auth::guard('employee')->id();

        $employee = Employee::where('user_id', $userId)->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhân viên.');
        }

        $bookmark = EmployeeBookmark::where('employee_id', $employee->id)
            ->where('id', $id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return redirect()->back()->with('success', 'Đã xóa bookmark thành công');
        }

        return redirect()->back()->with('error', 'Không tìm thấy bookmark');
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $employee = Employee::where('user_id', $user->id)->firstOrFail();
        $locations = Location::all();
        return view('employee.updateprofile', compact('employee','locations'));
    }

    public function updateProfileConfirm(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $employee = Employee::where('user_id', $user->id)->firstOrFail();
        $locations = Location::all();

        $request->validate([
            "firstname" => "required|string|max:255",
            "lastname" => "required|string|max:255",
            "phone" => "nullable|numeric|digits_between:9,10",
            "address" => "nullable|string|max:255",
            "gender" => "nullable|in:male,female,other",
            "date_of_birth" => "nullable|date",
            "designation" => "nullable|string|max:255",
            "location_id" => "nullable|exists:locations,id",
            "photo" => "nullable|image|mimes:jpg,jpeg,png,gif|max:2048"
        ]);

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                $oldPhotoPath = public_path('uploads/employees/'.$employee->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $randomString = bin2hex(random_bytes(16));
            $hash = hash('sha256', $randomString);
            $ext = $request->file('photo')->extension();
            $finalName = $hash.'_userphoto.'.$ext;

            $request->file('photo')->move(public_path('uploads/employees/'), $finalName);
            $employee->photo = $finalName;
        }

        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->gender = $request->gender;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->bio = $request->bio;
        $employee->designation = $request->designation;
        $employee->location_id = $request->location_id;

        $employee->update();

        return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công !');
    }


    public function updateProfileSocial(Request $request)
    {
        $request->validate([
            "website" => "nullable|url",
            "facebook" => "nullable|url",
            "instagram" => "nullable|url",
            "github" => "nullable|url",
        ]);

        $employee = Employee::where('user_id', Auth::guard('employee')->user()->id)->firstOrFail();

        $employee->website = $request->website;
        $employee->facebook = $request->facebook;
        $employee->instagram = $request->instagram;
        $employee->github = $request->github;

        $employee->update();

        return redirect()->back()->with('success', 'Cập nhật các liên kết xã hội thành công !');
    }


    public function terminateEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $user = $employee->user;

        // Cập nhật thông tin bảng employees
        $employee->update([
            'firstname' => 'Deleted',
            'lastname' => 'User',
            'designation' => null,
            'photo' => null,
            'website' => null,
            'token' => null,
            'phone' => null,
            'address' => null,
            'gender' => null,
            'date_of_birth' => null,
            'bio' => null,
            'facebook' => null,
            'instagram' => null,
            'github' => null,
            'isDeleted' => 1,
        ]);

        // Cập nhật thông tin bảng users (ẩn email và username, vô hiệu hóa tài khoản)
        $user->update([
            'username' => 'deleted_' . Str::random(5),
            'email' => Str::random(10) . '@deleted.com',
            'status' => 'inactive', // hoặc 'banned' nếu cần
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        // Đăng xuất và chuyển hướng
        Auth::guard('employee')->logout();

        return redirect()->route('employee.signin')->with('success', 'Tài khoản đã được xóa thành công.');
    }
}
