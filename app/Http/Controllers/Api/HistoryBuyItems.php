<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HistoryBuyItems extends Controller
{
    //
    //Hiển thị danh sách đơn hàng
    public function getAllBuyItemsHistory()
    {
        $buyItems = null;
        if (auth()->check()) {
            $id_customer = auth()->id();
            $buyItems = Order::where('id_customer', $id_customer)
                ->with('orderStatusHistory')
                ->get();
        } else {
            $id_session = Session()->getid();
            $buyItems = Order::where('id_session', $id_session)
                ->with('orderStatusHistory')
                ->get();
        }
        if ($buyItems->isNotEmpty()) {
            return response()->json([
                'message' => "Đã có dữ liệu mua hàng",
                'data' => $buyItems
            ], 200);
        }
        return response()->json([
            'message' => "Không có dữ liệu mua hàng"
        ], 404);
    }


    //@Danh sách lịch sử đặt hàng
    public function getOrderHistoryDetails($id_order)
    {
        $orderHistory = OrderStatusHistory::where('id_order', $id_order)
            ->whereHas('order', function ($query) {
                if (auth()->check()) {
                    $query->where('id_customer', auth()->id());
                } else {
                    $query->where('id_session', Session::getId());
                }
            })
            ->with(['order' => function ($query) {
                $query->with('orderItems.product');
            }])
            ->get();

        if ($orderHistory->isNotEmpty()) {
            return response()->json([
                'message' => 'Lấy dữ liệu thành công',
                'data' => $orderHistory,
            ], 200);
        }

        return response()->json([
            'message' => 'Không có dữ liệu lịch sử cho đơn hàng này',
        ], 404);
    }

    //@thực hiện huỷ đơn hàng
    public function cancelOrderItems($id_order)
    {
        $order = Order::find($id_order);
        if(!$id_order)
        {
            return response()->json([
                'message' => "Không tìm thấy giá trị"
            ],404);
        }

            if($order->status === "Đã tiếp nhận")
            {
                $order->status = "Huỷ";
                $order->save();
                return response()->json([
                    'message' => "Huỷ đơn hàng thành công",
                    'data' => $order,
                ],200);
            }

            return response()->json([
                'message' => "Không thể huỷ đơn hàng",
            ],400);
    }
}
