<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AdminDashboardViewController extends Controller
{
    //Hiện thị theme trang dashboard
    public function showThemeDashBoard()
    {
        $countItems = Order::modelCountSuccesItems();
        $countProducts = Product::countDataProducts();
        $getTotal_items = Order::getAllTotal_itemOrder();
        return view('Front-end-Admin.transaction.dashboard',compact('countItems','countProducts','getTotal_items'));
    }

    // hiện thị toàn bộ đơn hàng
    public function showIndexDashBoard()
    {
        return view('Front-end-Admin.transaction.index');
    }

    // hiện thị view dashboard
    public function showViewDashBoard($id)
    {
        // biên dịch lại id để hiển thị
        try {
            $decryptedId = Crypt::decrypt($id);
            $items = Order::findOrFail($decryptedId);
            if(!$items)
            {
                echo "Ủa sao khum có gì vậy";
            }
            // Trả về view hiển thị, truyền dữ liệu sang view
            return view('Front-end-Admin.transaction.view', compact('items'));
        } catch (\Exception $e) {
            return abort(404, 'Dữ liệu chưa hợp lệ');
        }
    }

    //@truyền qua view về đơn hàng thành công
    // public function showItemsSuccess()
    // {

    //     return view("Front-end-Admin.transaction.view",compact('countItems'));
    // }

}
