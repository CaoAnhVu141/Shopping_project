@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <div class="text-center">
                @if (Session::has('message'))
                    <span class="text-alert" style="color: red; font-weight: bold;">
                        {{ Session::get('message') }}
                    </span>
                    {{ Session::forget('message') }}
                @endif
            </div>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('save-product') }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" placeholder="Tên sản phẩm"
                                value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="price" class="form-control" placeholder="Giá"
                                value="{{ old('price') }}">
                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">SL sản phẩm</label>
                            <input type="text" name="quantity_available" class="form-control" id="convert_slug"
                                value="{{ old('quantity_available') }}">
                            @error('quantity_available')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="images" class="form-control">
                            @if ($errors->has('images'))
                                <span class="text-danger">{{ $errors->first('images') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_desc"
                                placeholder="Mô tả sản phẩm">{{ old('product_desc') }}</textarea>
                            @if ($errors->has('product_desc'))
                                <span class="text-danger">{{ $errors->first('product_desc') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_content"
                                placeholder="Nội dung sản phẩm">{{ old('product_content') }}</textarea>
                            @if ($errors->has('product_content')) <!-- Thêm kiểm tra lỗi cho product_content -->
                                <span class="text-danger">{{ $errors->first('product_content') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                    <option value="{{ $cate->id_category }}" {{ old('product_cate') == $cate->id_category ? 'selected' : '' }}>{{ $cate->category_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_cate'))
                                <span class="text-danger">{{ $errors->first('product_cate') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0" {{ old('product_status') == '0' ? 'selected' : '' }}>Hiển thị</option>
                                <option value="1" {{ old('product_status') == '1' ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                        <a href="{{ route('all_product') }}" class="btn btn-warning">Quay lại</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection