<?php

namespace App\Http\Controllers\Admin;  // Đã sửa namespace

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PackageController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->input('keyword');

        $packages = Package::query()
            ->where('name', 'LIKE', "%{$keyword}%")
            ->paginate(5); // Số lượng hiển thị trên mỗi trang

        return view('admin.packages.index', compact('packages'));
    }


    public function create(): View
    {
        return view('admin.packages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer|min:0',
            'duration' => 'required|integer|min:1',
            'duration_type' => 'required|in:day,month,year',
            'jobs_count' => 'required|integer|min:0',
            'featured_count' => 'required|integer|min:0',
            'photos_count' => 'required|integer|min:0',
            'videos_count' => 'required|integer|min:0',
        ]);

        Package::create($request->all());

        return redirect()->route('admin.packages.index')->with('success', 'Gói đã được tạo thành công.');
    }

    public function show(Package $package): View
    {
        return view('admin.packages.show', compact('package'));
    }

    public function edit(Package $package): View
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer|min:0',
            'duration' => 'required|integer|min:1',
            'duration_type' => 'required|in:day,month,year',
            'jobs_count' => 'required|integer|min:0',
            'featured_count' => 'required|integer|min:0',
            'photos_count' => 'required|integer|min:0',
            'videos_count' => 'required|integer|min:0',
        ]);

        $package->update($request->all());

        return redirect()->route('admin.packages.index')->with('success', 'Gói đã được cập nhật thành công.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Gói đã được xóa thành công.');
    }
}
