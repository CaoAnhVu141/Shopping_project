@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            Category Post
            <small>index</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href=""> Category Post</a></li>
            <li class="active">list</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('addcategorypost') }}" class="btn btn-primary">Thêm
                                mới </a></h3>
                        <div class="box-tools">
                            <form action="#">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="key" value="{{ request()->input('key') }}"
                                           class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>CheckActive</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>

                            @if($categorypost->total() > 0)
                                @php
                                    $count = 0;
                                @endphp
                                @if(isset($categorypost))
                                    @foreach ($categorypost as $item)
                                        @php
                                            $count ++;
                                        @endphp
                                        <tr>
                                            <td>{{ $count }}</td>

                                            <td>{{ $item->name }}</td>
                                            {{-- <td><span class="{{ $item->getType($item->atb_type)['class'] }}"></span></td> --}}
                                            <td>{{ $item->discription }}</td>
                                            <td>
                                                @if ($item->checkstatus == 1)
                                                    <a href="{{ route('showorhidecategorypost',['id'=>$item->id_category]) }}"
                                                       class="label label-info status-active">Show</a>
                                                @else
                                                    <a href="{{ route('showorhidecategorypost',['id'=>$item->id_category]) }}"
                                                       class="label label-default status-active">Hide</a>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="{{ route('updatecategorypost',['id'=>$item->id_category]) }}"
                                                   class="btn btn-xs btn-primary"
                                                   onclick="return confirm('Bạn chắc chắn là sửa chứ')"><i
                                                        class="fa fa-pencil"></i> Edit</a>
                                                <a href="{{ route('deletecategorypost',['id'=>$item->id_category]) }}"
                                                   class="btn btn-xs btn-danger js-delete-confirm"
                                                   onclick="return confirm('Bạn chắc chắn là xoá chứ')"><i
                                                        class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @else
                                <h3>Rất tiêc, dữ liệu không tìm thấy</h3>
                            @endif

                            </tbody>
                        </table>
                        <div id="pageNavPosition" class="text-right">
                            <ul class="pagination">
                                <!-- Hiển thị link đến trang trước (Previous Page) -->
                                @if ($categorypost->onFirstPage())
                                    <li class="disabled"><span>&laquo;</span></li>
                                @else
                                    <li><a href="{{ $categorypost->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif

                                <!-- Hiển thị các số trang đã có -->
                                @for ($i = 1; $i <= $categorypost->lastPage(); $i++)
                                    <li class="{{ $i == $categorypost->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $categorypost->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <!-- Hiển thị link đến trang tiếp theo (Next Page) -->
                                @if ($categorypost->hasMorePages())
                                    <li><a href="{{ $categorypost->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                @else
                                    <li class="disabled"><span>&raquo;</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    {{--  {!! $attribute->links() !!}  --}}
                    <div></div>
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
