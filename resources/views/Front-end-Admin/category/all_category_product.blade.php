@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                    <!-- Nút Thêm mới -->
                    <a href="{{ route('add_category_product') }}" class="btn btn-primary">
                        Thêm mới
                    </a>
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Thông báo sẽ hiển thị ra giữa và có màu đỏ -->
            <div class="row">
                <div class="col-sm-12 text-center">
                    @if (Session::has('message'))
                        <span class="text-alert" style="color: red; font-weight: bold;">
                            {{ Session::get('message') }}
                        </span>
                        {{ Session::forget('message') }}
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>Tên danh mục</th>
                            <th>Hiển thị</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_category_product as $key => $cate_pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $cate_pro->category_name }}</td>
                            <td>
                                <span class="text-ellipsis">
                                    @if($cate_pro->category_status == 0)
                                        <a href="{{ URL::to('unactive-category-product/'.$cate_pro->category_id) }}">
                                            <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                        </a>
                                    @else
                                        <a href="{{ URL::to('active-category-product/'.$cate_pro->category_id) }}">
                                            <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                        </a>
                                    @endif
                                </span>
                            </td>
                            <td>
                                <a href="{{ URL::to('edit-category-product/'.$cate_pro->category_id) }}" class="active styling-edit">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{ URL::to('delete-category-product/'.$cate_pro->category_id) }}" class="active styling-edit">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!! $all_category_product->links() !!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/categories',
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
