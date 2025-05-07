<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hiring;
use App\Models\JobCategory;
use App\Models\Location;
use App\Models\JobType;
use App\Models\SalaryRange;
use App\Models\Experience;

class JobSearchController extends Controller
{
    public function index(Request $request)
    {
        $hiringQuery = $request->jobs;
        $hiringLocation = $request->location;
        $hiringJobCategory = $request->category;
        $hiringJobType = $request->jobtype;
        $hiringSalaryRange = $request->salaryrange;
        $hiringExperience = $request->experience;

        // Dữ liệu để load các bộ lọc
        $categories = JobCategory::orderBy('name', 'asc')->get();
        $locations = Location::orderBy('name', 'asc')->get();
        $jobtype = JobType::orderBy('name', 'asc')->get();
        $salaryrange = SalaryRange::orderBy('name', 'asc')->get();
        $experience = Experience::orderBy('name', 'asc')->get();

        // Query chính
        $hirings = Hiring::where('status', 'active')->orderBy('id', 'desc');

        if (!empty($hiringQuery)) {
            $hirings->where('title', 'like', '%' . $hiringQuery . '%');
        }

        if (!empty($hiringLocation)) {
            $hirings->where('location_id', $hiringLocation);
        }

        if (!empty($hiringJobCategory)) {
            $hirings->where('job_category_id', $hiringJobCategory);
        }

        if (!empty($hiringJobType)) {
            $hirings->where('job_type_id', $hiringJobType);
        }

        if (!empty($hiringSalaryRange)) {
            $hirings->where('salary_range_id', $hiringSalaryRange);
        }

        if (!empty($hiringExperience)) {
            $hirings->where('experience_id', $hiringExperience);
        }

        // Phân trang
        $hirings = $hirings->paginate(6)->appends($request->all());

        return view('frontend.jobSearch', compact(
            'hirings',
            'categories',
            'locations',
            'jobtype',
            'salaryrange',
            'experience',
            'hiringQuery',
            'hiringLocation',
            'hiringJobCategory',
            'hiringJobType',
            'hiringSalaryRange',
            'hiringExperience'
        ));
    }
}
