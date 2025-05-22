<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->input('keyword');

        $query = User::query();

        if ($keyword) {
            $query->where('username', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        }

        $users = $query->paginate(4)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = \App\Models\Role::all(); // Fetch all roles
        return view('admin.users.create', compact('roles'));
    }

    public function showApprovalList(): View
    {
        $usersToApprove = User::where(function ($query) {
            $query->where('status', 'inactive')
                ->orWhereHas('employer', function ($q) {
                    $q->where('isverified', 0);
                });
        })
            ->whereHas('role', function ($query) {
                $query->where('id', 3); // Chỉ lấy role là nhà tuyển dụng
            })
            ->with(['role', 'employer']) // cần để view dùng $user->employer
            ->get();

        return view('admin.users.approve', compact('usersToApprove'));
    }
    public function approve(User $user)
    {
        if ($user->role_id == 3 && $user->employer) {
            $user->status = 'active';
            $user->employer->isverified = 1;

            $user->save();
            $user->employer->save();

            return back()->with('success', 'Đã duyệt tài khoản nhà tuyển dụng.');
        }

        return back()->with('error', 'Không tìm thấy nhà tuyển dụng phù hợp.');
    }

    public function reject(User $user)
    {
        if ($user->role_id == 3 && $user->employer) {
            $user->status = 'inactive';
            $user->employer->isverified = 0;

            $user->save();
            $user->employer->save();

            return back()->with('success', 'Đã từ chối tài khoản.');
        }

        return back()->with('error', 'Không tìm thấy nhà tuyển dụng phù hợp.');
    }
    public function updating(Employer $employer)
    {
        $employer->user->status = $employer->isverified ? 'active' : 'inactive';
        $employer->user->save();
    }

    protected function autoActivateUser(User $user, Request $request): void
    {
        if ($request->input('role_id') != 3) {
            $user->status = 'active';
            $user->save();
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'status' => 'nullable|in:active,inactive', // Make status nullable for auto-activation
        ], [
            'username.required' => 'Tên đăng nhập là bắt buộc.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'role_id.required' => 'Vai trò là bắt buộc.',
            'role_id.exists' => 'Vai trò không tồn tại.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => $request->input('role_id') == 3 ? 'inactive' : 'active',
        ]);

        // $this->autoActivateUser($user, $request); // Old approach, now handled directly

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được tạo thành công.' . ($user->status === 'inactive' ? ' Cần được duyệt để hoạt động.' : ''));
    }
    public function edit(int $id): View
    {
        $user = User::findOrFail($id);
        $roles = \App\Models\Role::all(); // Fetch all roles for edit
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // Password is nullable on update
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive',
        ], [
            'username.required' => 'Tên đăng nhập là bắt buộc.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'role_id.required' => 'Vai trò là bắt buộc.',
            'role_id.exists' => 'Vai trò không tồn tại.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->filled('password')) { // Only update password if provided
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Thông tin người dùng đã được cập nhật thành công.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Tài khoản người dùng đã được xóa thành công.');
    }
}
