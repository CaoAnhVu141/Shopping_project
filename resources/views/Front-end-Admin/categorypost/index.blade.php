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
                        <h3 class="box-title"><a href="{{ Route('category-post-showadd') }}" class="btn btn-primary">Thêm
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
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                                @php
                                    $count = 0;
                                @endphp
                                @if(isset($category_post))
                                    @foreach ($category_post as $items)
                                        @php
                                            $count ++;
                                        @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $items->name }}</td>
                                           {{-- <td><span class="{{ $item->getType($item->atb_type)['class'] }}"></span></td> --}}
                                             <td>{{ $items->describe }}</td>
                                            <td>{{ $items->created_at }}</td>
                                            <td>
                                                <a href="{{ Route('update-category-post',['id' => $items->id_category_post]) }}"
                                                   class="btn btn-xs btn-primary"
                                                   onclick="return confirm('Bạn chắc chắn là sửa chứ')"><i
                                                        class="fa fa-pencil"></i> Edit</a>
                                                <a href="{{ Route('delete-category-post',['id' => $items->id_category_post]) }}"
                                                   class="btn btn-xs btn-danger js-delete-confirm"
                                                   onclick="return confirm('Bạn chắc chắn là xoá chứ')"><i
                                                        class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div id="pageNavPosition" class="text-right">
                            <ul class="pagination">
                                {{-- @comment --}}

                                <!-- Hiển thị link đến trang trước (Previous Page) -->
                                {{-- @if ($categorypost->onFirstPage())
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
                                @endif --}}
                            </ul>
                        </div>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>

    </section>

@endsection
