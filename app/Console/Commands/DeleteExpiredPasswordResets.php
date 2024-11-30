<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteExpiredPasswordResets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password_resets:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xóa các dòng dữ liệu trong bảng password_resets đã tạo quá 1 giờ trước';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Lấy thời điểm hiện tại trừ đi 1 tiếng
        $expiryTime = Carbon::now()->subHour();

        // Xóa các dòng đã tạo trước thời gian này
        DB::table('password_resets')
            ->where('created_at', '<', $expiryTime)
            ->delete();

        $this->info('Các dòng dữ liệu cũ đã được xóa thành công!');
    }
}
