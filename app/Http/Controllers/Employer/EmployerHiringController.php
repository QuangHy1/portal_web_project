<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Mail\ApproveApplicationMail;
use App\Models\BoostedJob;
use App\Models\BoostOrder;
use App\Models\Employer;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Hiring;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\SalaryRange;
use App\Models\Location;
use App\Models\Experience;
use App\Models\Vacancy;
use App\Models\EmployeeApplication;
use Illuminate\Support\Facades\Auth;
use App\Mail\WebsiteMailController; // The WebMail class for sending emails
use Illuminate\Support\Facades\DB;
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
        $vacancies = Vacancy::all();
        return view('employer.addHiring', compact('JobCategory', 'JobType', 'Location', 'SalaryRange', 'Experience', 'vacancies'));
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
            'gender' => 'required|string|in:Nam,Nữ,Không yêu cầu (All gender)',
            'vacancy_id' => 'required|exists:vacancies,id',
//            'status' => 'required',
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
        $hiring->job_category_id = $request->category;
        $hiring->job_type_id = $request->type;
        $hiring->experience_id = $request->experience;
        $hiring->education = $request->education;
        $hiring->gender = $request->gender;
        $hiring->vacancy_id = $request->vacancy_id;
        $hiring->deadline = $request->deadline;
        // Xử lý status dựa vào deadline
        $deadlineDate = Carbon::parse($request->deadline);
        $status = $deadlineDate->lt(Carbon::now()) ? 'inactive' : 'active';
        $hiring->status = $status;

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

    public function destroy($id)
    {
        $user = Auth::guard('employer')->user();
        $employer = $user->employer;

        $hiring = Hiring::where('id', $id)->where('employer_id', $employer->id)->first();

        if (!$hiring) {
            return redirect()->back()->with('error', 'Không tìm thấy tin tuyển dụng.');
        }

        $hiring->delete();

        return redirect()->back()->with('success', 'Đã xóa tin tuyển dụng thành công.');
    }

//    public function viewDatas()
//    {
//        $user = Auth::guard('employer')->user();
//
//        // Lấy thông tin employer tương ứng với user đang đăng nhập
//        $employer = Employer::where('user_id', $user->id)->first();
//
//        // Nếu không tìm thấy employer thì có thể redirect hoặc thông báo lỗi
//        if (!$employer) {
//            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
//        }
//
//        // Lấy tất cả các hiring thuộc employer đó
//        $hirings = Hiring::where('employer_id', $employer->id)->get();
//
//        // Đếm số đơn ứng tuyển cho từng hiring
//        $applications = EmployeeApplication::all(); // Collection
//        foreach ($hirings as $hiring) {
//            $applications[$hiring->id] = EmployeeApplication::where('hiring_id', $hiring->id)->count();
//        }
//
//        // Trả về đúng view
//        return view('employer.boost', [
//            'hirings' => $hirings,
//            'applications' => $applications,
//        ]);
//    }

    public function viewDatas()
    {
        $user = Auth::guard('employer')->user();
        $employer = Employer::where('user_id', $user->id)->first();

        if (!$employer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
        }

        // ✅ RESET BOOST NẾU HẾT HẠN
        $expiredBoosts = BoostedJob::where('employer_id', $employer->id)
            ->where('expires_at', '<', now())
            ->get();

        foreach ($expiredBoosts as $boost) {
            $hiring = Hiring::find($boost->hiring_id);
            if ($hiring && $hiring->isBoosted == 'yes') {
                $hiring->isBoosted = 'no';
                $hiring->save();
            }

            // ✅ Xoá ngày boost để view không hiển thị nữa
            $boost->boosted_at = null;
            $boost->expires_at = null;
            $boost->save();
        }

        // Dữ liệu như cũ
        $hirings = Hiring::where('employer_id', $employer->id)->get();
        $applications = [];
        foreach ($hirings as $hiring) {
            $applications[$hiring->id] = EmployeeApplication::where('hiring_id', $hiring->id)->count();
        }

        $totalBoosts = BoostOrder::where('employer_id', $employer->id)
            ->where('isActive', 1)
            ->join('packages', 'boost_orders.package_id', '=', 'packages.id')
            ->sum('packages.jobs_count');

        $activeBoostOrder = BoostOrder::where('employer_id', $employer->id)
            ->where('isActive', 1)
            ->orderBy('created_at', 'desc')
            ->with('package')
            ->first();

        $usedBoosts = Hiring::where('employer_id', $employer->id)
            ->where('isBoosted', 'yes')
            ->count();

        $remainingBoosts = max($totalBoosts - $usedBoosts, 0);

        return view('employer.boost', [
            'hirings' => $hirings,
            'applications' => $applications,
            'totalBoosts' => $totalBoosts,
            'usedBoosts' => $usedBoosts,
            'remainingBoosts' => $remainingBoosts,
            'activeBoostOrder' => $activeBoostOrder,
        ]);
    }
    public function boostData($id)
    {
        $packages = Package::all(); // nếu không có cột status
        $hiring = Hiring::with('employer.company', 'company')->where('id', $id)->first();
        $applications = EmployeeApplication::all();
        return view('employer.boostpurchase', compact('packages','hiring', 'applications'));
    }
    public function boostPurchase()
    {
        $packages = Package::all(); // nếu không có cột status
        return view('employer.boostpurchase', compact('packages'));
    }

    public function boostNow($id)
    {
        $hiring = Hiring::findOrFail($id);

        // Không cho boost nếu tin đã hết hạn (status = inactive)
        if ($hiring->status === 'inactive') {
            return redirect()->back()->with('error', 'Không thể boost tin tuyển dụng đã hết hạn.');
        }

        $employer = Auth::guard('employer')->user()->employer;

        $boostOrder = BoostOrder::where('employer_id', $employer->id)
            ->whereColumn('used', '<', DB::raw('(SELECT jobs_count FROM packages WHERE packages.id = boost_orders.package_id)'))
            ->where('isActive', 1)
            ->orderBy('id')
            ->first();

        if (!$boostOrder) {
            return redirect()->back()->with('error', 'Bạn không còn lượt boost.');
        }

        $expiresAt = $boostOrder->date_expired;

        $hiring->isBoosted = 'yes';
        $hiring->save();

        BoostedJob::create([
            'hiring_id' => $hiring->id,
            'employer_id' => $employer->id,
            'boost_order_id' => $boostOrder->id,
            'boosted_at' => now(),
            'expires_at' => $expiresAt,
        ]);

        $boostOrder->used += 1;
        $boostOrder->save();

        return redirect()->back()->with('success', 'Tin đã được boost thành công.');
    }


    public function revertBoost($id)
    {
        $hiring = Hiring::findOrFail($id);

        // Kiểm tra trạng thái boost hiện tại
        if ($hiring->isBoosted == 'no') {
            return redirect()->back()->with('error', 'Tin tuyển dụng này chưa được boost.');
        }

        // Hoàn tác trạng thái Boost
        $hiring->isBoosted = 'no';
        $hiring->save();

        // Xoá record boosted_jobs tương ứng
        $boostedJob = BoostedJob::where('hiring_id', $id)->latest()->first();
        if ($boostedJob) {
            // Cập nhật lại số lượt boost đã sử dụng trong boost_order
            $boostOrder = BoostOrder::find($boostedJob->boost_order_id);
            if ($boostOrder) {
                $boostOrder->used -= 1;  // Giảm số lượt sử dụng
                $boostOrder->save();
            }
            // Xoá bản ghi boosted_jobs
            $boostedJob->delete();
        }

        return redirect()->back()->with('success', 'Hoàn tác boost thành công.');
    }




    public function editData($id)
    {
        $hiring = Hiring::find($id);
        $JobType = JobType::all();
        $SalaryRange = SalaryRange::all();
        $Experience = Experience::all();
        $Location = Location::all();
        $JobCategory = JobCategory::all();
        $vacancies = Vacancy::all();
        return view('employer.editHiring', compact('hiring', 'JobCategory', 'JobType', 'Location', 'SalaryRange', 'Experience','vacancies'));
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
            'vacancy_id' => 'required|exists:vacancies,id',
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
        $hiring->vacancy_id = $request->vacancy_id;
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

        $employee = $hiringsApplications->employee;             // Model Employee
        $user = $employee->user;                                // Model User (lấy email)
        $hiring = $hiringsApplications->hiring;                 // Model Hiring
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
            <p>Bên tuyển dụng tại <strong>$companyName</strong> chúng tôi sẽ sắp xếp một buổi phỏng vấn sớm nhất. Trân trọng</p>
            <p>Hãy <a href='$loginUrl' style='color: #2ab463;'>đăng nhập</a> để xem thêm chi tiết.</p>
        ";

        Mail::to($email)->send(
            new ApproveApplicationMail($employeeName, $jobTitle, $companyName, $loginUrl, $body)
        );

        return redirect()->back()->with('success', 'Đã duyệt đơn thành công!');
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

        $employee = $hiringsApplications->employee;             // Model Employee
        $user = $employee->user;                                // Model User (lấy email)
        $hiring = $hiringsApplications->hiring;                 // Model Hiring
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

        return redirect()->back()->with('success', 'Đã từ chối đơn thành công!');
    }

}
