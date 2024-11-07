@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            Suppliers
            <small>Update</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Supplier</a></li>
            <li class="active">Update</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="box box-primary">
                <form action="{{ route('updatedatasupplier',$suppliers->id_supplier) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                                <label>Name<span class="text-danger">(*)</span></label>
                                <input class="form-control" name="name" value="{{ $suppliers->name }}" rows="3"
                                       placeholder="Enter ..." required></input>
                                @if ($errors->first('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
                                <label>Description<span class="text-danger">(*)</span></label>
                                <textarea class="form-control" name="description" rows="3"
                                          placeholder="Enter ..." required>{{ $suppliers->description }}</textarea>
                                @if ($errors->first('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                                <label>Email<span class="text-danger">(*)</span></label>
                                <input class="form-control" name="email" value="{{ $suppliers->email }}" rows="3"
                                       placeholder="Enter ..." required></input>
                                @if ($errors->first('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                                <label>Phone<span class="text-danger">(*)</span></label>
                                <input class="form-control" name="phone" value="{{ $suppliers->phone }}" rows="3"
                                       placeholder="Enter ..." required></input>
                                @if ($errors->first('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="fileInput">Image</label>
                                <input type="file" class="form-control-file" id="fileInput" name="image">
                            </div>
                            <div>
                                <img src="{{ asset($suppliers->image) }}" alt="Ảnh hiện tại" height="300px">
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
