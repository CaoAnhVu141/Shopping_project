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
        // Lấy danh sách phương thức vận chuyển với phân trang, mỗi trang 3 phương thức
        $shippingMethods = ShippingMethod::paginate(3);

        // Nếu yêu cầu là AJAX, trả về dữ liệu dưới dạng JSON
        if ($request->ajax()) {
            return response()->json([
                'shippingMethods' => $shippingMethods,
                'pagination' => (string) $shippingMethods->links()
            ]);
        }

        // Trả về view nếu không phải yêu cầu AJAX
        return view('Front-end-Admin.shipping_methods.index', compact('shippingMethods'));
    }

}

