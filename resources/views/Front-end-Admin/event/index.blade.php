@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            Events
            <small>index</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href=""> Events</a></li>
            <li class="active">list</li>
        </ol>
    </section>
    <section class="content">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <a href="{{route('create')}}" class="btn btn-primary">Thêm mới </a>
                        </h3>
                        <div class="box-tools">
                            <form action="#">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="key" value="{{ request()->input('key') }}" class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Check Active</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($events->total() > 0)
                                    @php $count = 0; @endphp
                                    @foreach ($events as $event)
                                        @php $count++; @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->content }}</td>
                                            <td>
                                                @if($event->image)
                                                    <img src="{{ asset('images/events/' . $event->image) }}" alt="{{ $event->name }}" width="100">
                                                @else
                                                    No image
                                                @endif
                                            </td>
                                            <td>{{ $event->check_active ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $event->start_day }}</td>
                                            <td>{{ $event->end_day }}</td>
                                            <td>{{ $event->created_at }}</td>
                                            <td>{{ $event->updated_at }}</td>
                                            <td style="display: flex; gap: 4px;">
                                                <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                <form action="{{ route('deleteEvent', ['id' => $event->id_event]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Bạn chắc chắn là xoá chứ?')">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">Rất tiếc, không có dữ liệu</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phân trang -->
        <div id="pageNavPosition" class="text-right">
            {{ $events->links() }} 
        </div>
    </section>
@endsection
