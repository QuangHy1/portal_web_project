<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resume;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeResumeController extends Controller
{
    // Hiển thị danh sách CV đã upload
    public function create()
    {
        $employeeId = Auth::guard('employee')->id();
        $resumes = Resume::where('employee_id', $employeeId)->latest()->get();

        return view('employee.createresume', compact('resumes'));
    }

    // Xử lý upload file CV
    public function store(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|mimes:pdf,doc,docx|max:5120',
            'title' => 'nullable|string|max:255',
        ]);

        $file = $request->file('cv_file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . uniqid() . '.' . $extension;
        $filePath = $file->storeAs('uploads/resumes', $fileName, 'public');

        Resume::create([
            'employee_id' => Auth::guard('employee')->id(),
            'file_path' => $filePath,
            'file_name' => $originalName,
            'file_type' => $extension,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'CV đã được upload thành công.');
    }

    // Xoá một CV
    public function destroy($id)
    {
        $resume = Resume::where('employee_id', Auth::guard('employee')->id())->findOrFail($id);

        if (Storage::disk('public')->exists($resume->file_path)) {
            Storage::disk('public')->delete($resume->file_path);
        }

        $resume->delete();

        return redirect()->back()->with('success', 'CV đã được xoá.');
    }

    // Tải xuống CV
    public function download($id)
    {
        $resume = Resume::where('employee_id', Auth::guard('employee')->id())->findOrFail($id);

        if (Storage::disk('public')->exists($resume->file_path)) {
            return Storage::disk('public')->download($resume->file_path, $resume->file_name);
        }

        return redirect()->back()->with('error', 'Không tìm thấy file CV.');
    }
}
