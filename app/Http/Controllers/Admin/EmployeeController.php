<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $employees = Employee::with(['user', 'location'])
            ->where('isDeleted', 0) // Lọc các nhân viên chưa bị xóa
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('firstname', 'like', '%' . $keyword . '%')
                    ->orWhere('lastname', 'like', '%' . $keyword . '%')
                    ->orWhere('designation', 'like', '%' . $keyword . '%')
                    ->orWhereHas('user', function ($userQuery) use ($keyword) {
                        $userQuery->where('email', 'like', '%' . $keyword . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('admin.employees.index', compact('employees', 'keyword'));
    }

    public function create()
    {
        $users = User::all();
        $locations = Location::all();
        return view('admin.employees.create', compact('users', 'locations'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'location_id' => 'nullable|exists:locations,id',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate file ảnh
            'website' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'isverified' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['token'] = Str::random(60);

        // Xử lý upload file ảnh
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/employees'), $filename);
            $data['photo'] = 'uploads/employees/' . $filename;
        } else {
            $data['photo'] = null; // Nếu không có ảnh
        }

        Employee::create($data);

        return redirect()->route('admin.employees.index')->with('success', 'Tạo thành công 1 employee!');
    }


    public function show(Employee $employee)
    {
        $employee = Employee::with(['user', 'location'])->findOrFail($employee->id);
        return view('admin.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $employee = Employee::findOrFail($employee->id);
        $users = User::all();
        $locations = Location::all();
        return view('admin.employees.edit', compact('employee', 'users', 'locations'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'location_id' => 'nullable|exists:locations,id',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate file ảnh
            'website' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|string|max:255', //
            'instagram' => 'nullable|string|max:255', //
            'github' => 'nullable|string|max:255', //
            'isverified' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        // Xử lý upload file ảnh mới
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/employees'), $filename);
            $data['photo'] = 'uploads/employees/' . $filename;
        } else {
            // Không upload file mới thì giữ nguyên ảnh cũ
            $data['photo'] = $employee->photo;
        }

        $employee->update($data);

        return redirect()->route('admin.employees.index')->with('success', 'Cập nhật thành công 1 employee');
    }


    public function destroy(Employee $employee)
    {
        $employee->isDeleted = 1; // Đánh dấu là đã xóa thay vì xóa hẳn
        $employee->save();

        return redirect()->route('admin.employees.index')->with('success', 'Xóa thành công 1 employee');
    }
}
