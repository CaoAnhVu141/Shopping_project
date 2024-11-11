@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Product
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="">Product</a></li>
      <li class="active">list</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                    <h3 class="box-title"><a href="" class="btn btn-primary">Thêm mới </a></h3>
                </div>
                <div class="box-title">
                    <form action="" method="GET" class="form-inline">
                        <input type="text" value="{{ Request::get('id_product') }}" class="form-control" name="id" placeholder="ID">
                        <input type="text" value="{{ Request::get('name') }}" class="form-control" name="name" placeholder="name ...">
                        <select name="category" class="form-control">
                            <option value="0">__Danh Mục__</option>
                        </select>
                        <select name="sort" class="form-control">
                            <option value="0" >Xắp Xếp</option>
                            <option value="1" {{ Request::get('sort') == 1 ? "selected='selected'" : "" }}>Cũ -> Mới</option>
                            <option value="2" {{ Request::get('sort') == 2 ? "selected='selected'" : "" }}>Mới -> Cũ</option>
                            <option value="3" {{ Request::get('sort') == 3 ? "selected='selected'" : "" }}>Giá Thấp -> Cao</option>
                            <option value="4" {{ Request::get('sort') == 4 ? "selected='selected'" : "" }}>Giá Cao -> Thấp</option>
                        </select>
                        <select name="hot" class="form-control">
                            <option value="">_ Hot _</option>
                            <option value="1" {{ Request::get('hot') == 1 ? "selected='selected'" : "" }}>Sản Phẩm Hót</option>
                            <option value="2" {{ Request::get('hot') == 2 ? "selected='selected'" : "" }}>Sản Phẩm Không Hót</option>
                        </select>
                        <select name="status" class="form-control">
                            <option value="">_ Active _</option>
                            <option value="1" {{ Request::get('status') == 1 ? "selected='selected'" : "" }}>Sản Phẩm active</option>
                            <option value="2" {{ Request::get('status') == 2 ? "selected='selected'" : "" }}>Sản Phẩm Không active</option>
                        </select>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i> Search</button>
                        {{--  <button type="submit" name="export" value="true" class="btn btn-info">
                            <i class="fa fa-save"> </i> Export
                        </button>  --}}
                    </form>
                </div>
              <!-- /.box-header -->
                <div id="js-data">
                    @include('Front-end-Admin.product.data')
                </div>
              <!-- /.box-body -->
              <div></div>
            </div>
            <!-- /.box -->
          </div>
    </div>
  </section>
  <!-- /.content -->
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(document).on('click','.status-actives',function(e){
            e.preventDefault();
            var URL = $(this).attr('href');
            console.log(URL);
            fetch_data(URL);
        });

        function fetch_data(URL){
            $.ajax({
                url:URL,
                type:"GET",
                success:function(results){
                    $('#js-data').html(results.data);
                    if(results.messages) {
                        toastr.success(results.messages);
                    }
                }
            });
        }
  
  });
  </script> 
@endsection
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

