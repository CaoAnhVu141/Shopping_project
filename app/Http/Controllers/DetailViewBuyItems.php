<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DetailViewBuyItems extends Controller
{
    //Hiển thị chi tiết sản phẩm đã mua
    public function viewDetailBuyItems($id_order)
    {
        return view('Front-end-Shopping.detail_history_buy',compact('id_order'));
    }
}
