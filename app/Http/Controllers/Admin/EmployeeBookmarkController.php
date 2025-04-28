<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeBookmark;
use App\Models\Hiring;
use Illuminate\Http\Request;

class EmployeeBookmarkController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $employeeBookmarks = EmployeeBookmark::with(['employee', 'hiring']) // Eager load các relationship
        ->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('employee', function ($employeeQuery) use ($keyword) {
                $employeeQuery->where('firstname', 'like', '%' . $keyword . '%')
                    ->orWhere('lastname', 'like', '%' . $keyword . '%');
            })
                ->orWhereHas('hiring', function ($hiringQuery) use ($keyword) { // Tìm kiếm theo hiring title
                    $hiringQuery->where('title', 'like', '%' . $keyword . '%');
                });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin.employee_bookmarks.index', compact('employeeBookmarks', 'keyword'));
    }

    public function create()
    {
        $employees = Employee::all(); // Lấy danh sách nhân viên
        $hirings = Hiring::all(); // Lấy danh sách vị trí tuyển dụng
        return view('admin.employee_bookmarks.create', compact('employees', 'hirings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'hiring_id' => 'required|exists:hirings,id', // Kiểm tra sự tồn tại của hiring_id
        ]);

        EmployeeBookmark::create($request->all());

        return redirect()->route('admin.employee_bookmarks.index')->with('success', 'Đã thêm đánh dấu thành công.');
    }

    public function show(EmployeeBookmark $employeeBookmark)
    {
        $employeeBookmark->load(['employee', 'hiring']); // Load các relationship để hiển thị đầy đủ thông tin
        return view('admin.employee_bookmarks.show', compact('employeeBookmark'));
    }

    public function edit(EmployeeBookmark $employeeBookmark)
    {
        $employees = Employee::all();
        $hirings = Hiring::all();
        return view('admin.employee_bookmarks.edit', compact('employeeBookmark', 'employees', 'hirings'));
    }

    public function update(Request $request, EmployeeBookmark $employeeBookmark)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'hiring_id' => 'required|exists:hirings,id', // Validate hiring_id
        ]);

        $employeeBookmark->update($request->all());

        return redirect()->route('admin.employee_bookmarks.index')->with('success', 'Đã cập nhật đánh dấu thành công.');
    }

    public function destroy(EmployeeBookmark $employeeBookmark)
    {
        $employeeBookmark->delete();

        return redirect()->route('admin.employee_bookmarks.index')->with('success', 'Đã xóa đánh dấu thành công.');
    }
}
