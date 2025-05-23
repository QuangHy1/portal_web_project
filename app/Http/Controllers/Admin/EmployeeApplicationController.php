<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApproveApplicationMail;
use App\Mail\RejectApplicationMail;
use App\Models\EmployeeApplication;
use App\Models\Employee;
use App\Models\Hiring; // Thay Job bằng Hiring
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmployeeApplicationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $employeeApplications = EmployeeApplication::with(['employee', 'hiring', 'resume']) // Thay job bằng hiring
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('cover_letter', 'like', '%' . $keyword . '%')
                ->orWhere('status', 'like', '%' . $keyword . '%')
                ->orWhereHas('employee', function ($employeeQuery) use ($keyword) {
                    $employeeQuery->where('firstname', 'like', '%' . $keyword . '%')
                        ->orWhere('lastname', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('hiring', function ($hiringQuery) use ($keyword) { // Thay job bằng hiring
                    $hiringQuery->where('title', 'like', '%' . $keyword . '%'); // Tìm kiếm theo tiêu đề của Hiring
                });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.employee_applications.index', compact('employeeApplications', 'keyword'));
    }

    public function create()
    {
        $employees = Employee::all();
        $hirings = Hiring::all(); // Thay Job::all() bằng Hiring::all()
        $resumes = Resume::all();
        return view('admin.employee_applications.create', compact('employees', 'hirings', 'resumes')); // Truyền $hirings
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'hiring_id' => 'required|exists:hirings,id',
            'resume_id' => 'nullable|exists:resumes,id',
            'cover_letter' => 'required|string',
            'status' => 'required|string|max:255',
            'similarityScore' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $employeeApplication = EmployeeApplication::create($data);

        // Lấy thông tin liên quan
        $employee = $employeeApplication->employee()->with('user')->first();
        $hiring = $employeeApplication->hiring()->with('company')->first();

        $email = $employee->user->email;
        $employeeName = $employee->firstname . ' ' . $employee->lastname;
        $jobTitle = $hiring->title;
        $companyName = $hiring->company->name ?? 'Công ty';
        $loginUrl = route('employee.signin'); // hoặc URL bạn muốn

        // Gửi mail tùy trạng thái
        if ($data['status'] === 'approved') {
            $body = "
            <p>Xin chào <strong>$employeeName</strong>,</p>
            <p>Bạn đã ứng tuyển vào vị trí <strong>$jobTitle</strong> tại công ty <strong>$companyName</strong>.</p>
            <p>Chúc mừng! Đơn ứng tuyển của bạn đã được <span style='color: green; font-weight: bold;'>phê duyệt</span>.</p>
            <p>Hãy <a href='$loginUrl' style='color: #2ab463;'>đăng nhập</a> để xem thêm chi tiết.</p>
        ";
            Mail::to($email)->send(new ApproveApplicationMail($employeeName, $jobTitle, $companyName, $loginUrl, $body ));
        } elseif ($data['status'] === 'rejected') {
            $body = "
            <p>Xin chào <strong>$employeeName</strong>,</p>
            <p>Bạn đã ứng tuyển vào vị trí <strong>$jobTitle</strong> tại công ty <strong>$companyName</strong>.</p>
            <p>Rất tiếc! Đơn ứng tuyển của bạn đã <span style='color: red; font-weight: bold;'>không được phê duyệt</span>.</p>
            <p>Chúc bạn may mắn trong các cơ hội sắp tới.</p>
        ";
            Mail::to($email)->send(new RejectApplicationMail($employeeName, $jobTitle, $companyName, $loginUrl,$body ));
        }

        return redirect()->route('admin.employee_applications.index')->with('success', 'Tạo mới 1 đơn ứng tuyển thành công!');
    }

    public function show(EmployeeApplication $employeeApplication)
    {
        $employeeApplication = EmployeeApplication::with(['employee', 'hiring', 'resume'])->findOrFail($employeeApplication->id); // Thay job bằng hiring
        return view('admin.employee_applications.show', compact('employeeApplication'));
    }

    public function edit(EmployeeApplication $employeeApplication)
    {
        $employeeApplication = EmployeeApplication::findOrFail($employeeApplication->id);
        $employees = Employee::all();
        $hirings = Hiring::all(); // Thay Job::all() thành Hiring::all()
        $resumes = Resume::all();
        return view('admin.employee_applications.edit', compact('employeeApplication', 'employees', 'hirings', 'resumes')); // Thêm $hirings
    }

    public function update(Request $request, EmployeeApplication $employeeApplication)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'hiring_id' => 'required|exists:hirings,id',
            'resume_id' => 'nullable|exists:resumes,id',
            'cover_letter' => 'required|string',
            'status' => 'required|string|max:255',
            'similarityScore' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        // Lấy trạng thái cũ trước khi cập nhật để kiểm tra có thay đổi trạng thái không
        $oldStatus = $employeeApplication->status;

        $employeeApplication->update($data);

        // Nếu trạng thái thay đổi sang approved hoặc rejected thì gửi mail
        if ($oldStatus !== $data['status'] && in_array($data['status'], ['approved', 'rejected'])) {
            $employee = $employeeApplication->employee()->with('user')->first();
            $hiring = $employeeApplication->hiring()->with('company')->first();

            $email = $employee->user->email;
            $employeeName = $employee->firstname . ' ' . $employee->lastname;
            $jobTitle = $hiring->title;
            $companyName = $hiring->company->name ?? 'Công ty';
            $loginUrl = route('employee.signin');

            if ($data['status'] === 'approved') {
                $body = "
            <p>Xin chào <strong>$employeeName</strong>,</p>
            <p>Bạn đã ứng tuyển vào vị trí <strong>$jobTitle</strong> tại công ty <strong>$companyName</strong>.</p>
            <p>Chúc mừng! Đơn ứng tuyển của bạn đã được <span style='color: green; font-weight: bold;'>phê duyệt</span>.</p>
            <p>Hãy <a href='$loginUrl' style='color: #2ab463;'>đăng nhập</a> để xem thêm chi tiết.</p>
        ";
                Mail::to($email)->send(new ApproveApplicationMail($employeeName, $jobTitle, $companyName, $loginUrl, $body ));
            } elseif ($data['status'] === 'rejected') {
                $body = "
            <p>Xin chào <strong>$employeeName</strong>,</p>
            <p>Bạn đã ứng tuyển vào vị trí <strong>$jobTitle</strong> tại công ty <strong>$companyName</strong>.</p>
            <p>Rất tiếc! Đơn ứng tuyển của bạn đã <span style='color: red; font-weight: bold;'>không được phê duyệt</span>.</p>
            <p>Chúc bạn may mắn trong các cơ hội sắp tới.</p>
        ";
                Mail::to($email)->send(new RejectApplicationMail($employeeName, $jobTitle, $companyName, $loginUrl,$body ));
            }
        }

        return redirect()->route('admin.employee_applications.index')->with('success', 'Cập nhật 1 đơn ứng tuyển thành công!');
    }


    public function destroy(EmployeeApplication $employeeApplication)
    {
        $employeeApplication->delete();
        return redirect()->route('admin.employee_applications.index')->with('success', 'Xóa thành công 1 đơn ứng tuyển !');
    }

    public function review()
    {
        $employeeApplications = EmployeeApplication::where('status', 'pending')->with(['employee', 'hiring', 'resume'])->paginate(10);
        return view('admin.employee_applications.review', compact('employeeApplications'));
    }

    public function approve(EmployeeApplication $employeeApplication)
    {
        $employeeApplication->status = 'approved';
        $employeeApplication->save();

        $employee = $employeeApplication->employee;             // Model Employee
        $user = $employee->user;                                // Model User (lấy email)
        $hiring = $employeeApplication->hiring;                 // Model Hiring
        $company = $hiring->company;                            // Model Company

        $employeeName = $employee->firstname . ' ' . $employee->lastname;
        $jobTitle = $hiring->title;
        $companyName = $company->name;
        $loginUrl = route('employee.signin');
        $email = $user->email;

        $body = "
            <p>Xin chào <strong>$employeeName</strong>,</p>
            <p>Bạn đã ứng tuyển vào vị trí <strong>$jobTitle</strong> tại công ty <strong>$companyName</strong>.</p>
            <p>Chúc mừng! Đơn ứng tuyển của bạn đã được <span style='color: green; font-weight: bold;'>phê duyệt</span>.</p>
            <p>Hãy <a href='$loginUrl' style='color: #2ab463;'>đăng nhập</a> để xem thêm chi tiết.</p>
        ";

        Mail::to($email)->send(
            new ApproveApplicationMail($employeeName, $jobTitle, $companyName, $loginUrl, $body)
        );

        return redirect()->route('admin.employee_applications.review')
            ->with('success', 'Đơn ứng tuyển đã được duyệt.');
    }

    public function reject(EmployeeApplication $employeeApplication)
    {
        $employeeApplication->status = 'rejected';
        $employeeApplication->save();

        $employee = $employeeApplication->employee;             // Model Employee
        $user = $employee->user;                                // Model User (lấy email)
        $hiring = $employeeApplication->hiring;                 // Model Hiring
        $company = $hiring->company;                            // Model Company

        $employeeName = $employee->firstname . ' ' . $employee->lastname;
        $jobTitle = $hiring->title;
        $companyName = $company->name;
        $loginUrl = route('employee.signin');
        $email = $user->email;

        $body = "
            <p>Xin chào <strong>$employeeName</strong>,</p>
            <p>Bạn đã ứng tuyển vào vị trí <strong>$jobTitle</strong> tại công ty <strong>$companyName</strong>.</p>
            <p>Rất tiếc! Đơn ứng tuyển của bạn đã <span style='color: red; font-weight: bold;'>không được phê duyệt</span>.</p>
            <p>Chúc bạn may mắn trong các cơ hội sắp tới.</p>
        ";

        Mail::to($email)->send(
            new ApproveApplicationMail($employeeName, $jobTitle, $companyName, $loginUrl, $body)
        );

        return redirect()->route('admin.employee_applications.review')
            ->with('success', 'Đơn ứng tuyển đã bị từ chối.');
    }

}
