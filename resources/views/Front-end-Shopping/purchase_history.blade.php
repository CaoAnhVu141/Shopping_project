@extends('LayOut.shopping.master_shopping')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('shopping/css/purchase-product.css') }}">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="history-container">
    <div class="history-header">
        <h2>Lịch sử mua hàng</h2>
        <input type="text" id="btn-buyitems" placeholder="Tìm kiếm...">
        <button type="submit" class="btn btn-default" id="btn-search"><i class="fa fa-search"></i></button>
    </div>
    <div id="order-items">
        {{-- hiển thị giá trị sẽ ở nơi đây bằng js--}}
    </div>
    <div id="pagination" class="pagination">
        {{-- Phân trang sẽ hiển thị ở nơi này --}}
    </div>

</div>
<script src="{{ asset("shopping/data_rest/history_list_buy_items.js") }}"></script>
@endsection