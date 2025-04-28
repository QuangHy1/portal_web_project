<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobCategoryController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $jobCategories = JobCategory::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })->paginate(10);

        return view('admin.job_categories.index', compact('jobCategories', 'keyword'));
    }

    public function create()
    {
        return view('admin.job_categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        JobCategory::create($request->all());

        return redirect()->route('admin.job_categories.index')->with('success', 'Tạo 1 "Job Category" thành công!');
    }

    public function show(JobCategory $jobCategory)
    {
        //
    }

    public function edit(JobCategory $jobCategory)
    {
        return view('admin.job_categories.edit', compact('jobCategory'));
    }

    public function update(Request $request, JobCategory $jobCategory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jobCategory->update($request->all());

        return redirect()->route('admin.job_categories.index')->with('success', 'Cập nhật thành công 1 "Job Category" !');
    }

    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();
        return redirect()->route('admin.job_categories.index')->with('success', 'Xóa thành công 1 "Job Category" !');
    }
}
