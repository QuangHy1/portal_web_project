<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\EmployeeApplication;
use App\Models\Hiring;
use App\Models\BoostOrder;
use Illuminate\Support\Facades\Auth;


class EmployerController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:employer');
//    }

    public function index()
    {
        /** @var \App\Models\Employer $employer */
        $employer = Auth::guard('employer')->user()->employer;

        // Tổng số tin tuyển dụng đã đăng
        $totalJobPosted = Hiring::where('employer_id', $employer->id)->count();

        // Tổng số tin hết hạn (inactive)
        $totalExpiredJob = Hiring::where('employer_id', $employer->id)
            ->where('status', 'inactive')
            ->count();

        // Tổng số tin đang hoạt động (active)
        $totalActiveJob = Hiring::where('employer_id', $employer->id)
            ->where('status', 'active')
            ->count();

        // Tổng số tin đã được boost (isBoosted = yes)
        $totalBoostedJob = Hiring::where('employer_id', $employer->id)
            ->where('isBoosted', 'yes')
            ->count();

        // Nếu có yêu cầu thay đổi từ boost orders, tính toán lại hoặc lấy tổng từ bảng BoostOrder
        $payments = BoostOrder::where('employer_id', $employer->id)->get();

        return view('employer.dashboard', compact(
            'totalJobPosted',
            'totalExpiredJob',
            'totalActiveJob',
            'totalBoostedJob',
            'payments'
        ));
    }



    public function payment()
    {
        return view('employer.profile');
    }

    public function viewApplications()
    {
        $employer = Auth::guard('employer')->user();
        $companyId = $employer->company->id ?? null;

        $applications = EmployeeApplication::with('hiring', 'employee')
            ->whereHas('hiring', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->orderBy('similarityScore', 'desc')
            ->get();

        return view('employer.applications', compact('applications'));
    }


    public function viewApplicants($id)
    {
        $employer = Auth::guard('employer')->user(); // Lấy employer từ guard của bạn

        // Lấy employer thông qua user_id trong bảng employers
        $employerFromDb = Employer::where('user_id', $employer->id)->first();

        // Kiểm tra nếu không có employer
        if (!$employerFromDb) {
            return redirect()->route('employer.dashboard')->with('error', 'Bạn không phải là nhà tuyển dụng.');
        }

        // Kiểm tra tin tuyển dụng thuộc về employer này
        $hiring = Hiring::where('employer_id', $employerFromDb->id)->where('id', $id)->first();

        if (!$hiring) {
            return redirect()->route('employer.hiring.list')->with('error', 'Tin tuyển dụng không tồn tại hoặc bạn không phải là nhà tuyển dụng của tin này.');
        }

        // Lấy danh sách các ứng viên đã apply cho tin tuyển dụng này
        $applications = EmployeeApplication::with('employee') // Lấy thông tin ứng viên
        ->where('hiring_id', $hiring->id) // Lọc theo hiring_id
        ->get();

        return view('employer.applications', compact('applications'));
    }

    public function viewCV($id)
    {
        $application = EmployeeApplication::with('resume')->findOrFail($id);

        if (!$application->resume) {
            return redirect()->back()->with('error', 'Không tìm thấy CV.');
        }

        $resume = $application->resume;

        // CHỖ SỬA QUAN TRỌNG NHẤT
        $filePath = public_path('storage/' . $resume->file_path);

        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File CV không tồn tại.');
        }

        if ($fileType === 'pdf') {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $resume->file_name . '"',
            ]);
        }

        return response()->download($filePath, $resume->file_name);
    }
}
