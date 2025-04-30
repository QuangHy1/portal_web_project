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

    public function getApplied()
    {
        $jobPost =  EmployeeApplication::where('employee_id', auth()->user()->id()->get());

        // $jobPost->view_count = $blogPost->view_count + 1;
        // $jobPost->update();


        return view('employee.listapplied', compact('jobPost'));
    }

}
