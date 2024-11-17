@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <h1>
        Category Post
        <small>Update</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">Attribute</a></li>
        <li class="active">Create</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <form action="{{ Route('updatecategorypost',$category_post->id_category_post) }}" method="POST">
                @csrf
                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="namecategory" value="{{ $category_post->name }}"
                                placeholder="Name ......">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="descriptioncategory" rows="3"
                                    placeholder="Enter ...">{{ $category_post->describe }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                </div>
        </div>
        </form>
    </div>
    </div>
</section>
@endsection