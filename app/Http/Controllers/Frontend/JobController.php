<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hiring;
use App\Models\EmployeeApplication;
class JobController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('frontend.singlehiring');
    }
    public function jobDetails($id)
    {
        $jobPost =  Hiring::where('id', $id)->where('status', 'active')->first();

        // $jobPost->view_count = $blogPost->view_count + 1;
        // $jobPost->update();
        $relatedJobs = Hiring::where('job_category_id', $jobPost->job_category_id)->where('id', '!=', $jobPost->id)->get()->take(3);

        return view('frontend.singlehiring', compact('jobPost', 'relatedJobs'));
    }

    public function getApplied(Request $request)
    {
        $employeeUser = auth('employee')->user();

        // Kiểm tra xem user đã đăng nhập và có liên kết với employee hay chưa
        if (!$employeeUser || !$employeeUser->employee) {
            return redirect()->route('employee.signin')->with('error', 'Bạn cần đăng nhập bằng tài khoản người dùng.');
        }

        $employeeId = $employeeUser->employee->id;

        $perPage = $request->input('per_page', 20);
        $jobTypeFilter = $request->input('job_type');

        $applicationsQuery = EmployeeApplication::with(['hiring.jobType'])
            ->where('employee_id', $employeeId);

        if ($jobTypeFilter) {
            $applicationsQuery->whereHas('hiring.jobType', function ($q) use ($jobTypeFilter) {
                $q->where('name', $jobTypeFilter);
            });
        }

        $applications = $applicationsQuery->paginate($perPage);

        // Lấy danh sách jobType duy nhất từ các bản ghi đã lọc
        $jobTypes = $applications->pluck('hiring.jobType.name')->unique()->filter();
        $perPageOptions = [20, 30, 40, 50, 100, 250];

        return view('employee.listapplied', compact('applications', 'jobTypes', 'perPageOptions'));
    }




}
