<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardViewController extends Controller
{
    //Hiện thị theme trang dashboard
    public function showThemeDashBoard()
    {
        return view('Front-end-Admin.transaction.dashboard');
    }

    // hiện thị toàn bộ đơn hàng
    public function showIndexDashBoard()
    {
        return view('Front-end-Admin.transaction.index');
    }


}