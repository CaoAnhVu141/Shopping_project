<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TestController extends Controller
{
    //
    public function testcai()
    {
        return view('Front-end-Shopping.demo-thanhtoan');
    }
}
