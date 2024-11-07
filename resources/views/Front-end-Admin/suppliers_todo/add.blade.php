@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            Suppliers
            <small>Carete</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Attribute</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="box box-primary">
                <form action="{{ route('adddatasupplier') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                                <label>Name<span class="text-danger">(*)</span></label>
                                <input class="form-control" name="name" rows="3" placeholder="Enter ..."
                                       required></input>
                                @if ($errors->first('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
                                <label>Description<span class="text-danger">(*)</span></label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."
                                          required></textarea>
                                @if ($errors->first('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                                <label>Email<span class="text-danger">(*)</span></label>
                                <input class="form-control" name="email" rows="3" placeholder="Enter ..."
                                       required></input>
                                @if ($errors->first('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                                <label>Phone<span class="text-danger">(*)</span></label>
                                <input class="form-control" name="phone" rows="3" placeholder="Enter ..."
                                       required></input>
                                @if ($errors->first('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('category_image') ? 'has-error' : '' }}">
                                <label for="fileInput">Image<span class="text-danger">(*)</span></label>
                                <input type="file" class="form-control-file" id="fileInput" name="image" required>
                                @if ($errors->first('category_image'))
                                    <span class="text-danger">{{ $errors->first('category_image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('indexsupplier') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
@endsection
