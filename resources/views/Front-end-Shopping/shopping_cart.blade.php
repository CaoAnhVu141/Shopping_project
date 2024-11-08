@extends('LayOut.shopping.master_shopping')
@section('content')

<div class="container">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">
            Shoping Cart
        </span>
    </div>
</div>
<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Phần hiển thị sản phẩm -->
            <div class="col-lg-8 col-xl-8 m-b-50">
                <div class="m-l-25 m-r-25 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1"></th>
                                <th class="column-2">Name</th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-6">Xoá</th>
                            </tr>
                            <tbody id="items-shoppingcart">
                                {{-- các giá trị của toàn bộ giỏ hàng sẽ được hiện thị ở đây --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
                            <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                Apply coupon
                            </div>
                        </div>
                        <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            Update Cart
                        </div>
                    </div>
                </div>
            </div>
            <!-- Phần tổng tiền -->
            <div class="col-lg-4 col-xl-4 m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-25 m-r-25 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Tạm tính:
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110 cl2" id="subtotal">
                                0 đ
                            </span>
                        </div>
                    </div>
                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Vận chuyển:
                            </span>
                        </div>
                    </div>
                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Tổng tiền:
                            </span>
                        </div>
                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2" id="total">
                                $0
                            </span>
                        </div>
                    </div>
                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Thanh toán
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset("shopping/data_rest/getItems_shoppingcart.js") }}"></script>
@endsection