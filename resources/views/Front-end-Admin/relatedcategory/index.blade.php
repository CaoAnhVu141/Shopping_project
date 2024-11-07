@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Related Category
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="">TyPe</a></li>
      <li class="active">list</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><a href="{{ route('addrelated') }}" class="btn btn-primary">Thêm mới </a></h3>
                <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>category</th>
                      <th>Avatar</th>
                      <th>Status</th>
                      <th>Hot</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                    @if(isset($type_products))
                        @foreach ($type_products as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->tp_name }}</td>
                                <td>{{ $item->category->c_name }}</td>
                                <td><img src="{{ pare_url_file($item->tp_avatar) }}" alt="" width="150px" height="100px"> </td>
                                <td>
                                    @if ($item->tp_status==1)
                                        <a href="" class="label label-info status-active">show</a>
                                    @else
                                         <a href="" class="label label-default status-active">hide</a>
                                    @endif
                                </td>
                               
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="" class="btn btn-xs btn-danger js-delete-confirm"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
                {{-- {!! $type_products->appends($query ?? [])->links() !!} --}}
              </div>
            
              <!-- /.box-body -->

            </div>
            <!-- /.box -->
          </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
  </section>
  <!-- /.content -->
@endsection
