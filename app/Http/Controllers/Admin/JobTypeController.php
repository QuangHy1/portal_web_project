<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobTypeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $jobTypes = JobType::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })->paginate(10);

        return view('admin.job_types.index', compact('jobTypes', 'keyword'));
    }

    public function create()
    {
        return view('admin.job_types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        JobType::create($request->all());

        return redirect()->route('admin.job_types.index')->with('success', 'Tạo mới 1 "Job Type" thành công !');
    }

    public function show(JobType $jobType)
    {
        //
    }

    public function edit(JobType $jobType)
    {
        return view('admin.job_types.edit', compact('jobType'));
    }

    public function update(Request $request, JobType $jobType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jobType->update($request->all());

        return redirect()->route('admin.job_types.index')->with('success', 'Cập nhật thành công 1 "Job Type"!');
    }

    public function destroy(JobType $jobType)
    {
        $jobType->delete();
        return redirect()->route('admin.job_types.index')->with('success', 'Xóa thành công 1 "Job Type"');
    }
}
