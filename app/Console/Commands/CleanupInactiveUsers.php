<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Employee;
use App\Models\Employer;

class CleanupInactiveUsers extends Command
{
    protected $signature = 'cleanup:inactive-users';
    protected $description = 'Xoá user không kích hoạt sau 24 giờ';

    public function handle()
    {
        $expired = now()->subHours(24);

        $users = User::where('status', 'inactive')
            ->where('created_at', '<', $expired)
            ->get();

        foreach ($users as $user) {
            if ($user->role_id == 4) {
                Employee::where('user_id', $user->id)->delete();
            } elseif ($user->role_id == 3) {
                Employer::where('user_id', $user->id)->delete();
            }

            $user->delete();
        }

        $this->info('Đã xoá các user chưa xác minh quá 24h.');
    }
}
