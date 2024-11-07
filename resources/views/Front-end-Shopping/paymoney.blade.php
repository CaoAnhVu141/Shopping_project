@extends('LayOut.shopping.master_shopping')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('shopping/css/paymoney.css') }}">
<div class="container container-checkout">
    <div class="row">
        <!-- Left Column - Product Details and Form -->
        <div class="col-md-7">
            <h5 class="mb-4">Sản phẩm trong đơn (1)</h5>
            <div class="product-info">
                <img src="" alt="Product Image">
                <div class="ml-3">
                    <h6>Chuột có dây Rapoo N200</h6>
                    <small>Màu: Đen</small>
                </div>
                <div class="text-right">
                    <span>119.000 đ</span>
                </div>
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
                <div class="custom-control custom-radio">
                    <input type="radio" id="homeDelivery" name="deliveryMethod" class="custom-control-input" checked>
                    <label class="custom-control-label" for="homeDelivery">Giao hàng tận nơi</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="storePickup" name="deliveryMethod" class="custom-control-input">
                    <label class="custom-control-label" for="storePickup">Nhận tại cửa hàng</label>
                </div>
            </div>

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
                    <input type="radio" id="vnpay" name="paymentMethod">
                    <label for="vnpay"><img src="" alt="VNPay">Thanh toán bằng thẻ ATM nội địa (Qua VNPay)</label>
                </div>
                <div class="payment-option">
                    <input type="radio" id="visa" name="paymentMethod">
                    <label for="visa"><img src="" alt="Visa">Thanh toán bằng thẻ quốc tế Visa, Master, JCB, AMEX, Apple Pay, Google Pay</label>
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
            <div class="right-summary">
                <h5>Thông tin đơn hàng</h5>
                <div class="order-summary">
                    <div class="item">
                        <span>Tổng tiền:</span>
                        <span>119.000 đ</span>
                    </div>
                    <div class="item">
                        <span>Tổng khuyến mãi:</span>
                        <span>0 đ</span>
                    </div>
                    <div class="item">
                        <span>Phí vận chuyển:</span>
                        <span>Miễn phí</span>
                    </div>
                    <hr>
                    <div class="total">
                        <span>Cần thanh toán:</span>
                        <span>119.000 đ</span>
                    </div>
                </div>

                <button class="btn btn-order btn-block mt-4">Đặt hàng</button>
            </div>
        </div>
    </div>
</div>
@endsection