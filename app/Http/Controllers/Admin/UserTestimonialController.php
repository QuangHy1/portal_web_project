<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserTestimonial;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserTestimonialController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $userTestimonials = UserTestimonial::with('employee')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('designation', 'like', '%' . $keyword . '%')
                    ->orWhere('company', 'like', '%' . $keyword . '%')
                    ->orWhereHas('employee', function ($employeeQuery) use ($keyword) {
                        $employeeQuery->where('firstname', 'like', '%' . $keyword . '%')
                            ->orWhere('lastname', 'like', '%' . $keyword . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.user_testimonials.index', compact('userTestimonials', 'keyword'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.user_testimonials.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'designation' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'testimonial' => 'required|string',
            'isFeatured' => 'required|in:0,1',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/testimonials', 'public');
            $data['image'] = basename($imagePath);
        }

        UserTestimonial::create($data);

        return redirect()->route('admin.user_testimonials.index')->with('success', 'Đã tạo thành công 1 "Đánh giá người dùng" !');
    }

    public function show(UserTestimonial $userTestimonial)
    {
        //
    }

    public function edit(UserTestimonial $userTestimonial)
    {
        $employees = Employee::all();
        return view('admin.user_testimonials.edit', compact('userTestimonial', 'employees'));
    }

    public function update(Request $request, UserTestimonial $userTestimonial)
    {
        $validatedData = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'designation' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'testimonial' => 'required|string',
            'isFeatured' => 'required|in:0,1',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($userTestimonial->image) {
                Storage::delete('public/uploads/testimonials/' . $userTestimonial->image);
            }
            $imagePath = $request->file('image')->store('uploads/testimonials', 'public');
            $data['image'] = basename($imagePath);
        }

        $userTestimonial->update($data);

        return redirect()->route('admin.user_testimonials.index')->with('success', 'Cập nhật thành công 1 "Đánh giá người dùng"!');
    }

    public function destroy(UserTestimonial $userTestimonial)
    {
        if ($userTestimonial->image) {
            Storage::delete('public/uploads/testimonials/' . $userTestimonial->image);
        }

        $userTestimonial->delete();
        return redirect()->route('admin.user_testimonials.index')->with('success', 'Xóa thành công 1 "Đánh giá người dùng"!');
    }
}

