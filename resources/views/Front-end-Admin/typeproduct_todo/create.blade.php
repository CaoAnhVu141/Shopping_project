@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <h1>
        Product Type
      <small>Carete</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="">TyPe Pro</a></li>
      <li class="active">Create</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

    <div class="box box-primary">
        <form action="{{url('add-producttype/run')}}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="name">Names <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Name ......" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>              
                    <div class="form-group">
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">(*)</span></label>
                            <textarea class="form-control" name="description" placeholder="Description ....." required></textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('indexproducttype') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
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
@endsection
@section('script')
    <script>
        $(function(){
            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                  $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
