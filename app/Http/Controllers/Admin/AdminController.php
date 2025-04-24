<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $admin = Admin::where('user_id', Auth::id())->with('location')->firstOrFail();
        $locations = Location::all(); // Lấy tất cả locations

        if (!$admin) {
            $adminProfile = Admin::create([
                'user_id' => $userId,
                'firstname' => '',
                'lastname' => '',
                'gender' => '',
                'date_of_birth' => '',
                'phone' => '',
                'personal_email' => '',
                'address' => '',
                'avatar' => 'uploads/admin_profile/default.png',
            ]);
        }


        return view('admin.admins.index', compact('admin', 'locations')); // Truyền $locations vào view
    }

    public function update(Request $request)
    {
        $admin = Admin::where('user_id', Auth::id())->firstOrFail();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $admin->user_id,
            'firstname' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'personal_email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'location_id' => 'nullable|exists:locations,id', // Validation cho location_id
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Cập nhật thông tin người dùng (users table)
        $user = $admin->user;
        $user->email = $request->email;
        $user->save();

        // Cập nhật thông tin admin (admins table)
        $admin->firstname = $request->firstname;
        $admin->lastname = $request->lastname;
        $admin->gender = $request->gender;
        $admin->date_of_birth = $request->date_of_birth;
        $admin->phone = $request->phone;
        $admin->personal_email = $request->personal_email;
        $admin->address = $request->address;
        $admin->location_id = $request->location_id; // Cập nhật location_id
        // Cập nhật mật khẩu nếu có
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Xử lý avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/admins'), $filename);
            $admin->avatar = $filename; // <--- THỬ LẠI CHỈ GÁN $filename
            $admin->save(); // <--- ĐẢM BẢO LỆNH SAVE ĐƯỢC GỌI
        }

        $admin->save();

        return back()->with('success', 'Hồ sơ đã được cập nhật thành công!');
    }
}
