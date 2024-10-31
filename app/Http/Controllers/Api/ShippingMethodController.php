<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingMethodController extends Controller
{
    // Lấy danh sách phương thức vận chuyển
    public function index()
    {
        $shippingMethods = ShippingMethod::all();
        return response()->json($shippingMethods);
    }

    // Thêm phương thức vận chuyển mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'method_name' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'cost' => 'nullable|numeric',
            'estimated_time' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $shippingMethod = ShippingMethod::create([
            'method_name' => trim($request->method_name),
            'cost' => $request->cost ?? 0,
            'estimated_time' => $request->estimated_time ?? now()->format('d/m/Y'),
        ]);

        return response()->json($shippingMethod, 201);
    }

    // Cập nhật phương thức vận chuyển
    public function update(Request $request, $id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'method_name' => 'sometimes|required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'cost' => 'sometimes|nullable|numeric',
            'estimated_time' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $shippingMethod->update([
            'method_name' => trim($request->method_name) ?? $shippingMethod->method_name,
            'cost' => $request->cost ?? $shippingMethod->cost,
            'estimated_time' => $request->estimated_time ?? $shippingMethod->estimated_time,
        ]);

        return response()->json($shippingMethod);
    }

    // Xóa phương thức vận chuyển
    public function destroy($id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->delete();

        return response()->json(['message' => 'Phương thức vận chuyển đã được xóa.']);
    }
}
