<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TestController extends Controller
{
    //
    public function testcai()
    {
        return view('Front-end-Shopping.purchase_history');
    }

    // public function testLayId_session()
    // {
    //     $id_session = session()->getId();
    //     Log::info("Session ID in getItemsCartShopping: " . $id_session);
    // }
}
