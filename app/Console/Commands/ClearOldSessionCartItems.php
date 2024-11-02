<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShoppingCart;
use Carbon\Carbon;

class ClearOldSessionCartItems extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:clear-old-sessions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cart items with sessions older than 30 days';

    /**
     * Execute the console command.
     */
    // Đặt tên và mô tả cho command


    public function handle()
    {
        //
        // Tính ngày 30 ngày trước
        $expirationDate = Carbon::now()->subDays(30);

        // Xoá các bản ghi có `updated_at` cũ hơn 30 ngày
        $deletedRows = ShoppingCart::where('updated_at', '<', $expirationDate)->delete();

        // Hiển thị thông báo số bản ghi đã xoá
        $this->info("Deleted $deletedRows old session cart items.");
    }
}
