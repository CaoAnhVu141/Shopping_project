<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryViewController extends Controller
{
    //
    public function index()
    {
        return view('Front-end-Admin.category.demo');
    }
}
