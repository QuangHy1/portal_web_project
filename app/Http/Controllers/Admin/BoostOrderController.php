<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoostOrder;
use App\Models\Employer;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BoostOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = BoostOrder::with(['employer', 'package']);

        if ($request->has('keyword') && $request->keyword) {
            $keyword = $request->keyword;
            $query->whereHas('employer', function ($q) use ($keyword) {
                $q->whereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%$keyword%"]);
            })->orWhere('tnxID', 'like', "%$keyword%");
        }

        $boostOrders = $query->paginate(5);
        return view('admin.boost_orders.index', compact('boostOrders'));
    }

    public function create()
    {
        $employers = Employer::all();
        $packages = Package::all();
        return view('admin.boost_orders.create', compact('employers', 'packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|string',
            'isActive' => 'required|boolean',
        ]);

        // Lấy thông tin gói
        $package = Package::findOrFail($validated['package_id']);

        // Tạo ngày mua là hôm nay
        $datePurchased = Carbon::now();

        // Tính ngày hết hạn dựa vào duration và duration_type
        switch ($package->duration_type) {
            case 'day':
                $dateExpired = $datePurchased->copy()->addDays($package->duration);
                break;
            case 'month':
                $dateExpired = $datePurchased->copy()->addMonths($package->duration);
                break;
            case 'year':
                $dateExpired = $datePurchased->copy()->addYears($package->duration);
                break;
            default:
                $dateExpired = $datePurchased; // fallback nếu không rõ
        }

        // Tạo đơn hàng boost
        BoostOrder::create([
            'employer_id' => $validated['employer_id'],
            'package_id' => $validated['package_id'],
            'package_price' => $package->price,
            'tnxID' => strtoupper('TXN' . uniqid()), // mã giao dịch random
            'payment_method' => $validated['payment_method'],
            'isActive' => $validated['isActive'],
            'date_purchased' => $datePurchased->toDateString(),
            'date_expired' => $dateExpired->toDateString(),
        ]);

        return redirect()->route('admin.boost_orders.index')->with('success', 'Đơn hàng đã được tạo thành công.');
    }

    public function edit(BoostOrder $boostOrder)
    {
        $employers = Employer::all();
        $packages = Package::all();
        return view('admin.boost_orders.edit', compact('boostOrder', 'employers', 'packages'));
    }

    public function update(Request $request, BoostOrder $boostOrder)
    {
        $validated = $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|string',
            'isActive' => 'required|boolean',
            'date_purchased' => 'required|date',
            'date_expired' => 'required|date',
        ]);

        $boostOrder->update($validated);

        return redirect()->route('admin.boost_orders.index')->with('success', 'Đơn hàng đã được cập nhật.');
    }

    public function destroy(BoostOrder $boostOrder)
    {
        $boostOrder->delete();
        return redirect()->route('admin.boost_orders.index')->with('success', 'Đơn hàng đã được xóa.');
    }

    public function showApprovalList()
    {
        $today = now()->toDateString();

        $pendingOrders = BoostOrder::with(['employer', 'package'])
            ->where('isActive', 0)
            ->whereDate('date_expired', '>=', $today) // Chỉ lấy các gói còn hạn
            ->whereDate('date_purchased', '<=', $today)
            ->get();

        return view('admin.boost_orders.approve', compact('pendingOrders'));
    }

    public function approve($id)
    {
        $order = BoostOrder::findOrFail($id);
        $order->isActive = 1;
        $order->save();

        return redirect()->route('admin.boost_order.approve.list')->with('success', 'Đơn boost đã được duyệt.');
    }

    public function reject($id)
    {
        $order = BoostOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.boost_order.approve.list')->with('success', 'Đơn boost đã bị từ chối và xóa.');
    }

}
