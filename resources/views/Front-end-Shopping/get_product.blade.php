@extends('LayOut.shopping.master_shopping')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('shopping/css/get-product.css') }}">
<div class="container mt-5">
    <h2 class="mb-4">Đơn hàng đã nhận</h2>

    <!-- Product 1 -->
    <div class="row order-card">
        <div class="col-md-2 d-flex align-items-center">
            <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid product-img">
        </div>
        <div class="col-md-7">
            <p class="product-title">Áo khoác gió nam-nữ 2 lớp Mũ Rộng có túi trong sâu, Áo khoác dù chất liệu vải gió cao cấp cản gió kháng nước</p>
            <p class="text-muted">Hạn đánh giá: 14/10/2024</p>
            <p>
                <span class="product-old-price">118.000đ</span>
                <span class="product-price">80.000đ</span>
            </p>
        </div>
        <div class="col-md-3 buttons">
            <button class="btn btn-review">Đánh giá</button>
            <button class="btn btn-return">Trả hàng</button>
        </div>
    </div>

    <!-- Product 2 -->
    <div class="row order-card">
        <div class="col-md-2 d-flex align-items-center">
            <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid product-img">
        </div>
        <div class="col-md-7">
            <p class="product-title">[HOT] Loa Bluetooth Mini Loa bluetooth mini di động cầm tay Đèn LED Đổi Màu - Tặng Kèm Dây Sạc</p>
            <p class="text-muted">Hạn đánh giá: 14/10/2024</p>
            <p>
                <span class="product-old-price">118.000đ</span>
                <span class="product-price">37.000đ</span>
            </p>
        </div>
        <div class="col-md-3 buttons">
            <button class="btn btn-review">Đánh giá</button>
            <button class="btn btn-return">Trả hàng</button>
        </div>
    </div>

    <!-- Product 3 (Hết hạn đánh giá) -->
    <div class="row order-card">
        <div class="col-md-2 d-flex align-items-center">
            <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid product-img">
        </div>
        <div class="col-md-7">
            <p class="product-title">Nước hoa nam Choice Việt Nam TH003 thơm lâu 55ml</p>
            <p class="text-muted">Hạn đánh giá: 02/10/2024</p>
            <p>
                <span class="product-old-price">118.000đ</span>
                <span class="product-price">80.000đ</span>
            </p>
        </div>
        <div class="col-md-3 d-flex justify-content-end align-items-center">
            <span class="expired">Đơn hàng đã hết thời hạn đánh giá</span>
        </div>
    </div>

</div>
@endsection