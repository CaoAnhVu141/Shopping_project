<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function testcai()
    {
        return view('Front-end-Shopping.get_product');
    }
}
