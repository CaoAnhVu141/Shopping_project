@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
  <h1>
    Sản phẩm
    <small>Danh sách</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="">Sản phẩm</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><a href="{{ URL::to('add-product') }}" class="btn btn-primary">Thêm mới</a></h3>
          <div class="box-tools">
            <form action="{{ URL::to('search-product') }}" method="GET" class="input-group input-group-sm"
              style="width: 200px;">
              <input type="text" name="search" class="form-control pull-right" placeholder="Tìm kiếm">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
        </div>
        <div class="box-body">
          <div class="text-center">
            @if (Session::has('message'))
        <span id="success-message" class="text-alert" style="color: red; font-weight: bold;">
          {{ Session::get('message') }}
        </span>
        {{ Session::forget('message') }}
      @endif
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width:20px;">
                    <label class="i-checks m-b-none">
                      <input type="checkbox"><i></i>
                    </label>
                  </th>
                  <th>Tên sản phẩm</th>
                  <th>Giá</th>
                  <th>Số lượng</th>
                  <th>Hot</th>
                  <th>Giảm giá (%)</th>

                  <th>Hình sản phẩm</th>               
                  <th>Danh mục</th>
                  <th>Hiển thị</th>
                  <th style="width:30px;"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($all_product as $key => $pro)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $pro->product_name }}</td>
              <td>{{ number_format($pro->product_price, 0, ',', '.') }}đ</td>
              <td>{{ $pro->product_quantity }}</td>
              <td>{{ $pro->hot ? 'Có' : 'Không' }}</td>
              <td>{{ $pro->sale }}%</td>
              <!-- <td>{{ number_format($pro->discounted_price, 0, ',', '.') }}đ</td> -->
              <td><img src="uploads/product/{{ $pro->product_image }}" height="100" width="100"></td>
              <td>{{ $pro->category_name }}</td>
              <td>
              <span class="text-ellipsis">
            @if($pro->product_status == 0)
            <a href="{{ URL::to('unactive-product/'.$pro->product_id) }}">
            <span class="fa-thumb-styling fa fa-thumbs-up"></span>
            </a>
            @else
            <a href="{{ URL::to('active-product/'.$pro->product_id) }}">
            <span class="fa-thumb-styling fa fa-thumbs-down"></span>
            </a>
            @endif
            </span>
          </td>
              <td>
              <a href="{{ URL::to('edit-product/' . $pro->product_id) }}" class="active styling-edit">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                href="{{ URL::to('delete-product/' . $pro->product_id) }}" class="active styling-edit">
                <i class="fa fa-times text-danger text"></i>
              </a>
              </td>
            </tr>
        @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            {!! $all_product->links() !!}
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Tự động ẩn thông báo sau 3 giây
  setTimeout(function () {
    var message = document.getElementById("success-message");
    if (message) {
      message.style.display = "none";
    }
  }, 2000);
</script>
@endsection



<script>
  document.addEventListener('DOMContentLoaded', function () {
    fetchProducts();
  });

  function fetchProducts() {
    fetch('/api/products')
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        let tableBody = document.getElementById('product-table-body');
        tableBody.innerHTML = '';

        data.forEach(product => {
          tableBody.innerHTML += 
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>${product.product_name}</td>
              <td>${new Intl.NumberFormat().format(product.product_price)}đ</td>
              <td><img src="uploads/product/${product.product_image}" height="100" width="100"></td>
              <td>${product.category_name}</td>
              <td>
                <span class="text-ellipsis">
                  ${product.product_status == 0 ? 
                    <a href="/unactive-product/${product.product_id}">
                      <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                    </a>
                   : 
                    <a href="/active-product/${product.product_id}">
                      <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                    </a>
                  }
                </span>
              </td>
              <td>
                <a href="/edit-product/${product.product_id}" class="active styling-edit">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" href="/delete-product/${product.product_id}" class="active styling-edit">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
          ;
        });
      })
      .catch(error => {
        console.error('Error fetching products:', error);
        // Có thể thêm thông báo cho người dùng ở đây
      });
  }
</script>