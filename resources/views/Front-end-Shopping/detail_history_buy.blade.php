@extends('LayOut.shopping.master_shopping')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset("shopping/css/view_detail_history.css") }}">
<div class="order-container" id="view-history" data-id-order="{{ $id_order }}">
    {{-- JS sẽ hiển thị dữ liệu ở đây --}}
</div>
<script src="{{ asset('shopping/data_rest/history_detail_buy_items.js')}}"></script>
@endsection
