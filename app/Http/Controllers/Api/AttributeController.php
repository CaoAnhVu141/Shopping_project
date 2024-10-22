<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class AttributeController extends Controller
{
    //
    public function getDataJson()
    {
        $attributes = Attribute::paginate(3);
        return response()->json($attributes);
    }

    // thực thi xoá attribute
    public function deteleDataAttribute($id)
    {
        $attribute = Attribute::find($id);

        if ($attribute) {
            $attribute->delete();
            return response()->json(['message' => 'Xoá thành công!'], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy phần tử!'], 404);
        }
    }

    public function showCreateAttribute()
    {
        return view('Front-end-Admin.attribute.create')->render();
    }
}
