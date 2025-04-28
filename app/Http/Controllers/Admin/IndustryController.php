<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndustryController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $industries = Industry::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })->paginate(5);

        return view('admin.industries.index', compact('industries', 'keyword'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Industry::create($request->all());

        return redirect()->route('admin.industries.index')->with('success', 'Tạo thaành công 1 lĩnh vực !');
    }

    public function show(Industry $industry)
    {
        //
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $industry->update($request->all());

        return redirect()->route('admin.industries.index')->with('success', 'Cập nhật thành công lĩnh vực !');
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();
        return redirect()->route('admin.industries.index')->with('success', 'Xóa thành công 1 lĩnh vực !');
    }
}
