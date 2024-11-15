<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistotyViewBuyItems extends Controller
{
    //
    public function showViewHistoryBuyItems()
    {
        return view('Front-end-Shopping.purchase_history');
    }
}
