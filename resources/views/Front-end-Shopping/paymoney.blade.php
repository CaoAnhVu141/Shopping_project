@extends('LayOut.shopping.master_shopping')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('shopping/css/paymoney.css') }}">
<link rel="stylesheet" href="{{ asset('shopping/css/api_tinhthanhVn.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                <input type="text" class="form-control" name="customer_name" placeholder="Họ và tên">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="customer_phone" placeholder="Số điện thoại">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="customer_email" placeholder="Email">
            </div>
            <form action="/api/order-items" method="POST" id="orderForm">
            <h6 class="mt-4">Địa chỉ nhận hàng</h6>
            <div class="form-group">
                <div class="css_select_div">
                    <select class="css_select" id="tinh" name="method_province" title="Chọn Tỉnh Thành">
                        <option value="0">Chọn Tỉnh/Thành phố</option>
                    </select>
                    <select class="css_select" id="quan" name="method_district" title="Chọn Quận Huyện" disabled>
                        <option value="0">Chọn Quận/Huyện</option>
                    </select>
                    <select class="css_select" id="phuong" name="method_ward" title="Chọn Phường Xã" disabled>
                        <option value="0">Chọn Phường/Xã</option>
                    </select>
                </div>
            </div>
        </form>
            <div class="form-group">
                <textarea class="form-control" name="shipping_address" placeholder="Nhập địa chỉ chi tiết"></textarea>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="vatInvoice">
                <label class="custom-control-label" for="vatInvoice">Xuất hóa đơn điện tử</label>
            </div>
            <!-- Payment Method Section -->
            <div class="payment-method mt-4">
                <h6>Phương thức thanh toán</h6>
                @foreach ($payment as $items)
                <div class="payment-option">
                    <input type="radio" name="payment_method" value="{{ $items->id_payment }}">
                    <label for="cod"><img src="" alt="COD">{{ $items->payment_method }}</label>
                </div>
                @endforeach
            </div>
            <div class="payment-method mt-4">
                <h6>Phương thức vận chuyển</h6>
                @foreach ($shipping as $items)
                <div class="payment-option">
                    <input type="radio" name="shipping_method" value="{{ $items->id_shipping_method }}">
                    <label for="cod"><img src="" alt="COD">{{ $items->method_name }}</label>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Right Column - Order Summary -->
        <div class="col-md-5">
            <div class="right-summary" id="order-summary-container">
                <h5>Thông tin đơn hàng</h5>
                {{-- Hiển thị tổng tiền bằng JS --}}
            </div>
            <button class="btn btn-order btn-block mt-4" id="btn-order">Đặt hàng</button>
        </div>
    </div>
</div>
<script src="{{ asset('shopping/data_rest/pay_money.js') }}"></script>
<script src="https://esgoo.net/scripts/jquery.js"></script>
<script>
    $(document).ready(function() {
        // Lấy danh sách tỉnh/thành phố
        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
            if (data_tinh.error == 0) {
                $.each(data_tinh.data, function(key_tinh, val_tinh) {
                    $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
                });
            }
        });

        // Khi người dùng chọn Tỉnh/Thành phố
        $("#tinh").change(function() {
            var idtinh = $(this).val();
            if (idtinh != "0") {
                $("#quan").prop("disabled", false);
                // Lấy quận huyện
                $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(data_quan) {
                    if (data_quan.error == 0) {
                        $("#quan").html('<option value="0">Chọn Quận/Huyện</option>');
                        $("#phuong").html('<option value="0">Chọn Phường/Xã</option>');
                        $.each(data_quan.data, function(key_quan, val_quan) {
                            $("#quan").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
                        });
                    }
                });
            } else {
                $("#quan, #phuong").html('<option value="0">Chọn Quận/Huyện hoặc Xã/Phường</option>').prop("disabled", true);
            }
        });

        // Khi người dùng chọn Quận/Huyện
        $("#quan").change(function() {
            var idquan = $(this).val();
            if (idquan != "0") {
                $("#phuong").prop("disabled", false);
                // Lấy phường xã
                $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(data_phuong) {
                    if (data_phuong.error == 0) {
                        $("#phuong").html('<option value="0">Chọn Phường/Xã</option>');
                        $.each(data_phuong.data, function(key_phuong, val_phuong) {
                            $("#phuong").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                        });
                    }
                });
            } else {
                $("#phuong").html('<option value="0">Chọn Phường/Xã</option>').prop("disabled", true);
            }
        });
    });
</script>
@endsection
