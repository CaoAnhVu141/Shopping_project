<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusHistory;
use App\Models\ShoppingCart;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PayMonneyController extends Controller
{
    // thực hiện thực thi để thanh toán
    public function makePaymentAllItems(Request $request)
    {
        try {
            $cartItems = null;
            if (auth()->check()) {
                $id_customer = auth()->id();
                $cartItems = ShoppingCart::where('id_customer', $id_customer)
                    ->with('product')
                    ->get();
            } else {
                $id_session = Session::getId();
                $cartItems = ShoppingCart::where('id_session', $id_session)
                    ->with('product')
                    ->get();
            }

            // Kiểm tra nếu giỏ hàng trống
            if ($cartItems->isEmpty()) {
                return response()->json(['message' => 'Giỏ hàng của bạn trống'], 400);
            }

            // Định dạng lại dữ liệu giỏ hàng
            $cartItems = $cartItems->map(function ($item) {
                $sizeValue = $item->size ? AttributeValue::find($item->size)->value : null;
                $colorValue = $item->color  ? AttributeValue::find($item->color)->value : null;
                return [
                    'id_product' => $item->id_product,
                    'product_name' => $item->product->name, // Tên sản phẩm từ bảng `products`
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total_price' => $item->total_price,
                    'color' => $sizeValue,
                    'size' => $colorValue
                ];
            });

            return response()->json($cartItems, 200);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về thông báo lỗi
            return response()->json(['message' => 'Đã xảy ra lỗi trong quá trình thanh toán', 'error' => $e->getMessage()], 500);
        }
    }

    // //@thực thi mua hàng
    // public function paymentAllItems(Request $request)
    // {
    //     try {
    //         // Lấy dữ liệu từ request
    //         $name_customer = $request->input('customer_name');
    //         $email_customer = $request->input('customer_email');
    //         $phone_customer = $request->input('customer_phone');
    //         // Lấy các trường Tỉnh, Quận/Huyện, Phường/Xã và tạo địa chỉ
    //         $province = $request->input('method_province');
    //         $district = $request->input('method_district');
    //         $commune = $request->input('method_ward');
    //         $address_details = $request->input('shipping_address'); // Phần địa chỉ chi tiết người dùng nhập
    //         // Kết hợp địa chỉ đầy đủ
    //         $shipping_address = $address_details . ', ' . $commune . ', ' . $district . ', ' . $province;
    //         $id_shipping_method = $request->input('shipping_method');
    //         $id_payment = $request->input('payment_method');
    //         // Lấy id_session và id_customer
    //         $id_session = Session::getId();
    //         $id_customer = auth()->check() ? auth()->id() : null;

    //         // Lấy sản phẩm từ giỏ hàng
    //         $cartItems = ShoppingCart::with('product')
    //             ->where(function ($query) use ($id_customer, $id_session) {
    //                 if ($id_customer) {
    //                     $query->where('id_customer', $id_customer);
    //                 } else {
    //                     $query->where('id_session', $id_session);
    //                 }
    //             })->get();

    //         if ($cartItems->isEmpty()) {
    //             return response()->json([
    //                 'message' => "Giỏ hàng không có dữ liệu",
    //             ], 200);
    //         }

    //         $totalAmount = $cartItems->sum('total_price');

    //         // Tạo đơn hàng
    //         $orders = Order::create([
    //             'id_customer' => $id_customer,
    //             'id_session' => $id_session,
    //             'customer_name' => $name_customer,
    //             'customer_phone' => $phone_customer,
    //             'customer_email' => $email_customer,
    //             'id_shipping_method' => $id_shipping_method,
    //             'id_payment' => $id_payment,
    //             'total_item' => $totalAmount,
    //             'status' => "Đã tiếp nhận",
    //             'shipping_address' => $shipping_address,
    //             'order_date' => now(),
    //         ]);

    //         // Tạo các mục trong orderItems
    //         foreach ($cartItems as $items) {
    //             OrderItem::create([
    //                 'id_order' => $orders->id_order,
    //                 'id_product' => $items->id_product,
    //                 'quantity' => $items->quantity,
    //                 'price' => $items->price,
    //                 'status' => "Đã tiếp nhận",
    //             ]);
    //         }

    //         // Lưu giá trị ở trong lịch sử đặt hàng
    //         OrderStatusHistory::create([
    //             'id_order' => $orders->id_order,
    //             'status' => "Đặt hàng thành công",
    //             'created_at' => now()
    //         ]);

    //         // Xóa sản phẩm trong giỏ hàng sau khi đặt hàng thành công
    //         if ($id_customer) {
    //             ShoppingCart::where('id_customer', $id_customer)->delete();
    //         } else {
    //             ShoppingCart::where('id_session', $id_session)->delete();
    //         }

    //         return response()->json([
    //             'message' => "Đặt hàng thành công",
    //             'order_id' => $orders->id_order,
    //             'redirect_url' => '/success-buy-items'
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Đã xảy ra lỗi khi xử lý đơn hàng', 'error' => $e->getMessage()], 500);
    //     }
    // }

    public function paymentAllItems(Request $request)
    {
        try {
            // Thêm validation
            // $validator = Validator::make($request->all(), [
            //     'customer_name' => 'required|string|max:255',
            //     'customer_phone' => 'required|regex:/^(0[3-9])[0-9]{8}$/', // Định dạng số điện thoại Việt Nam
            //     'customer_email' => 'required|email|max:255',
            //     'method_province' => 'required|string|max:255',
            //     'method_district' => 'required|string|max:255',
            //     'method_ward' => 'required|string|max:255',
            //     'shipping_address' => 'required|string|max:255',
            // ], [
            //     'customer_name.required' => 'Họ và tên không được để trống.',
            //     'customer_phone.required' => 'Số điện thoại không được để trống.',
            //     'customer_phone.regex' => 'Số điện thoại không hợp lệ.',
            //     'customer_email.required' => 'Email không được để trống.',
            //     'customer_email.email' => 'Email không hợp lệ.',
            //     'method_province.required' => 'Vui lòng chọn Tỉnh/Thành phố.',
            //     'method_district.required' => 'Vui lòng chọn Quận/Huyện.',
            //     'method_ward.required' => 'Vui lòng chọn Phường/Xã.',
            //     'shipping_address.required' => 'Địa chỉ chi tiết không được để trống.',
            // ]);

            $validator = Validator::make($request->all(), [
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'required|regex:/^(0[3-9])[0-9]{8}$/', // Số điện thoại Việt Nam
                'shipping_address' => 'required|string|max:255',
            ], [
                'customer_name.required' => 'Họ và tên không được để trống.',
                'customer_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
                'customer_email.required' => 'Email không được để trống.',
                'customer_email.email' => 'Email không hợp lệ.',
                'customer_phone.required' => 'Số điện thoại không được để trống.',
                'customer_phone.regex' => 'Số điện thoại không đúng định dạng.',
                'shipping_address.required' => 'Địa chỉ không được để trống.',
                'shipping_address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            ]);

            // Xử lý khi validation thất bại
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Dữ liệu không hợp lệ',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Logic hiện tại (không thay đổi)
            $name_customer = $request->input('customer_name');
            $email_customer = $request->input('customer_email');
            $phone_customer = $request->input('customer_phone');
            $province = $request->input('method_province');
            $district = $request->input('method_district');
            $commune = $request->input('method_ward');
            $address_details = $request->input('shipping_address');
            $shipping_address = $address_details . ', ' . $commune . ', ' . $district . ', ' . $province;
            $id_shipping_method = $request->input('shipping_method');
            $id_payment = $request->input('payment_method');
            $id_session = Session::getId();
            $id_customer = auth()->check() ? auth()->id() : null;

            $cartItems = ShoppingCart::with('product')
                ->where(function ($query) use ($id_customer, $id_session) {
                    if ($id_customer) {
                        $query->where('id_customer', $id_customer);
                    } else {
                        $query->where('id_session', $id_session);
                    }
                })->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'message' => "Giỏ hàng không có dữ liệu",
                ], 200);
            }

            $totalAmount = $cartItems->sum('total_price');

            $orders = Order::create([
                'id_customer' => $id_customer,
                'id_session' => $id_session,
                'customer_name' => $name_customer,
                'customer_phone' => $phone_customer,
                'customer_email' => $email_customer,
                'id_shipping_method' => $id_shipping_method,
                'id_payment' => $id_payment,
                'total_item' => $totalAmount,
                'status' => "Đã tiếp nhận",
                'shipping_address' => $shipping_address,
                'order_date' => now(),
            ]);

            foreach ($cartItems as $items) {
                OrderItem::create([
                    'id_order' => $orders->id_order,
                    'id_product' => $items->id_product,
                    'quantity' => $items->quantity,
                    'price' => $items->price,
                    'status' => "Đã tiếp nhận",
                ]);
            }

            OrderStatusHistory::create([
                'id_order' => $orders->id_order,
                'status' => "Đặt hàng thành công",
                'created_at' => now()
            ]);

            if ($id_customer) {
                ShoppingCart::where('id_customer', $id_customer)->delete();
            } else {
                ShoppingCart::where('id_session', $id_session)->delete();
            }

            return response()->json([
                'message' => "Đặt hàng thành công",
                'order_id' => $orders->id_order,
                'redirect_url' => '/success-buy-items'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Đã xảy ra lỗi khi xử lý đơn hàng', 'error' => $e->getMessage()], 500);
        }
    }
}
