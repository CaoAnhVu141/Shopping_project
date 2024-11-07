@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{URL::to('save-category-product')}}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="category_product_name">Tên danh mục</label>
                            <input type="text" class="form-control" onkeyup="ChangeToSlug();" name="category_product_name" id="slug" placeholder="Danh mục">
                            <!-- Hiển thị lỗi cho trường 'category_product_name' -->
                            @if($errors->has('category_product_name'))
                                <span class="text-danger">{{ $errors->first('category_product_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="category_product_desc">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc" id="category_product_desc" placeholder="Mô tả danh mục"></textarea>
                            <!-- Hiển thị lỗi cho trường 'category_product_desc' -->
                            @if($errors->has('category_product_desc'))
                                <span class="text-danger">{{ $errors->first('category_product_desc') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="category_product_status">Hiển thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                        <a href="{{URL::to('all-category-product')}}" class="btn btn-warning">Quay lại</a> <!-- Nút quay lại -->
                    </form>
                </div>

            </div>
        </section>

    </div>
@endsection
