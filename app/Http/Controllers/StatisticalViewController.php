<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticalViewController extends Controller
{
    //
    public function showStatisticalView()
    {
        return view('Front-end-Admin.statistical.index');
    }
}
