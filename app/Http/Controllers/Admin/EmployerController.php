<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use App\Models\Company;
use App\Models\Location;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployerController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $employers = Employer::with(['user', 'company', 'location', 'industry'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('firstname', 'like', '%' . $keyword . '%')
                    ->orWhere('lastname', 'like', '%' . $keyword . '%');
            })
            ->paginate(3);

        return view('admin.employers.index', compact('employers', 'keyword'));
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $locations = Location::all();
        $industries = Industry::all();
        return view('admin.employers.create', compact('users', 'companies', 'locations', 'industries'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'location_id' => 'nullable|exists:locations,id',
            'industry_id' => 'nullable|exists:industries,id',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Nam,Nữ,Khác',
            'date_of_birth' => 'nullable|date',
            'about' => 'nullable|string',
            'hours_monday' => 'nullable|string|max:255',
            'hours_tuesday' => 'nullable|string|max:255',
            'hours_wednesday' => 'nullable|string|max:255',
            'hours_thursday' => 'nullable|string|max:255',
            'hours_friday' => 'nullable|string|max:255',
            'hours_saturday' => 'nullable|string|max:255',
            'hours_sunday' => 'nullable|string|max:255',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'github' => 'nullable|string',
            'token' => 'nullable|string|unique:employers,token',
            'isverified' => 'required|boolean',
            'isSuspended' => 'required|string|max:100|in:yes,no',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['token'] = Str::random(32);

        Employer::create($data);

        return redirect()->route('admin.employers.index')->with('success', 'Tạo 1 nhà tuyển dụng mới thành công !');
    }

    public function show(Employer $employer)
    {
        $employer = Employer::with(['user', 'company', 'location', 'industry'])->findOrFail($employer->id);
        return view('admin.employers.show', compact('employer'));
    }

    public function edit(Employer $employer)
    {
        $employer = Employer::findOrFail($employer->id);
        $users = User::all();
        $companies = Company::all();
        $locations = Location::all();
        $industries = Industry::all();
        return view('admin.employers.edit', compact('employer', 'users', 'companies', 'locations', 'industries'));
    }

    public function update(Request $request, Employer $employer)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'location_id' => 'nullable|exists:locations,id',
            'industry_id' => 'nullable|exists:industries,id',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Nam,Nữ,Khác',
            'date_of_birth' => 'nullable|date',
            'about' => 'nullable|string',
            'hours_monday' => 'nullable|string|max:255',
            'hours_tuesday' => 'nullable|string|max:255',
            'hours_wednesday' => 'nullable|string|max:255',
            'hours_thursday' => 'nullable|string|max:255',
            'hours_friday' => 'nullable|string|max:255',
            'hours_saturday' => 'nullable|string|max:255',
            'hours_sunday' => 'nullable|string|max:255',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'github' => 'nullable|string',
            'token' => 'nullable|string|unique:employers,token',
            'isverified' => 'required|boolean',
            'isSuspended' => 'required|string|max:100|in:yes,no',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employer->update($request->all());

        return redirect()->route('admin.employers.index')->with('success', 'Cập nhật thành công 1 nhà tuyển dụng !');
    }

    public function destroy(Employer $employer)
    {
        $employer->delete();
        return redirect()->route('admin.employers.index')->with('success', 'Xóa thành công 1 nhà tuyển dụng !');
    }
}
