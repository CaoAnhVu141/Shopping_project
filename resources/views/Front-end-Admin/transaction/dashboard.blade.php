@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content" id="content-area">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Đơn hàng thành công</span>
                    <span class="info-box-number"><small>Số lượng: {{ $countItems }}</small></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số người dùng</span>
                    <span class="info-box-number"> <small><a href="">(Chi Tiết)</a></small></span>
                </div>
            </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng sản phẩm có</span>
                    <span class="info-box-number"><small>Số lượng: {{ $countProducts }}</small></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Thu nhập</span>
                    <span class="info-box-number">{{ number_format($getTotal_items, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Đơn hàng mới của bạn</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Account</th>
                                    <th>Money</th>
                                    <th>Status</th>
                                    <th>Phương thức TT</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody id="dashboard_list">
                                {{-- hiện thị danh sách ở chỗ này --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix" style="">
                    <a href="{{ Route('get-orders') }}" id="btn-all-item" class="btn btn-sm btn-info  pull-right">Danh Sách Đơn Hàng</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset("shopping/data_rest/dashboard.js")}}"></script>
@endsection
