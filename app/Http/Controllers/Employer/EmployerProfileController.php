<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\Location;
use App\Models\Industry;
use Illuminate\Support\Facades\Auth;

class EmployerProfileController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:employer');
//    }

    public function index()
    {
        // Lấy các Location và Industry để hiển thị trong form
        $locations = Location::orderBy('name', 'asc')->get();
        $industries = Industry::orderBy('name', 'asc')->get();

        return view('employer.profile', compact('locations', 'industries'));
    }

    public function edit(Request $request)
    {
        // Kiểm tra nếu employer tồn tại
        $employer = Employer::where('user_id', Auth::guard('employer')->user()->id)->first();

        if (!$employer) {
            return redirect()->route('employer.profile')->with('error', 'Không tìm thấy người dùng.');
        }

        // Validate đầu vào, bao gồm cả company_name
        $request->validate([
            'firstname' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Nam,Nữ,Không yêu cầu',
            'date_of_birth' => 'nullable|date',
            'about' => 'nullable|string',
            'location_id' => 'nullable|exists:locations,id',
            'industry_id' => 'nullable|exists:industries,id',
            'company_name' => 'nullable|string|max:255',
        ]);

        // Cập nhật thông tin employer
        $employer->firstname = $request->firstname;
        $employer->lastname = $request->lastname;
        $employer->phone = $request->phone;
        $employer->address = $request->address;
        $employer->gender = $request->gender;
        $employer->date_of_birth = $request->date_of_birth;
        $employer->about = $request->about;
        $employer->location_id = $request->location_id;
        $employer->industry_id = $request->industry_id;

        // Cập nhật mạng xã hội nếu có
        $employer->facebook = $request->facebook;
        $employer->instagram = $request->instagram;
        $employer->github = $request->github;

        $employer->save();

        // Cập nhật Company name
        $company = $employer->company;
        $company->name = $request->company_name;
        $company->location = $request->company_location;
        $company->save();

        return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công !');
    }



    public function openingHours(Request $request)
    {
        $employer = Employer::where('user_id', Auth::guard('employer')->user()->id)->first();

        // Validate giờ làm việc
        $request->validate([
            'monday' => 'nullable|string|max:255',
            'tuesday' => 'nullable|string|max:255',
            'wednesday' => 'nullable|string|max:255',
            'thursday' => 'nullable|string|max:255',
            'friday' => 'nullable|string|max:255',
            'saturday' => 'nullable|string|max:255',
            'sunday' => 'nullable|string|max:255',
        ]);


        // Cập nhật giờ làm việc
        $employer->hours_monday = $request->monday;
        $employer->hours_tuesday = $request->tuesday;
        $employer->hours_wednesday = $request->wednesday;
        $employer->hours_thursday = $request->thursday;
        $employer->hours_friday = $request->friday;
        $employer->hours_saturday = $request->saturday;
        $employer->hours_sunday = $request->sunday;

        $employer->update();

        return redirect()->back()->with('success', 'Cập nhật Tổng Quan Thông Tin thành công !');
    }

    public function socialLinks(Request $request)
    {
        $employer = Employer::where('user_id', Auth::guard('employer')->user()->id)->first();

        // Validate các liên kết mạng xã hội
        $request->validate([
            'facebook' => 'nullable||string|max:255',
            'instagram' => 'nullable||string|max:255',
            'github' => 'nullable||string|max:255',
        ]);


        // Cập nhật các liên kết mạng xã hội
        $employer->facebook = $request->facebook;
        $employer->instagram = $request->instagram;
        $employer->github = $request->github;

        $employer->update();

        return redirect()->back()->with('success', 'Cập nhật các liên kết thành công ! ');
    }

    public function contact(Request $request)
    {
        $employer = Employer::where('user_id', Auth::guard('employer')->user()->id)->first();

        // Validate thông tin liên hệ
        $request->validate([
            'address' => 'nullable|string|max:255',
            'location_id' => 'nullable|exists:locations,id',
            'phone' => 'nullable|string|max:20',
        ]);

        // Cập nhật thông tin liên hệ
        $employer->address = $request->address;
        $employer->location_id = $request->location_id;
        $employer->phone = $request->phone;

        $employer->save();

        return redirect()->back()->with('success', 'Cập nhật Thông Tin Liên Hệ thành công !');
    }

}
