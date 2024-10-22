@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Quản lý đơn hàng
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="">transaction</a></li>
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
                    <div class="box-title">
                        <form action="" method="GET" class="form-inline">
                            <input type="text" value="" class="form-control" name="id" placeholder="ID">
                            <input type="text" value="" class="form-control" name="email" placeholder="Email ...">
                            {{-- <select name="type" class="form-control">
                                <option value="0">__Phân Loại Khách__</option>
                                <option value="1" {{ Request::get('type') == 1 ? "selected='selected'" : "" }}>Thành Viên</option>
                                <option value="2" {{ Request::get('type') == 2 ? "selected='selected'" : "" }}>Khách</option>
                            </select> --}}
                            <select name="status" class="form-control">
                                <option value="0">__Trạng Thái__</option>
                                <option value="1">Tiếp Nhận</option>
                                <option value="2">Đang Vận Chuyển</option>
                                <option value="3">Đã Bàn Giao</option>
                                <option value="-1">Hủy Bỏ</option>
                            </select>
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i> Search</button>
                        </form>
                    </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>ID</th>
                      <th>Info</th>
                      <th>Money</th>
                      <th>Status</th>
                      <th>Phương thức TT</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                    @foreach ($orders as $item)
                            <tr>
                                <td></td>
                                <td>
                                    <ul>
                                        <li>Name: {{ $item->id_customer }}</li>
                                        <li>Email:</li>
                                        <li>Phone:</li>
                                        <li>Address: {{ $item->shipping_address }}</li>
                                    </ul>
                                </td>

                                <td></td>
                                <td>
                                    {{-- @comment --}}
                                    {{-- @if($item->status == 'Huỷ')
                                        <span class="label label-danger" style="cursor: default; pointer-events: none;">
                                            {{ $item->status }}
                                        </span>
                                    @else
                                        <span class="label label-success" style="cursor: default; pointer-events: none;">
                                            {{ $item->status }}
                                        </span>
                                    @endif --}}
                                </td>                                
                                {{-- <td>đây là thanh toán</td> --}}    
                                <td>
                                    <span class="label label-warning" style="cursor: default; pointer-events: none;">
                                        yes sir
                                    </span>
                                </td>
                                
                                <td>{{ date("d/m/Y H:i:s") }}</td>
                                <td>
                                    <a href="{{ route("view") }}" class="btn btn-xs btn-info js-preview-view"><i class="fa fa-eye"></i>View</a>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-xs">Action</button>
                                        <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="" class=""><i class="fa fa-trash js-delete-confirm" onclick="return confirm('Bạn chắc chắn là xoá chứ')"></i> Delete</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href=""><i class="fa fa-ban"> Đang Vận Chuyển</i></a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fa fa-ban"> Đã Bàn Giao</i></a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fa fa-ban"> Hủy</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              {{-- {!! $listOder->links() !!} --}}
              <div></div>
            </div>
            <!-- /.box -->
          </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
  </section>
    {{--  <div class="modal fade fade" id="modal-preview-transaction" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Chi Tiết Đơn hàng <b></b></h4>
                </div>
                <div class="modal-body">
                    <div class="content">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  --}}
  <!-- /.content -->
@endsection
{{--  @section('script')
    <script>
        $('.js-preview-transaction').click(function(e){
            e.preventDefault();
            let $this=$(this);
            let URL=$this.attr('href');
            $.ajax({
                url:URL,
                success:function(results){
                    $('#modal-preview-transaction .content').html(results.html)
                    $('#modal-preview-transaction').modal({
                        show:true
                    });
                },
                error:function(e){
                    console.log(e.message);
                }
            });
        });
        $('body').on('click','.js-delete-order-item',function(event){
            event.preventDefault();
            let URL=$(this).attr('href');
            let $this=$(this);
            $.ajax({
                url:URL,
                success:function(results){
                    if(results.code==200){
                        $this.parents('tr').remove();
                    }
                },
                error:function(e){
                    console.log(e.message);
                }
            })
        });
    </script>
@endsection  --}}
