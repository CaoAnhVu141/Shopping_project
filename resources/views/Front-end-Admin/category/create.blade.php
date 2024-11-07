@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            CateGory
            <small>Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="">Category</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="box box-primary">
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="col-sm-8">
                            <div class="form-group {{ $errors->first('category_name') ? 'has-error' : '' }}">
                                <label for="name">Name<span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" name="category_name" placeholder="Name ......"
                                       required>
                                {{-- @comment --}}
                                {{-- @if ($errors->first('category_name'))
                                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                @endif --}}
                            </div>
                            <div class="form-group {{ $errors->first('category_description') ? 'has-error' : '' }}">
                                <label>Description<span class="text-danger">(*)</span></label>
                                <textarea class="form-control" name="category_description" rows="3"
                                          placeholder="Enter ..." required></textarea>
                                {{-- @comment --}}
                                {{-- @if ($errors->first('category_description'))
                                    <span class="text-danger">{{ $errors->first('category_description') }}</span>
                                @endif --}}
                            </div>
                            {{-- <div class="form-group {{ $errors->first('category_image') ? 'has-error' : '' }}">
                                <label for="fileInput">Image<span class="text-danger">(*)</span></label>
                                <input type="file" class="form-control-file" id="fileInput" name="category_image"
                                       required> --}}
                                {{-- @comment --}}
                                {{-- @if ($errors->first('category_image'))
                                    <span class="text-danger">{{ $errors->first('category_image') }}</span>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
    </section>
@endsection
@section('script')
    <script>
        $(function () {
            $('#image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
