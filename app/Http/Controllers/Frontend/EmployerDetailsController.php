<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employer;
use Illuminate\Support\Facades\DB;
use App\Models\Hiring;

class EmployerDetailsController extends Controller
{
//    public function employerDetails($id)
//    {
//        $employer = Employer::find($id);
//        $hiring = Hiring::where('company_id', $id)->count();
//        return view('Frontend.employerdetails', compact('employer', 'hiring'));
//    }
//
//    public function browseEmployer()
//    {
//        $employers = Employer::select('employer_name', 'id')->groupBy('id', DB::raw("SUBSTRING(employer_name, 1, 1)"))->orderBy(DB::raw("SUBSTRING(employer_name, 1, 1)"))->get();
//
//
//        $groupedData = collect($employers)->groupBy(function ($item) {
//            return strtoupper(substr($item->employer_name, 0, 1));
//
//        });
//        return view('Frontend.employerlist', compact('groupedData'));
//    }
    public function employerDetails($id)
    {
        $employer = Employer::find($id);
        $hiring = Hiring::where('company_id', $id)->count();
        return view('Frontend.employerdetails', compact('employer', 'hiring'));
    }

//    public function browseEmployer()
//    {
//        $employers = Employer::select('employer_name', 'id')
//            ->groupBy('id', DB::raw("SUBSTRING(employer_name, 1, 1)"))
//            ->orderBy(DB::raw("SUBSTRING(employer_name, 1, 1)"))
//            ->get();
//
//        $groupedData = collect($employers)->groupBy(function ($item) {
//            return strtoupper(substr($item->employer_name, 0, 1));
//        });
//
//        return view('Frontend.employerlist', compact('groupedData'));
//    }
    public function browseEmployer()
    {
        $employers = Employer::query()
            ->select('employers.id', 'companies.name as company_name') // Đổi thành companies.name và giữ alias company_name (hoặc bạn có thể đổi alias nếu muốn)
            ->leftJoin('companies', 'employers.company_id', '=', 'companies.id')
            ->groupBy('employers.id', DB::raw("SUBSTRING(companies.name, 1, 1)")) // Đổi thành companies.name
            ->orderBy(DB::raw("SUBSTRING(companies.name, 1, 1)")) // Đổi thành companies.name
            ->get();

        $groupedData = collect($employers)->groupBy(function ($item) {
            return strtoupper(substr($item->company_name, 0, 1)); // Alias vẫn là company_name nên không cần đổi ở đây
        });

        return view('Frontend.employerlist', compact('groupedData'));
    }
}
