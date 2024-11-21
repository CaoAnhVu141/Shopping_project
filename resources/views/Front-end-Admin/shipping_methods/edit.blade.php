@extends('LayOut.admin-dashboard.master_admin')

@section('content')
    <section class="content-header">
        <h1>Edit Shipping Method</h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Shipping Methods</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit Shipping Method</h3>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('shipping-method.update', $shippingMethod->id_shipping_method) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="method_name">Method Name</label>
                                <input type="text" class="form-control" id="method_name" name="method_name" 
                                    value="{{ old('method_name', $shippingMethod->method_name) }}" required>
                                @error('method_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="number" class="form-control" id="cost" name="cost" 
                                    value="{{ old('cost', $shippingMethod->cost) }}" required>
                                @error('cost')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="estimated_time">Estimated Time</label>
                                <input type="text" class="form-control" id="estimated_time" name="estimated_time" 
                                    value="{{ old('estimated_time', $shippingMethod->estimated_time) }}" required>
                                @error('estimated_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('shipping-methods.index') }}" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
