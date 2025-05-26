<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Package;
use App\Models\BoostOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function showBoostForm()
    {
        $packages = Package::all(); // nếu không có cột status
        return view('employer.boostpurchase', compact('packages'));
    }
    public function storeBoostOrder(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'tnxID' => 'required|string|unique:boost_orders,tnxID',
        ]);

        $user = Auth::guard('employer')->user();
        if ($user->role_id != 3) {
            return redirect()->back()->with('error', 'Chỉ nhà tuyển dụng mới có thể mua boost.');
        }

        $employer = Employer::where('user_id', $user->id)->first();
        if (!$employer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
        }

        $package = Package::findOrFail($request->package_id);

        // Tính ngày hết hạn dựa trên duration_type
        $datePurchased = now();
        $dateExpired = match ($package->duration_type) {
            'day' => $datePurchased->copy()->addDays($package->duration),
            'month' => $datePurchased->copy()->addMonths($package->duration),
            'year' => $datePurchased->copy()->addYears($package->duration),
            default => $datePurchased->copy()->addDays($package->duration),
        };

        // Tắt tất cả boost_orders trước đó (nếu cần logic ghi đè)
        BoostOrder::where('employer_id', $employer->id)->update(['isActive' => 0]);

        BoostOrder::create([
            'employer_id' => $employer->id,
            'package_id' => $package->id,
            'used' => 0,
            'package_price' => $package->price,
            'tnxID' => $request->tnxID,
            'payment_method' => 'VietQR', // hoặc lấy từ $request nếu cần
            'isActive' => 1,
            'date_purchased' => $datePurchased->toDateString(),
            'date_expired' => $dateExpired->toDateString(),
        ]);

        return redirect()->route('employer.boost.index')->with('success', 'Bạn đã mua gói boost thành công.');
    }

    public function generateVietQR(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'package_id' => 'required|exists:packages,id',
            'jobs_count' => 'required|integer|min:1',
            'tnxID' => 'required|string'
        ]);

        $amount = $request->amount;
        $packageId = $request->package_id;
        $jobsCount = $request->jobs_count;
        $tnxID = $request->tnxID;

        return view('employer.vietqr', [
            'amount' => $amount,
            'package_id' => $packageId,
            'jobs_count' => $jobsCount,
            'tnxID' => $tnxID
        ]);
    }

    public function confirmPayment(Request $request)
    {
        $user = Auth::guard('employer')->user();

        if ($user->role_id != 3) {
            return redirect()->route('employer.employee.boost')->with('error', 'Chỉ nhà tuyển dụng mới được thao tác.');
        }

        $employer = Employer::where('user_id', $user->id)->first();
        if (!$employer) {
            return redirect()->route('employer.employee.boost')->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
        }

        $package = Package::find($request->package_id);
        if (!$package) {
            return redirect()->route('employer.employee.boost')->with('error', 'Gói boost không hợp lệ.');
        }

        // Tính ngày hết hạn
        $datePurchased = Carbon::now();
        $dateExpired = match ($package->duration_type) {
            'day' => $datePurchased->copy()->addDays($package->duration),
            'month' => $datePurchased->copy()->addMonths($package->duration),
            'year' => $datePurchased->copy()->addYears($package->duration),
            default => $datePurchased->copy()->addDays($package->duration),
        };

        // Lưu vào boost_orders nhưng chưa kích hoạt
        BoostOrder::create([
            'employer_id' => $employer->id,
            'package_id' => $package->id,
            'used' => 0,
            'package_price' => $package->price,
            'tnxID' => $request->tnxID,
            'payment_method' => 'VietQR',
            'isActive' => 0, // CHƯA KÍCH HOẠT
            'date_purchased' => $datePurchased->toDateString(),
            'date_expired' => $dateExpired->toDateString(),
        ]);

        return redirect()->route('employer.employee.boost')->with('success', 'Đã ghi nhận thanh toán. Gói boost sẽ được kích hoạt sau khi admin xác nhận.');
    }

}
