<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttributeViewController extends Controller
{
    //
    public function showThemmeAttributeIndex()
    {
        return view('Front-end-Admin.attribute.index');
    }


}
