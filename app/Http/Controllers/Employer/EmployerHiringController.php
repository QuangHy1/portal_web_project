<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\Hiring;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\SalaryRange;
use App\Models\Location;
use App\Models\Experience;
use App\Models\EmployeeApplication;
use Illuminate\Support\Facades\Auth;
use App\Mail\WebsiteMailController; // The WebMail class for sending emails
use Illuminate\Support\Facades\Mail;

class EmployerHiringController extends Controller
{
    public function index(Request $request)
    {
        $JobType = JobType::all();
        $SalaryRange = SalaryRange::all();
        $Experience = Experience::all();
        $Location = Location::all();
        $JobCategory = JobCategory::all();
        return view('employer.addHiring', compact('JobCategory', 'JobType', 'Location', 'SalaryRange', 'Experience'));
    }

    public function addData(Request $request)
    {
        /** @var \App\Models\Employer $employer */
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required', // this maps to location_id
            'salary' => 'required', // this maps to salary_range_id
            'tags' => 'required',
            'deadline' => 'required',
            'category' => 'required', // job_category_id
            'type' => 'required', // job_type_id
            'experience' => 'required', // experience_id
            'education' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'token' => 'required',
            // 'fields.*' => 'required', // Optional: used for dynamic requirement fields. Not necessary since Requirement model not used.
        ]);

        // Lấy user đang đăng nhập
        $user = Auth::guard('employer')->user();

        // Tìm employer từ bảng `employers` theo user_id
        $employer = Employer::where('user_id', $user->id)->first();

        if (!$employer) {
            return redirect()->back()->withErrors(['employer' => 'Không tìm thấy thông tin nhà tuyển dụng.']);
        }

        $hiring = new Hiring();
        $hiring->title = $request->title;
        $hiring->description = $request->description;
        $hiring->location_id = $request->location;
        $hiring->salary_range_id = $request->salary;
        $hiring->tags = $request->tags;
        $hiring->deadline = $request->deadline;
        $hiring->job_category_id = $request->category;
        $hiring->job_type_id = $request->type;
        $hiring->experience_id = $request->experience;
        $hiring->education = $request->education;
        $hiring->gender = $request->gender;
        $hiring->status = $request->status;
        $hiring->token = $request->token;

        $hiring->employer_id = $employer->id; // đúng employer_id
        $hiring->company_id = $employer->company_id;

        $hiring->save();

        return redirect()->route('employer.hiring.view')->with('success', 'Tạo mới Tin Tuyển Dụng thành công !');
    }

    public function viewData(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('employer')->user();  // Đối tượng user, không phải employer

        /** @var \App\Models\Employer $employer */
        $employer = $user->employer; // Truy xuất thông tin employer từ quan hệ

        // Kiểm tra có thông tin employer không
        if (!$employer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin Employer.');
        }

        // Lấy danh sách tin đăng của employer này
        $hiring = Hiring::where('employer_id', $employer->id)->get();

        // Lấy tất cả đơn ứng tuyển (bạn có thể lọc theo nhu cầu)
        $applications = EmployeeApplication::all();

        return view('employer.listHiring', [
            'hiring' => $hiring,
            'applications' => $applications,
            'employerId' => $employer->id
        ]);
    }

    public function viewDatas()
    {
        $user = Auth::guard('employer')->user();

        // Lấy thông tin employer tương ứng với user đang đăng nhập
        $employer = Employer::where('user_id', $user->id)->first();

        // Nếu không tìm thấy employer thì có thể redirect hoặc thông báo lỗi
        if (!$employer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
        }

        // Lấy tất cả các hiring thuộc employer đó
        $hirings = Hiring::where('employer_id', $employer->id)->get();

        // Đếm số đơn ứng tuyển cho từng hiring
        $applications = EmployeeApplication::all(); // Collection
        foreach ($hirings as $hiring) {
            $applications[$hiring->id] = EmployeeApplication::where('hiring_id', $hiring->id)->count();
        }

        // Trả về đúng view
        return view('employer.boost', [
            'hirings' => $hirings,
            'applications' => $applications,
        ]);
    }


    public function boostData($id)
    {
        $hiring = Hiring::with('employer.company', 'company')->where('id', $id)->first();
        $applications = EmployeeApplication::all();
        return view('employer.boostpayment', compact('hiring', 'applications'));
    }

    public function editData($id)
    {
        $hiring = Hiring::find($id);
        $JobType = JobType::all();
        $SalaryRange = SalaryRange::all();
        $Experience = Experience::all();
        $Location = Location::all();
        $JobCategory = JobCategory::all();
        return view('employer.editHiring', compact('hiring', 'JobCategory', 'JobType', 'Location', 'SalaryRange', 'Experience'));
    }

    public function updateData(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'tags' => 'required',
            'deadline' => 'required',
            'category' => 'required',
            'type' => 'required',
            'experience' => 'required',
            'education' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'token' => 'required',
        ]);

        $hiring = Hiring::where('id', $id)->first();
        $hiring->title = $request->title;
        $hiring->description = $request->description;
        $hiring->location_id = $request->location;
        $hiring->salary_range_id = $request->salary;
        $hiring->tags = $request->tags;
        $hiring->deadline = $request->deadline;
        $hiring->job_category_id = $request->category;
        $hiring->job_type_id = $request->type;
        $hiring->experience_id = $request->experience;
        $hiring->education = $request->education;
        $hiring->gender = $request->gender;
        $hiring->status = $request->status;
        $hiring->token = $request->token;
        $hiring->update();

        // if ($request->filled('fields')) {
        //     foreach ($request->fields as $field) {
        //         if ($field !== null) {
        //             $requirements = new Requirement();
        //             $requirements->requirements = $field;
        //             $requirements->token = $request->token;
        //             $requirements->save();
        //         }
        //     }
        // }

        return redirect()->route('employer.hiring.list')->with('success', 'Cập nhật Tin Tuyển Dụng thành công !');
    }

//    public function deleteDataRequirement($id)
//    {
//        // $requirements = Requirement::find($id);
//        // $requirements->delete();
//        return redirect()->back()->with('success', 'Requirement Deleted Successfully (Requirement model is currently not used).');
//    }

    public function ApproveJob($id)
    {
        $hiringsApplications = EmployeeApplication::find($id);

        // Kiểm tra nếu không tìm thấy ứng viên
        if (!$hiringsApplications) {
            return redirect()->back()->with('error', 'Ứng viên không tồn tại');
        }

        $hiringsApplications->status = "approved";
        $hiringsApplications->update();

        return redirect()->back()->with('success', 'Đã duyệt đơn thành công');
    }

    public function RejectJob($id)
    {
        $hiringsApplications = EmployeeApplication::find($id);

        // Kiểm tra nếu không tìm thấy ứng viên
        if (!$hiringsApplications) {
            return redirect()->back()->with('error', 'Ứng viên không tồn tại');
        }

        $hiringsApplications->status = "rejected";
        $hiringsApplications->update();

        // Lấy thông tin công việc (hiring)
        $hiring = $hiringsApplications->hiring;

        // Lấy thông tin nhà tuyển dụng
        $employer = $hiring->employer;

        // Lấy thông tin công ty thông qua relationship 'company' của model Employer
        $companyName = $employer->company->name ?? "Nhà tuyển dụng"; // Lấy tên công ty hoặc giá trị mặc định

        // Lấy thông tin email của ứng viên
        $useremail = $hiringsApplications->employee->user->email;

        // Gửi email thông báo từ chối
        $subject = 'Job Application Rejected';
        $message = "Xin lỗi, đơn ứng tuyển của bạn đã bị từ chối. Bạn có thể tìm công việc khác tại: " . route('job.search');
        Mail::to($useremail)->send(new WebsiteMailController($subject, $message, $companyName, 'admin.email.rejectedTemplate'));

        return redirect()->back()->with('success', 'Đã từ chối đơn thành công!');
    }

}
