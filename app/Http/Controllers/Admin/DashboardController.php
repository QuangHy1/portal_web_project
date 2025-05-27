<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Hiring;
use App\Models\BoostOrder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Tuần hiện tại
        $startOfThisWeek = Carbon::now()->startOfWeek();
        $endOfThisWeek = Carbon::now()->endOfWeek();

        // Tuần trước
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        // 1. Tổng số tài khoản employee
        $employeeCount = User::where('role_id', 4)->count();

        // 2. Tổng số tài khoản employer
        $employerCount = User::where('role_id', 3)->count();

        // 3. Số lượng tin đăng trong tuần này (còn hạn + status = active)
        $hiringCount = Hiring::where('status', 'active')
            ->whereBetween('created_at', [$startOfThisWeek, $endOfThisWeek])
            ->whereDate('deadline', '>=', now()) // deadline còn hạn
            ->count();

        // 4. Số lượng giao dịch boost trong tuần
        $boostCount = BoostOrder::whereBetween('created_at', [$startOfThisWeek, $endOfThisWeek])
            ->count();

        // 5. Doanh thu tuần này
        $thisWeekRevenue = BoostOrder::whereBetween('created_at', [$startOfThisWeek, $endOfThisWeek])
            ->sum(DB::raw('CAST(package_price AS UNSIGNED)'));

        // 6. Doanh thu tuần trước
        $lastWeekRevenue = BoostOrder::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->sum(DB::raw('CAST(package_price AS UNSIGNED)'));

        // 7. Tính phần trăm hiệu suất doanh thu
        $revenueChange = 0;
        if ($lastWeekRevenue > 0) {
            $revenueChange = round((($thisWeekRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100, 2);
        } elseif ($thisWeekRevenue > 0) {
            $revenueChange = 100;
        }

        return view('admin.dashboard.home.index', compact(
            'employeeCount',
            'employerCount',
            'hiringCount',
            'boostCount',
            'thisWeekRevenue',
            'lastWeekRevenue',
            'revenueChange'
        ));
    }
}
