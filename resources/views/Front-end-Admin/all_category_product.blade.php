@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
    </div>
    <div class="row w3-res-tb">
     
      <div class="col-sm-4">
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
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
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
            
            <td><span class="text-ellipsis">
              <?php
               if($cate_pro->category_status==0){
                ?>
                <a href="{{URL::to('unactive-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('active-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
               }
              ?>
            </span></td>
           
            <td>
              <a href="{{URL::to('edit-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('delete-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
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
             {!!$all_category_product->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
<script>
        // Hàm gọi API và hiển thị danh mục sản phẩm
        function fetchCategories() {
            fetch('/api/categories')
                .then(response => response.json())  // Chuyển đổi dữ liệu thành JSON
                .then(data => {
                    let categoryList = document.getElementById('category-list');
                    let html = '<table class="table table-striped b-t b-light">';
                    html += '<thead><tr><th>Tên danh mục</th><th>Hiển thị</th><th></th></tr></thead><tbody>';

                    // Duyệt qua danh sách danh mục và tạo các dòng HTML tương ứng
                    data.data.forEach(function(category) {
                        html += '<tr>';
                        html += '<td>' + category.category_name + '</td>';
                        html += '<td>' + (category.category_status === 0 ? 'Hiển thị' : 'Ẩn') + '</td>';
                        html += '<td><button onclick="deleteCategory(' + category.category_id + ')">Xóa</button></td>';
                        html += '</tr>';
                    });

                    html += '</tbody></table>';
                    categoryList.innerHTML = html; // Hiển thị danh mục lên giao diện
                })
                .catch(error => console.error('Error fetching categories:', error));
        }

        // Gọi hàm fetchCategories khi trang load
        document.addEventListener('DOMContentLoaded', fetchCategories);

        // Hàm xóa danh mục (nếu cần)
        function deleteCategory(id) {
            if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
                fetch('/api/category/' + id, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(data => {
                        alert('Xóa thành công!');
                        fetchCategories(); // Tải lại danh sách sau khi xóa
                    })
                    .catch(error => console.error('Error deleting category:', error));
            }
        }
    </script>

@endsection