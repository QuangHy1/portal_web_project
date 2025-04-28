<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;

class ResumeController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $resumes = Resume::with('employee')
            ->where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('file_name', 'like', '%' . $keyword . '%')
                        ->orWhere('title', 'like', '%' . $keyword . '%')
                        ->orWhereHas('employee', function ($q) use ($keyword) {
                            $q->where('firstname', 'like', '%' . $keyword . '%')
                                ->orWhere('lastname', 'like', '%' . $keyword . '%');
                        });
                }
            })
            ->paginate(7);

        return view('admin.resumes.index', compact('resumes', 'keyword'));
    }


    public function create()
    {
        $employees = Employee::all();
        return view('admin.resumes.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Ví dụ: giới hạn 2MB
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');
        $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $filePath = 'uploads/resumes/' . $fileName; // Đường dẫn lưu trữ

        // Lưu file vào storage (hoặc cloud storage nếu cấu hình)
        Storage::disk('public')->put($filePath, file_get_contents($file));

        $resume = new Resume();
        $resume->employee_id = $request->employee_id;
        $resume->file_path = $filePath;
        $resume->file_name = $file->getClientOriginalName();
        $resume->file_type = $file->getClientOriginalExtension();
        $resume->title = $request->title;
        $resume->save();

        return redirect()->route('admin.resumes.index')->with('success', 'Tải Hồ sơ lên thành công !');
    }

    public function show(Resume $resume)
    {
        $filePath = $resume->file_path;
        $fileName = $resume->file_name;

        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File không tồn tại hoặc đã bị xóa!');
        }

        try {
            return response()->file(
                Storage::disk('public')->path($filePath),
                [
                    'Content-Type' => Storage::disk('public')->mimeType($filePath),
                    'Content-Disposition' => 'inline; filename="' . $fileName . '"',
                ]
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thể mở file, có thể file bị hỏng hoặc định dạng không hỗ trợ.');
        }
    }

    public function edit(Resume $resume)
    {
        $resume = Resume::findOrFail($resume->id);
        $employees = Employee::all();
        return view('admin.resumes.edit', compact('resume', 'employees'));
    }

    public function update(Request $request, Resume $resume)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Xử lý file nếu có file mới được tải lên
        if ($request->hasFile('file')) {
            // Xóa file cũ
            Storage::delete($resume->file_path);

            $file = $request->file('file');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/resumes/' . $fileName;

            Storage::disk('public')->put($filePath, file_get_contents($file));

            $resume->file_path = $filePath;
            $resume->file_name = $file->getClientOriginalName();
            $resume->file_type = $file->getClientOriginalExtension();
        }

        $resume->employee_id = $request->employee_id;
        $resume->title = $request->title;
        $resume->save();

        return redirect()->route('admin.resumes.index')->with('success', 'Cập nhật Hồ sơ lên thành công !');
    }

    public function destroy(Resume $resume)
    {
        // Xóa file liên quan trước khi xóa bản ghi
        Storage::disk('public')->delete($resume->file_path);
        $resume->delete();

        return redirect()->route('admin.resumes.index')->with('success', 'Xóa 1 Hồ sơ thành công !');
    }

    public function download(Resume $resume)
    {
        $filePath = $resume->file_path;
        $fileName = $resume->file_name;

        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File not found!');
        }

        return response()->download(Storage::disk('public')->path($filePath), $fileName);
    }
}
