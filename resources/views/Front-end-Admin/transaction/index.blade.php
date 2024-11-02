@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>
        Quản lý đơn hàng
        <small>index</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">transaction</a></li>
        <li class="active">list</li>
    </ol>
</section>
<!-- Main content -->
<section class="content" id="list_demo">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <form action="" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="email" id="search_email"
                                placeholder="Email ...">
                                <select name="status" class="form-control" id="status_active">
                                    <option value="">__Trạng Thái__</option>
                                    <option value="Đã tiếp nhận">Đã tiếp nhận</option>
                                    <option value="Đang chuẩn bị">Đang chuẩn bị</option>
                                    <option value="Đang Vận Chuyển">Đang Vận Chuyển</option>
                                    <option value="Đã bàn giao">Đã bàn giao</option>
                                    <option value="Hủy">Hủy Bỏ</option>
                                </select>
                            <button type="submit" class="btn btn-success" id="btn-search"><i class="fa fa-search"> </i>
                                Search</button>
                        </form>
                    </div>
                </div>
                <div id="loading-indicator" style="display:none;">Loading...</div>
                <!-- .box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Status</th>
                                <th>Phương thức TT</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="list_item" style="height: 100px">
                            <!-- Nội dung sẽ được thêm vào đây bằng JavaScript -->
                        </tbody>
                    </table>
                    <div id="pageNavPosition" class="text-right">
                        <ul class="pagination" id="pagination-links">
                            <!-- Các nút phân trang sẽ được hiển thị tại đây thông qua JavaScript -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
{{-- <div class="modal fade" id="modal-preview-transaction">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Chi Tiết Đơn hàng <b></b></h4>
            </div>
            <div class="modal-body">
                <div class="content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}
<script src="{{ asset(" shopping/data_rest/dashboard.js") }}"></script>
@endsection