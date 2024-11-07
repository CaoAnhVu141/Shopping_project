@extends('LayOut.shopping.master_shopping')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('shopping/css/purchase-product.css') }}">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="history-container">
    <div class="history-header">
        <h2>Lịch sử mua hàng</h2>
        <input type="text" placeholder="Tìm kiếm...">
    </div>

    <!-- Item 1 -->
    <div class="order-item">
        <div class="order-img">
            <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid">
        </div>
        <div class="order-info">
            <p><strong>Xịt thơm quần áo Vemoda khử mùi</strong>, kháng khuẩn, chiết xuất tinh dầu thiên nhiên và nước hoa, thơm vải tươi mát cả ngày.</p>
            <p>Ngày đặt hàng: 10/10/2024</p>
        </div>
        <div class="order-price">
            <del>118.000₫</del>
            <div class="new-price">89.000₫</div>
            <div class="order-total">
                <p>Thành tiền: <span class="new-price">78.000₫</span></p>
            </div>
            <div class="order-action">
                <button class="btn-rebuy">Mua lại</button>
            </div>
        </div>
    </div>

    <!-- Item 2 -->
    <div class="order-item">
        <div class="order-img">
            <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid">
        </div>
        <div class="order-info">
            <p><strong>Xịt thơm quần áo Vemoda khử mùi</strong>, kháng khuẩn, chiết xuất tinh dầu thiên nhiên và nước hoa, thơm vải tươi mát cả ngày.</p>
            <p>Ngày đặt hàng: 10/10/2024</p>
        </div>
        <div class="order-price">
            <del>118.000₫</del>
            <div class="new-price">89.000₫</div>
            <div class="order-total">
                <p>Thành tiền: <span class="new-price">78.000₫</span></p>
            </div>
            <div class="order-action">
                <button class="btn-rebuy">Mua lại</button>
            </div>
        </div>
    </div>

    <!-- Item 3 -->
    <div class="order-item">
        <div class="order-img">
            <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid">
        </div>
        <div class="order-info">
            <p><strong>Xịt thơm quần áo Vemoda khử mùi</strong>, kháng khuẩn, chiết xuất tinh dầu thiên nhiên và nước hoa, thơm vải tươi mát cả ngày.</p>
            <p>Ngày đặt hàng: 10/10/2024</p>
        </div>
        <div class="order-price">
            <del>118.000₫</del>
            <div class="new-price">89.000₫</div>
            <div class="order-total">
                <p>Thành tiền: <span class="new-price">78.000₫</span></p>
            </div>
            <div class="order-action">
                <button class="btn-rebuy">Mua lại</button>
            </div>
        </div>
    </div>

</div>
@endsection