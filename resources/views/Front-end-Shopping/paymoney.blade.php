@extends('LayOut.shopping.master_shopping')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('shopping/css/paymoney.css') }}">
<div class="container container-checkout">
    <div class="row">
        <!-- Left Column - Product Details and Form -->
        <div class="col-md-7">
            <h5 class="mb-4">Tiến hành thanh toán</h5>
            <div id="cart-items-container">
                {{-- Hiển thị sản phẩm sẽ ở nơi này --}}
            </div>

            <h6 class="mt-4">Người đặt hàng</h6>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Họ và tên">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Số điện thoại">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email (Không bắt buộc)">
            </div>

            <h6 class="mt-4">Hình thức nhận hàng</h6>
            <div class="form-group">
                <select class="form-control">
                    <option selected>Chọn Tỉnh/Thành Phố, Quận/Huyện, Phường/Xã</option>
                </select>
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Ghi chú (Ví dụ: Hãy gọi tôi khi chuẩn bị hàng xong)"></textarea>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="vatInvoice">
                <label class="custom-control-label" for="vatInvoice">Xuất hóa đơn điện tử</label>
            </div>

            <!-- Payment Method Section -->
            <div class="payment-method mt-4">
                <h6>Phương thức thanh toán</h6>
                <div class="payment-option">
                    <input type="radio" id="cod" name="paymentMethod">
                    <label for="cod"><img src="" alt="COD">Thanh toán khi nhận hàng</label>
                </div>
                <div class="payment-option">
                    <input type="radio" id="momo" name="paymentMethod">
                    <label for="momo"><img src="" alt="Momo">Thanh toán bằng ví MoMo</label>
                </div>
                <div class="payment-option">
                    <input type="radio" id="zalopay" name="paymentMethod">
                    <label for="zalopay"><img src="" alt="ZaloPay">Thanh toán bằng ví ZaloPay</label>
                </div>
                <!-- Add more payment options as needed -->
            </div>
        </div>

        <!-- Right Column - Order Summary -->
        <div class="col-md-5">

            <div class="right-summary" id="order-summary-container">
                <h5>Thông tin đơn hàng</h5>
                {{-- hiện tổng tiền nơi này bằng js --}}
                {{-- <button class="btn btn-order btn-block mt-4">Đặt hàng</button> --}}
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("shopping/data_rest/pay_money.js") }}"></script>
@endsection