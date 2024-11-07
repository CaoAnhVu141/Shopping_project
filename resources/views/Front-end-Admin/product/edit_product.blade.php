@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
            </header>
            @if(Session::has('message'))
                <span class="text-alert">{{ Session::get('message') }}</span>
                {{ Session::forget('message') }}
            @endif
            <div class="panel-body">
                <div class="position-center">
                    @foreach($edit_product as $key => $pro)
                    <form role="form" action="{{URL::to('update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" value="{{ old('product_name', $pro->product_name) }}">
                            @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">SL sản phẩm</label>
                            <input type="text" name="product_quantity" class="form-control" id="convert_slug" value="{{ old('product_quantity') }}">
                                                  
                            @error('product_quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{ old('product_price', $pro->product_price) }}">
                            @error('product_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giảm giá (%)</label>
                            <input type="text" name="sale" class="form-control" value="{{ old('sale', $pro->sale) }}" placeholder="Nhập phần trăm giảm giá">
                            @error('sale')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('uploads/product/'.$pro->product_image)}}" height="100" width="100">
                            @error('product_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="ckeditor2">{{ old('product_desc', $pro->product_desc) }}</textarea>
                            @error('product_desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="ckeditor3">{{ old('product_content', $pro->product_content) }}</textarea>
                            @error('product_content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                    <option value="{{ $cate->category_id }}" {{ $cate->category_id == old('product_cate', $pro->category_id) ? 'selected' : '' }}>
                                        {{ $cate->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_cate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0" {{ old('product_status', $pro->product_status) == '0' ? 'selected' : '' }}>Ẩn</option>
                                <option value="1" {{ old('product_status', $pro->product_status) == '1' ? 'selected' : '' }}>Hiển thị</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Sản phẩm hot</label>
                            <select name="hot" class="form-control input-sm m-bot15">
                                <option value="0" {{ old('hot', $pro->hot) == '0' ? 'selected' : '' }}>Không</option>
                                <option value="1" {{ old('hot', $pro->hot) == '1' ? 'selected' : '' }}>Có</option>
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
