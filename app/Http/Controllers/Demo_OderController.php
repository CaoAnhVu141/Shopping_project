<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class Demo_OderController extends Controller
{
    //
    // public function testcai()
    // {
    //     return view('Front-end-Admin.transaction.view');
    // }

    public function showData()
    {
        $orders = Order::paginate(5);
        return view('Front-end-Admin.transaction.index', ['orders' => $orders]);
    }

    public function showView()
    {
        return view('Front-end-Admin.transaction.view');
    }
}
