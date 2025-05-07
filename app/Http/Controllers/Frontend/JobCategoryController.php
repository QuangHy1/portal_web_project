<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCategory;

class JobCategoryController extends Controller
{
    public function categories()
    {
        $jobCategories = JobCategory::withCount('jobcatcount')->get();
        return view('frontend.jobCategories', compact('jobCategories'));
    }
}
