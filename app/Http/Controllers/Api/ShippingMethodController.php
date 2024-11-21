<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingMethodController extends Controller
{
    // Lấy danh sách phương thức vận chuyển
    public function index(Request $request)
    {
        $perPage = 3;  // Số phương thức vận chuyển mỗi trang

        // Lấy dữ liệu với phân trang
        $shippingMethods = ShippingMethod::paginate($perPage);

        // Trả về dữ liệu phương thức vận chuyển với thông tin phân trang
        return response()->json([
            'status' => 'success',
            'data' => $shippingMethods
        ]);
    }

    // Thêm phương thức vận chuyển mới
    // Hàm để thêm phương thức vận chuyển mới
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric',
        ]);

        // Tạo phương thức vận chuyển mới
        $shippingMethod = ShippingMethod::create([
            'name' => $validated['name'],
            'cost' => $validated['cost'],
        ]);

        // Trả về phản hồi dưới dạng JSON
        return response()->json([
            'status' => 'success',
            'data' => $shippingMethod
        ]);
    }


    // Xem chi tiết phương thức vận chuyển
    public function show($id)
    {
        $shippingMethod = ShippingMethod::find($id);

        if (!$shippingMethod) {
            return response()->json([
                'status' => 'error',
                'message' => 'Phương thức vận chuyển không tồn tại.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $shippingMethod
        ]);
    }

    // Cập nhật phương thức vận chuyển
    public function update(Request $request, $id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);

        // Validation
        $validator = Validator::make($request->all(), [
            'method_name' => 'sometimes|required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'cost' => 'sometimes|nullable|numeric|min:0',
            'estimated_time' => 'sometimes|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        // Cập nhật thông tin phương thức vận chuyển
        $shippingMethod->update([
            'method_name' => $request->method_name ?? $shippingMethod->method_name,
            'cost' => $request->cost ?? $shippingMethod->cost,
            'estimated_time' => $request->estimated_time ?? $shippingMethod->estimated_time,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Phương thức vận chuyển đã được cập nhật.',
            'data' => $shippingMethod
        ]);
    }

    // Xóa phương thức vận chuyển
    public function destroy($id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);

        // Xóa phương thức vận chuyển
        $shippingMethod->delete();

        return view response()->json([
            'status' => 'success',
            'message' => 'Phương thức vận chuyển đã được xóa.'
        ]);
    }
}
