<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BoostOrder;
use App\Models\PageHomeItem;
use Illuminate\Http\Request;
use App\Models\JobCategory;
use App\Models\Location;
use App\Models\Post;
use App\Models\Employer;
use App\Models\Hiring;
use App\Models\UserTestimonial;
use App\Models\TopBar;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $HomePageData = PageHomeItem::where('id', 1)->first();
        $JobCategories = JobCategory::withCount('jobcatcount')->orderBy('jobcatcount_count', 'desc')->take(12)->get();
        $JobCategoriesAll = JobCategory::all();
        $postData = Post::latest()->take(3)->get();
        $JobLocations = Location::all();
        $employers = Employer::withCount('countEmployer')->orderBy('count_employer_count', 'desc')->take(7)->get();
        $testimonials = UserTestimonial::where('isFeatured', 'yes')->inRandomOrder()->take(3)->get();

        // Duyệt các boost order để vô hiệu nếu hết hạn (chỉ cập nhật isActive, không đụng đến isBoosted trong hirings)
        $boostOrders = BoostOrder::where('isActive', 1)->get();
        foreach ($boostOrders as $order) {
            $expired = Carbon::parse($order->date_expired);

            if ($expired->isPast()) {
                $order->update(['isActive' => 0]);

                Log::info('Boost Orders Updated', [
                    'boost_order_id' => $order->id,
                    'updated_hirings' => Hiring::where('employer_id', $order->employer_id)
                        ->where('isBoosted', 'yes')
                        ->count()
                ]);
            } else {
                Log::info('BoostOrder check', ['boost_order_id' => $order->id, 'is_active' => $order->isActive]);
            }

            Log::info('Hiring updated', [
                'employer_id' => $order->employer_id,
                'hiring_count' => Hiring::where('employer_id', $order->employer_id)->where('isBoosted', 'yes')->count()
            ]);
        }

        // Vô hiệu job hết hạn
        Hiring::all()->each(function ($job) {
            if (Carbon::parse($job->deadline)->isPast()) {
                $job->update(['status' => 'inactive']);
            }
        });

        // ✅ Chỉ lấy những tin tuyển dụng thực sự đang được boost
        $boosted = Hiring::where('isBoosted', 'yes')->where('status', 'active')->inRandomOrder()->take(1)->get();
        $featuredMain = Hiring::where('isFeatured', 'yes')->where('status', 'active')->inRandomOrder()->take(7)->get();
        $featuredFallback = Hiring::where('isFeatured', 'yes')->where('status', 'active')->inRandomOrder()->take(8)->get();

        return view('frontend.home', compact(
            'HomePageData', 'JobCategories', 'JobCategoriesAll', 'postData',
            'JobLocations', 'employers', 'testimonials',
            'boosted', 'featuredMain', 'featuredFallback'
        ));
    }
}
