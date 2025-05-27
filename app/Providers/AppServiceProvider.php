<?php

namespace App\Providers;

use App\Models\BoostOrder;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('admin.*', function ($view) {
            $pendingAccountCount = User::where('status', 'inactive')
                ->whereIn('role_id', [3, 4])
                ->count();

            $pendingBoostCount = BoostOrder::where('isActive', 0)
                ->whereDate('date_expired', '>=', now())
                ->whereDate('date_purchased', '<=', now())
                ->count();

            $view->with([
                'pendingBoostCount' => $pendingBoostCount,
                'pendingAccountCount' => $pendingAccountCount,
            ]);
        });
    }

}
