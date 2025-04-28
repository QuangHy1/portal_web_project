<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeApplication;
use App\Models\Employee;
use App\Models\Hiring; // Thay Job bằng Hiring
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeApplicationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $employeeApplications = EmployeeApplication::with(['employee', 'hiring', 'resume']) // Thay job bằng hiring
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('cover_letter', 'like', '%' . $keyword . '%')
                ->orWhere('status', 'like', '%' . $keyword . '%')
                ->orWhereHas('employee', function ($employeeQuery) use ($keyword) {
                    $employeeQuery->where('firstname', 'like', '%' . $keyword . '%')
                        ->orWhere('lastname', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('hiring', function ($hiringQuery) use ($keyword) { // Thay job bằng hiring
                    $hiringQuery->where('title', 'like', '%' . $keyword . '%'); // Tìm kiếm theo tiêu đề của Hiring
                });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.employee_applications.index', compact('employeeApplications', 'keyword'));
    }

    public function create()
    {
        $employees = Employee::all();
        $hirings = Hiring::all(); // Thay Job::all() bằng Hiring::all()
        $resumes = Resume::all();
        return view('admin.employee_applications.create', compact('employees', 'hirings', 'resumes')); // Truyền $hirings
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'hiring_id' => 'required|exists:hirings,id', // Thay job_id bằng hiring_id
            'resume_id' => 'nullable|exists:resumes,id',
            'cover_letter' => 'required|string',
            'status' => 'required|string|max:255',
            'similarityScore' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        EmployeeApplication::create($validator->validated());

        return redirect()->route('admin.employee_applications.index')->with('success', 'Tạo mới 1 đơn ứng tuyển thành công !');
    }

    public function show(EmployeeApplication $employeeApplication)
    {
        $employeeApplication = EmployeeApplication::with(['employee', 'hiring', 'resume'])->findOrFail($employeeApplication->id); // Thay job bằng hiring
        return view('admin.employee_applications.show', compact('employeeApplication'));
    }

    public function edit(EmployeeApplication $employeeApplication)
    {
        $employeeApplication = EmployeeApplication::findOrFail($employeeApplication->id);
        $employees = Employee::all();
        $hirings = Hiring::all(); // Thay Job::all() thành Hiring::all()
        $resumes = Resume::all();
        return view('admin.employee_applications.edit', compact('employeeApplication', 'employees', 'hirings', 'resumes')); // Thêm $hirings
    }

    public function update(Request $request, EmployeeApplication $employeeApplication)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'hiring_id' => 'required|exists:hirings,id', // Thay job_id bằng hiring_id
            'resume_id' => 'nullable|exists:resumes,id',
            'cover_letter' => 'required|string',
            'status' => 'required|string|max:255',
            'similarityScore' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employeeApplication->update($validator->validated());

        return redirect()->route('admin.employee_applications.index')->with('success', 'Cập nhật 1 đơn ứng tuyển thành công !');
    }

    public function destroy(EmployeeApplication $employeeApplication)
    {
        $employeeApplication->delete();
        return redirect()->route('admin.employee_applications.index')->with('success', 'Xóa thành công 1 đơn ứng tuyển !');
    }

    public function review()
    {
        $employeeApplications = EmployeeApplication::where('status', 'pending')->with(['employee', 'hiring', 'resume'])->paginate(10);
        return view('admin.employee_applications.review', compact('employeeApplications'));
    }

    public function approve(EmployeeApplication $employeeApplication)
    {
        $employeeApplication->status = 'approved';
        $employeeApplication->save();

        return redirect()->route('admin.employee_applications.review')->with('success', 'Đơn ứng tuyển đã được duyệt.');
    }

    public function reject(EmployeeApplication $employeeApplication)
    {
        $employeeApplication->status = 'rejected';
        $employeeApplication->save();

        return redirect()->route('admin.employee_applications.review')->with('success', 'Đơn ứng tuyển đã bị từ chối.');
    }

}
