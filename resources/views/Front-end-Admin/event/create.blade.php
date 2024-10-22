@extends('LayOut.admin-dashboard.master_admin')
@section('content')
    <section class="content-header">
        <h1>
            Add Event
            <small>Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Events</a></li>
            <li class="active">Add Event</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add New Event</h3>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="content">Event Content:</label>
                                <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="text-danger">{{ $errors->first('content') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="fileInput">Image<span class="text-danger">(*)</span></label>
                                <input type="file" class="form-control-file" id="fileInput" name="image" required>
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="check_active">Active</label>
                                <select name="check_active" id="check_active" class="form-control" required>
                                    <option value="1" {{ old('check_active') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('check_active') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @if ($errors->has('check_active'))
                                    <span class="text-danger">{{ $errors->first('check_active') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_day" class="form-control" id="start_day" value="{{ old('start_day') }}" required>
                                @if ($errors->has('start_day'))
                                    <span class="text-danger">{{ $errors->first('start_day') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_day" class="form-control" id="end_day" value="{{ old('end_day') }}" required>
                                @if ($errors->has('end_day'))
                                    <span class="text-danger">{{ $errors->first('end_day') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
