<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryRangeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $salaryRanges = SalaryRange::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })->paginate(10);

        return view('admin.salary_ranges.index', compact('salaryRanges', 'keyword'));
    }

    public function create()
    {
        return view('admin.salary_ranges.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SalaryRange::create($request->all());

        return redirect()->route('admin.salary_ranges.index')->with('success', 'Tạo mới thành công 1 mức lương ! ');
    }

    public function show(SalaryRange $salaryRange)
    {
        //
    }

    public function edit(SalaryRange $salaryRange)
    {
        return view('admin.salary_ranges.edit', compact('salaryRange'));
    }

    public function update(Request $request, SalaryRange $salaryRange)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $salaryRange->update($request->all());

        return redirect()->route('admin.salary_ranges.index')->with('success', 'Cập nhật thành công 1 mức lương !');
    }

    public function destroy(SalaryRange $salaryRange)
    {
        $salaryRange->delete();
        return redirect()->route('admin.salary_ranges.index')->with('success', 'Xóa thành công 1 mức lương !');
    }
}
