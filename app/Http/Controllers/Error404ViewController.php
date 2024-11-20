<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Error404ViewController extends Controller
{
    //
    public function showViewError404()
    {
        return view("Front-end-Shopping.404");
    }
}
