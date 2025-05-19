<?php

namespace App\Console\Commands;

use App\Models\Hiring;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateHiringStatus extends Command
{
    protected $signature = 'hiring:update-status';
    protected $description = 'Tự động chuyển status về inactive nếu deadline đã qua';

    public function handle()
    {
        $affected = Hiring::where('status', 'active')
            ->whereDate('deadline', '<', Carbon::today())
            ->update(['status' => 'inactive']);

        $this->info("Đã cập nhật {$affected} tin hết hạn thành 'inactive'");
    }
}
// php artisan hiring:update-status
