@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <h1>
        CateGory
        <small>index</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">Category</a></li>
        <li class="active">list</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="" class="btn btn-primary">Thêm mới </a></h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right ajax-search-table"
                                placeholder="Search" data-url="">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <!-- Table content -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                <th>Người thêm</th>
                                <th>Chỉnh sửa</th>
                            </tr>
                        </thead>
                        <tbody id="category-list">
                            <!-- Dữ liệu sẽ được hiển thị tại đây bởi JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Gọi API khi trang load
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/category')  // Gọi API
            .then(response => response.json())  // Chuyển đổi phản hồi thành JSON
            .then(categories => {
                const categoryList = document.getElementById('category-list');
                categoryList.innerHTML = '';  // Xóa nội dung cũ nếu có

                categories.forEach((category, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${category.id_category}</td>
                        <td><img src="${category.image}" width="150px" height="100px" /></td>
                        <td>${category.name}</td>
                        <td>${category.describe}</td>
                        <td>${category.checkactive ? 'Show' : 'Hide'}</td>
                        <td>${category.created_at}</td>
                        <td>${category.updated_at}</td>
                        <td>${category.added_by}</td>
                        <td>
                            <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    `;
                    categoryList.appendChild(tr);
                });
            })
            .catch(error => {
                console.error('Lỗi khi lấy dữ liệu:', error);
            });
    });
</script>

@endsection
