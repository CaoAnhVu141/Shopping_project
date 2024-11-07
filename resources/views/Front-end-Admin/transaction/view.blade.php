@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<!-- Breadcrumb và tiêu đề -->
<section class="content-header">
    <h1>View Detail Transaction</h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">Transaction</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<!-- Nội dung chính -->
<section class="content">
    <div class="row">
        <!-- Phần thông tin khách hàng -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Thông Tin Khách Hàng</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Tên KH</td>
                                <td>{{ $items->customer->name }}</td>
                            </tr>
                            <tr>
                                <td>Email KH</td>
                                <td>{{ $items->customer->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone KH</td>
                                <td>{{ $items->customer->phone }}</td>
                            </tr>
                            <tr>
                                <td>Địa Chỉ KH</td>
                                <td>{{ $items->customer->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Phần thông tin đơn hàng -->
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Thông Tin Thêm Về Đơn Hàng</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Trạng Thái</td>
                                <td>{{ $items->status }}</td>
                            </tr>
                            <tr>
                                <td>Tổng Tiền Đơn Hàng</td>
                                <td>{{ $items->total_item }}</td>
                            </tr>
                            <tr>
                                <td>Phương thức thanh toán</td>
                                <td>{{ $items->payment->payment_method }}</td>
                            </tr>
                            <tr>
                                <td>Ngày Mua Đơn Hàng</td>
                                <td>{{ $items->created_at }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Phần chi tiết lịch sử mua hàng -->
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Chi Tiết Về Lịch Sử Mua Hàng</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <th style="width: 75px;">STT -- ID</th>
                                <th>Name</th>
                                <th>Avatar</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                            <!-- Các chi tiết sản phẩm sẽ được chèn ở đây -->
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Nút trở lại -->
        <div class="col-md-12">
            <div class="box-footer" style="text-align: center;">
                <a href="{{ Route('index_dashboard') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
            </div>
        </div>
    </div>
</section>
<script src="{{asset("shopping/data_rest/dashboard.js")}}"></script>
@endsection
