@extends('LayOut.admin-dashboard.master_admin')
@section('content')

<section class="content-header">
    <h1>
      Danh mục sản phẩm
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Danh mục sản phẩm</a></li>
      <li class="active">Liệt kê</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <a href="{{ route('add_category_product') }}" class="btn btn-primary">Thêm mới</a>
                    </h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Tìm kiếm">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hiển thị thông báo nếu có -->
                <div class="text-center">
                    @if (Session::has('message'))
                        <span class="text-alert" style="color: red; font-weight: bold;">
                            {{ Session::get('message') }}
                        </span>
                        {{ Session::forget('message') }}
                    @endif
                </div>
                
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tên danh mục</th>
                                <th>Hiển thị</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_category_product as $key => $cate_pro)
                            <tr>
                             
                                <td>{{ $cate_pro->category_name }}</td>
                                <td>
                                    @if($cate_pro->category_status == 0)
                                        <a href="{{ URL::to('unactive-category-product/'.$cate_pro->category_id) }}" class="label label-info">Hiển thị</a>
                                    @else
                                        <a href="{{ URL::to('active-category-product/'.$cate_pro->category_id) }}" class="label label-default">Ẩn</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ URL::to('edit-category-product/'.$cate_pro->category_id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Sửa</a>
                                    <a href="{{ URL::to('delete-category-product/'.$cate_pro->category_id) }}" class="btn btn-xs btn-danger js-delete-confirm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="box-footer clearfix">
                    {!! $all_category_product->links() !!}
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/category',
                method: 'GET',
                success: function(data) {
                    let rows = '';
                    data.data.forEach(function(category) {
                        rows += '<tr>' +
                            '<td>' + category.category_name + '</td>' +
                            '<td>' + (category.category_status == 0 ? 'Không kích hoạt' : 'Kích hoạt') + '</td>' +
                            '<td><a href="/edit-category-product/' + category.category_id + '">Edit</a></td>' +
                            '</tr>';
                    });
                    $('#category-table-body').html(rows);
                },
                error: function(error) {
                    console.error('Có lỗi xảy ra:', error);
                }
            });
        });
    </script>
@endsection
