<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Hiển thị danh sách phương thức vận chuyển với phân trang
     */
    // ShippingMethodController.php
    public function indexView(Request $request)
    {
        // Khởi tạo query builder
        $query = ShippingMethod::query();
        // Nếu có từ khóa tìm kiếm, áp dụng điều kiện tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $query->where('method_name', 'like', '%' . $request->search . '%');
        }
        // Phân trang kết quả
        $shippingMethods = $query->paginate(3);

        // Trả về dữ liệu dưới dạng JSON cho Ajax
        if ($request->ajax()) {
            return response()->json([
                'shippingMethods' => $shippingMethods->items(),
                'pagination' => $shippingMethods->links()->toHtml(), // Lấy phân trang dưới dạng HTML
            ]);
        }

        // Trả về view với biến shippingMethods
        return view('Front-end-Admin.shipping_methods.index', compact('shippingMethods'));
    }



    // Hiển thị form tạo phương thức vận chuyển
    public function create()
    {
        return view('Front-end-Admin.shipping_methods.create');
    }

    // Xử lý việc lưu phương thức vận chuyển mới
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'method_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s]+$/', // Điều kiện: chỉ cho phép chữ, số và khoảng trắng
            ],
            'cost' => 'required|numeric',
            'estimated_time' => [
                'required',
                'string',
                'max:255',
            ],
        ]);


        // Tạo phương thức vận chuyển mới
        ShippingMethod::create([
            'method_name' => $request->method_name,
            'cost' => $request->cost,
            'estimated_time' => $request->estimated_time,
        ]);

        // Redirect về trang danh sách phương thức vận chuyển
        return redirect()->route('shipping-methods.index')->with('success', 'Phương thức vận chuyển đã được thêm thành công!');
    }
    public function edit($id)
    {
        // Tìm phương thức vận chuyển theo ID
        $shippingMethod = ShippingMethod::findOrFail($id);

        // Trả về view với thông tin phương thức vận chuyển
        return view('Front-end-Admin.shipping_methods.edit', compact('shippingMethod'));
    }





    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'method_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s]+$/', // Điều kiện: chỉ cho phép chữ, số và khoảng trắng
            ],
            'cost' => 'required|numeric',
            'estimated_time' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $shippingMethod = ShippingMethod::find($id);
        if (!$shippingMethod) {
            // Nếu không tìm thấy phương thức vận chuyển, quay lại trang danh sách và hiển thị thông báo lỗi
            return redirect()->route('shipping-methods.index')
                ->with('error', 'Shipping method not found or invalid ID.');
        }

        // Tìm và cập nhật phương thức vận chuyển
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->method_name = $request->method_name;
        $shippingMethod->cost = $request->cost;
        $shippingMethod->estimated_time = $request->estimated_time;
        $shippingMethod->save();

        // Chuyển hướng về danh sách phương thức vận chuyển
        return redirect()->route('shipping-methods.index')->with('success', 'Shipping method updated successfully');
    }
    public function destroy($id)
    {
        try {
            // Kiểm tra nếu ID không phải số
            if (!is_numeric($id)) {
                return redirect()->back()->with('error', 'Invalid ID format.');
            }

            // Tìm phương thức vận chuyển theo ID
            $method = ShippingMethod::find($id);

            // Kiểm tra nếu không tìm thấy
            if (!$method) {
                return redirect()->back()->with('error', 'Shipping method not found.');
            }

            // Xóa phương thức vận chuyển
            $method->delete();

            return redirect()->route('shipping-methods.index')->with('success', 'Shipping method deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Xử lý lỗi liên quan đến cơ sở dữ liệu
            return redirect()->back()->with('error', 'Database error: Unable to delete the shipping method.');
        } catch (\Exception $e) {
            // Xử lý lỗi chung khác
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }





}

