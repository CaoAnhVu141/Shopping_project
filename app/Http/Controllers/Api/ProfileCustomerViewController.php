<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileCustomerViewController extends Controller
{
    //
    public function showViewProfileCustomer()
    {
        return view("Front-end-Shopping.profile_customer");
    }
}
