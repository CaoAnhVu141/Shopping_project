@extends('LayOut.admin-dashboard.master_admin')

@section('content')
<section class="content-header">
    <h1>
      Attribute
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="">Attribute</a></li>
      <li class="active">list</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content" id="content-area">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><a href="" class="btn btn-primary" id="create-attribute">Thêm mới </a></h3>
                <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="search-key" class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>CheckActive</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="attribute-list">
                    <!-- Dữ liệu sẽ được hiển thị tại đây thông qua JavaScript -->
                  </tbody>
                </table>
                <!-- Phân trang bắt đầu -->
                <div id="pageNavPosition" class="text-right">
                  <ul class="pagination" id="pagination-links">
                    <!-- Các nút phân trang sẽ được hiển thị tại đây thông qua JavaScript -->
                  </ul>
                </div>
                <!-- Phân trang kết thúc -->
              </div>
            </div>
          </div>
    </div>
    <script src="{{ asset('shopping/js/attribute.js') }}"></script>
  </section>
<script src="{{ asset("shopping/data_rest/attribute.js") }}"></script>
@endsection
