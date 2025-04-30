<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $companies = Company::query();

        if ($keyword) {
            $companies->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        $companies = $companies->paginate(4);

        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_email' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['name', 'company_email','description', 'website', 'location']);

        // Đảm bảo thư mục uploads tồn tại
        if (!file_exists(public_path('uploads/companies'))) {
            mkdir(public_path('uploads/companies'), 0755, true);
        }

        // Xử lý upload logo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/companies'), $filename);
            $data['logo'] = $filename;
        }

        Company::create($data);

        return redirect()->route('admin.companies.index')->with('success', 'Thêm công ty thành công');
    }


    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'company_email' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'location' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Gán các giá trị đơn giản
        $company->name = $request->name;
        $company->company_email = $request->company_email;
        $company->description = $request->description;
        $company->website = $request->website;
        $company->location = $request->location;

        // Nếu người dùng upload logo mới
        if ($request->hasFile('logo')) {
            // Xóa logo cũ (nếu có)
            if ($company->logo && file_exists(public_path('uploads/companies/' . $company->logo))) {
                unlink(public_path('uploads/companies/' . $company->logo));
            }

            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/companies'), $filename);

            $company->logo = $filename;
        }

        $company->save();

        return redirect()->route('admin.companies.index')->with('success', 'Cập nhật công ty thành công!');
    }


    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Xóa công ty thành công');
    }
}

