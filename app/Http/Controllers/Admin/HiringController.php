<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hiring;
use App\Models\Location;
use App\Models\Employer;
use App\Models\SalaryRange;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HiringController extends Controller
{
    public function index(Request $request) {
        $keyword = $request->input('keyword');

        $hirings = Hiring::with(['location', 'employer', 'salaryRange', 'company', 'vacancy', 'jobCategory', 'jobType', 'experience'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhereHas('employer', function ($employerQuery) use ($keyword) {
                        $employerQuery->where('firstname', 'like', '%' . $keyword . '%')
                            ->orWhere('lastname', 'like', '%' . $keyword . '%');
                    });
            })->paginate(3);

        return view('admin.hirings.index', compact('hirings', 'keyword'));
    }

    public function create()
    {
        $locations = Location::all();
        $employers = Employer::all();
        $salaryRanges = SalaryRange::all();
        $companies = Company::all();
        $vacancies = Vacancy::all();
        $jobCategories = JobCategory::all();
        $jobTypes = JobType::all();
        $experiences = Experience::all();
        return view('admin.hirings.create', compact('locations', 'employers', 'salaryRanges', 'companies', 'vacancies', 'jobCategories', 'jobTypes', 'experiences'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location_id' => 'required|exists:locations,id',
            'employer_id' => 'nullable|exists:employers,id',
            'salary_range_id' => 'nullable|exists:salary_ranges,id',
            'company_id' => 'nullable|exists:companies,id',
            'vacancy_id' => 'nullable|exists:vacancies,id',
            'job_category_id' => 'required|exists:job_categories,id',
            'job_type_id' => 'required|exists:job_types,id',
            'experience_id' => 'required|exists:experiences,id',
            'tags' => 'nullable|string',
            'deadline' => 'required|date',
            'education' => 'required|string|max:255',
            'gender' => 'required|string|in:Nam,Nữ,Không yêu cầu (All gender)',
            'isfeatured' => 'required|string|in:yes,no',
            'isBoosted' => 'required|string|in:yes,no',
            'status' => 'required|string|in:active,inactive',
            'token' => 'required|string|unique:hirings,token',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['token'] = Str::random(32); // Generate a unique token

        Hiring::create($data);

        return redirect()->route('admin.hirings.index')->with('success', 'Tạo 1 tin tuyển dụng thành công !');
    }

    public function show(Hiring $hiring)
    {
        $hiring = Hiring::with(['location', 'employer', 'salaryRange', 'company', 'vacancy', 'jobCategory', 'jobType', 'experience'])->findOrFail($hiring->id);
        return view('admin.hirings.show', compact('hiring'));
    }

    public function edit($id) {
        $hiring = Hiring::findOrFail($id);

        // Chuyển đổi deadline sang định dạng Y-m-d nếu nó tồn tại
        if ($hiring->deadline) {
            try {
                $hiring->deadline = (new \Carbon\Carbon($hiring->deadline))->format('Y-m-d');
            } catch (\Exception $e) {
                // Xử lý lỗi nếu deadline không phải là định dạng ngày hợp lệ
                $hiring->deadline = null; // Hoặc một giá trị mặc định nào đó
            }
        }

        $locations = Location::all();
        $employers = Employer::all();
        $salaryRanges = SalaryRange::all();
        $companies = Company::all();
        $vacancies = Vacancy::all();
        $jobCategories = JobCategory::all();
        $jobTypes = JobType::all();
        $experiences = Experience::all();

        return view('admin.hirings.edit', compact('hiring', 'locations', 'employers', 'salaryRanges', 'companies', 'vacancies', 'jobCategories', 'jobTypes', 'experiences'));
    }

    public function update(Request $request, $id) {
        $hiring = Hiring::findOrFail($id);

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'location_id' => 'required',
            'job_category_id' => 'required',
            'job_type_id' => 'required',
            'experience_id' => 'required',
            'deadline' => 'required|date',
            'education' => 'required',
            'gender' => 'required|in:Nam,Nữ,Không yêu cầu (All gender)',
            'isfeatured' => 'required|in:yes,no',
            'isBoosted' => 'required|in:yes,no',
            'status' => 'required|in:active,inactive',
        ];

        // Thêm quy tắc 'token' một cách có điều kiện
        if ($request->filled('token')) {
            $rules['token'] = 'required|max:255|unique:hirings,token,' . $hiring->id;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $hiring->update($request->except('token')); // Cập nhật tất cả trừ token (nếu không thay đổi)

        if ($request->filled('token')) {
            $hiring->token = $request->input('token'); // Cập nhật token nếu có giá trị mới
            $hiring->save();
        }

        return redirect()->route('admin.hirings.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Hiring $hiring)
    {
        $hiring->delete();
        return redirect()->route('admin.hirings.index')->with('success', 'Xóa thành công 1 tin tuyển dụng !');
    }
}
