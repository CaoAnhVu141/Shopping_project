@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            Product
            <small>Carete</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Post</a></li>
            <li class="active">Create</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-7">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin cơ bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group ">
                                <label for="a_name">Name</label>
                                <input type="text" name="name" class="form-control" value=""
                                    placeholder="Name ....">

                            </div>
                            <div class="form-group ">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Danh mục bài viết</label>
                                <select name="category_id" class="form-control">
                                    {{-- @comment --}}

                                    {{-- @foreach ($categorypost as $item)
                                        @if ($item->checkstatus == 1)
                                            <option value="{{ $item->id_category }}"
                                                @if ($item->id_category == $selectedCategoryId) selected @endif>{{ $item->name }}
                                            </option>
                                        @endif
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ảnh Đại Diện</h3>
                        </div>
                        <div class="box-body">
                            {{-- <div class="form-group">
                                <label>Ảnh Mới</label>
                                <div style="margin-bottom:10px">

                                    <img id="image_preview_container"
                                        src="{{ asset('images/no-image.jpg') }}"class="img-thumbnail"
                                        style="width: 170px;height:170px" alt="">
                                </div>
                                <input type="file" name="avatar" id="image" class="js-upload">
                            </div> --}}
                            <div class="form-group">
                                <img src="" alt="Ảnh hiện tại" height="300px" width="350px">
                                {{-- <label for="new_avatar">Chọn ảnh mới (nếu có)</label> --}}
                                <input type="file" name="avatar" id="image" class="js-upload">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Content</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea class="form-control" id="editor_js" name="content" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box-footer" style="text-align: center;">
                        <a href="" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </div>
            </form>
            <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
            <script type="text/javascript">
                var options = {
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
                };
                CKEDITOR.replace('editor_js', options);
            </script>

        </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
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
        });
    </script>
@endsection
