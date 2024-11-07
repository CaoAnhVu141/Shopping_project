@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            Article
            <small>index</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Article</a></li>
            <li class="active">list</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="" class="btn btn-primary">Thêm mới </a>
                        </h3>
                        {{-- <h3 class="box-title"><a href="{{ route('addpost') }}" class="btn btn-primary">Danh mục bài viết </a></h3> --}}
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
                                <th>name</th>
                                <th>Menu</th>
                                <th>Avatar</th>
                                <th>Times</th>
                                <th>Action</th>
                            </tr>
                            {{-- @comment --}}
                            {{-- @php
                                $count = 0;
                            @endphp --}}

                            {{-- @if ($posts->total() > 0)
                                @if(isset($posts))
                                    @foreach ($posts as $item)
                                        @php
                                            $count ++;
                                        @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td><img src="{{ url($item->avatar) }}" alt="" height="80px"></td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="{{ route('updatepost',['id'=>$item->id_post]) }}"
                                                   class="btn btn-xs btn-primary"
                                                   onclick="return confirm('Bạn chắc sửa không nè')"><i
                                                        class="fa fa-pencil"></i> Edit</a>
                                                <a href="{{ route('deletepost',['id'=>$item->id_post]) }}"
                                                   class="btn btn-xs btn-danger js-delete-confirm"
                                                   onclick="return confirm('Bạn chắc xoá không nè')"><i
                                                        class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @else
                                <h3>Rất tiếc, không tìm thấy dữ liệu</h3>
                            @endif --}}

                            </tbody>
                        </table>

                        {{-- @comment --}}
                        <div id="pageNavPosition" class="text-right">
                            {{-- <ul class="pagination">
                                <!-- Hiển thị link đến trang trước (Previous Page) -->
                                @if ($posts->onFirstPage())
                                    <li class="disabled"><span>&laquo;</span></li>
                                @else
                                    <li><a href="{{ $posts->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif

                                <!-- Hiển thị các số trang đã có -->
                                @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                    <li class="{{ $i == $posts->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $posts->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <!-- Hiển thị link đến trang tiếp theo (Next Page) -->
                                @if ($posts->hasMorePages())
                                    <li><a href="{{ $posts->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                @else
                                    <li class="disabled"><span>&raquo;</span></li>
                                @endif
                            </ul> --}}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    {{-- <div>{!! $articles->links() !!}</div> --}}
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
