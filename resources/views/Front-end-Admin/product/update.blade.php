@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            Product
            <small>Update</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Product</a></li>
            <li class="active">update</li>

        </ol>
    </section>
 
    <section class="content">
        
        <div class="row">
        
            <form action="{{ url('updateproduct',['productId' => $products->id_product]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-7">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin cơ bản</h3>
                        </div>
                        <div class="box-body">
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="form-group">
                                <label for="pro_name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name ...." value="{{$products->name}}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="pro_price">Giá</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="number" name="price" class="form-control" value="{{$products->price}}" >
                                    <span class="input-group-addon"></span>
                                </div>
                                <small id="emailHelp" class="form-text text-muted "></small>

                            </div>

                            <div class="form-group">
                                <label for="pro_sale">% Giảm Giá</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" name="discount" class="form-control"  value="{{$products->discount}}">
                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control"  name="description" rows="3" placeholder="Enter ...">{{$products->description}}</textarea>
                            </div>
                       
                            <div class="form-group">
                                <label>Danh Mục (*)</label>
                                <select name="category_id" class="form-control js-check-type" data-url="">
                                    @if (isset($category))
                                        @foreach ($category as $item)
                 
                                                <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                                 
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type Product (*)</label>
                                <select name="typeproduct_id" class="form-control js-type-product">
                                    @if (isset($typeproducts))
                                        @foreach ($typeproducts as $item)                                   
                                                <option value="{{ $typeproducts->id_producttype }}">{{ $typeproducts->name }}</option>      
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Supplier (*)</label>
                                <select name="supplier_id" class="form-control js-type-product">
                                    @if(isset($supplier))
                                        @foreach ($supplier as $item)
                                            <option value="{{ $supplier->supplier_id }}">{{$supplier->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>                      
                            <div class="form-group">
                                <label for="pro_name">Size</label>
                                <input type="text" name="sizes" class="form-control" value="{{$products->sizes}}" placeholder="Enter sizes separated by commas">
                                <small class="form-text text-muted">Enter sizes separated by commas (e.g., Small, Medium, Large).</small>
                            </div>
                            

                        </div>
                    </div>
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Attribute</h3>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <h5>Loại dây</h5>
                            </div>
                            <div class="col-sm-4">
                                <h5>Đường kính mặt</h5>

                            </div>
                            <div class="col-sm-4">
                                <h5>Năng lượng</h5>
                            </div>
                        </div>
                        <div class="box-body js-attribute">
                            @if (isset($attributes))
                                <div class="row">
                                    @foreach ($attributes as $attribute)
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="attribute[]" value="{{ $attribute->id_attribute }}">{{ $attribute->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                                       
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Content</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea class="form-control" name="content" rows="3" placeholder="Enter ...">{{$products->content}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ảnh Đại Diện</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Ảnh Mới</label>
                                <div style="margin-bottom:10px">
                                    <img id="image_preview_container" src="{{asset($products->image)}}"
                                        class="img-thumbnail" style="width: 220px;height:200px" alt="">
                                </div>
                                <input type="file" name="image" id="image" class="js-upload">
                            </div>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Album ảnh</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="file-loading">
                                    <input type="file" name="file[]" id="file" multiple class="file" value="{{$products->list_images}}"
                                        data-overwrite-initial="false" data-min-file-count="0">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5">
                    <div class="box box-warning">
                        <div class="box-header">
                            <h3 class="box-title">Thuộc Tính</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group col-sm-6">
                                <label>Số Lượng</label>
                                <input type="number" name="amount"  value="{{$products->amount}}" class="form-control" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box-footer" style="text-align: center;">
                        <a href="{{ route('indexproduct') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở
                            Lại</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"></script>

@endsection
@section('script')
    <script>
        $(function() {

            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            //run js-select2-keyword
            if ($('.js-select2-keyword').length > 0) {
                $('.js-select2-keyword').select2({
                    placeholder: 'Chọn Keyword',
                    maximumSelectionLength: 3
                });

            }
            $('.js-check-type').change(function() {
                let $this = $(this);
                let idCategory = this.value;
                let URL = $this.attr('data-url') + '/' + idCategory;
                if (URL) {
                    $.ajax({
                        url: URL,
                        // data:{
                        //     idCategory:idCategory
                        // },
                        success: function(results) {
                            $('.js-type-product').html(results.type_product)
                            $('.js-attribute').html(results.attribute)
                        },
                        error: function(error) {
                            console.log(error.messages);
                        }
                    });
                }
            });
        });
    </script>
@endsection
