@extends('LayOut.admin-dashboard.master_admin')
@section('content')

<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tổng Số Đơn Hàng</span>
                    <span class="info-box-number"><small><a href="">(Chi Tiết)</a></small></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Thành Viên</span>
                    <span class="info-box-number"> <small><a href="">(Chi Tiết)</a></small></span>
                </div>
            </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sản Phẩm</span>
                    <span class="info-box-number"> <small><a href="">(Chi Tiết)</a></small></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Fix Bug</span>
                    <span class="info-box-number">++</span>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row" style="margin-bottom: 20px">
        <div class="col-sm-8">
            <figure class="highcharts-figure">
                <div id="container2" data-list-day="{{ $listDay }}"
                    data-money-default="{{ $arrRevenueTransactionMonthDefault }}"
                    data-money="{{ $arrRevenueTransactionMonth }}"></div>
            </figure>
        </div>
        <div class="col-sm-4">
            <figure class="highcharts-figure">
                <div id="container" data-json="{{ $statusTransaction }}"></div>
            </figure>
        </div>
    </div> --}}
    {{-- <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Doanh Thu</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <span style="color: red">Không chọn gì mặc định lấy các ngày trong tháng và năm hiện tại.</span>
                        <div class="box-title">
                            <form action="" method="GET" class="form-inline">
                                <select name="day" class="form-control">
                                    <option value="">_ Ngày trong tháng _</option>
                                    @for ($i = 1; $i <=31; $i++) <option value="{{$i}}" {{ Request::get('day')==$i
                                        ? "selected='selected'" : "" }}>Ngày {{$i}}</option>
                                        @endfor
                                </select>
                                <select name="month" class="form-control">
                                    <option value="">_ Tháng trong năm _</option>
                                    @for ($i = 1; $i <=12; $i++) <option value="{{$i}}" {{ Request::get('month')==$i
                                        ? "selected='selected'" : "" }}>Tháng {{$i}}</option>
                                        @endfor
                                </select>
                                <select name="year" class="form-control">
                                    <option value="">_ Năm _</option>
                                    <option value="2019" {{ Request::get('year')==2019 ? "selected='selected'" : "" }}>
                                        Năm 2019</option>
                                    <option value="2020" {{ Request::get('year')==2020 ? "selected='selected'" : "" }}>
                                        Năm 2020</option>
                                    <option value="2021" {{ Request::get('year')==2021 ? "selected='selected'" : "" }}>
                                        Năm 2021</option>
                                    <option value="2022" {{ Request::get('year')==2022 ? "selected='selected'" : "" }}>
                                        Năm 2022</option>
                                    <option value="2023" {{ Request::get('year')==2023 ? "selected='selected'" : "" }}>
                                        Năm 2023</option>
                                </select>
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i>
                                    Search</button>
                                <button type="submit" name="export" value="true" class="btn btn-info">
                                    <i class="fa fa-save"> </i> Export
                                </button>
                            </form>
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tổng Tiền</th>
                                    <th>Ngày</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($moneyTransaction))
                                @foreach ($moneyTransaction as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ number_format($item->totalMoney,0,',','.') }} vnd</td>
                                    <td>
                                        @if (!(empty(Request::get('year'))) && empty(Request::get('day')) &&
                                        empty(Request::get('month')))
                                        Tháng {{ $item->day }} Năm {{Request::get('year')}}
                                        @else
                                        {{ $item->day }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Tổng</td>
                                    <td><span style="color: red">{{ number_format($totalMoneyTransaction,0,',','.') }}
                                            vnd</span></td>
                                    <td></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Orders</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Info</th>
                                    <th>Account</th>
                                    <th>Money</th>
                                    <th>Status</th>
                                    <th>Phương thức TT</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>jahaha</td>
                                    <td>
                                        <ul>
                                            <li>Name: asas</li>
                                            <li>Email: asas</li>
                                            <li>Phone: asas</li>
                                            <li>Address: asas</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <span class="label label-warning">Thành Viên</span>

                                        <span class="label label-default">Khách</span>
                                    </td>
                                    <td> </td>
                                    <td>
                                        <span class="label label-">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="label label-">
                                        </span>
                                    </td>
                                    <td>Check</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix" style="">
                    <a href="" class="btn btn-sm btn-info btn-flat pull-right">Danh Sách Đơn Hàng</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Top Sản Phẩm Bán Nhiều Nhất</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">

                        <li class="item">
                            <div class="product-img">
                                <img src="" alt="">
                            </div>
                            <div class="product-info">
                                <a href="" target="_blank"
                                    class="product-title">
                                    <span class="label label-warning pull-right">đ</span></a>
                                <span class="product-description">
                                     lượt mua
                                </span>
                            </div>
                        </li>
                        
                    </ul>
                </div>
                <div class="box-footer text-center">
                    <a href="" class="uppercase">View All Products</a>
                </div>
            </div>
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Top Sản Phẩm Xem Nhiều Nhất</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">

                        <li class="item">
                            <div class="product-img">
                                <img src="" alt="">
                            </div>
                            <div class="product-info">
                                <a href="" target="_blank"
                                    class="product-title">
                                    <span class="label label-warning pull-right"> đ</span></a>
                                <span class="product-description">
                                    <i class="fa fa-eye"></i>số view
                                </span>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="box-footer text-center">
                    <a href="" class="uppercase">View All Products</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    let dataTransaction = $('#container').attr('data-json');
        dataTransaction = JSON.parse(dataTransaction);
        Highcharts.chart('container', {
            chart: {
                styledMode: true
            },

            title: {
                text: 'Pie point CSS'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data:dataTransaction ,
                showInLegend: true
            }]
        });




        let listday = $('#container2').attr('data-list-day');
        listday = JSON.parse(listday);

        let listMoneyMonth = $('#container2').attr('data-money');
        listMoneyMonth = JSON.parse(listMoneyMonth);

        let listMoneyMonthDefault = $('#container2').attr('data-money-default');
        listMoneyMonthDefault = JSON.parse(listMoneyMonthDefault);

        Highcharts.chart('container2', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Biểu đồ doanh thu các ngày trong tháng'
            },
            subtitle: {
                text: 'hải mập mạp'
            },
            xAxis: {
                categories: listday
            },
            yAxis: {
                title: {
                    text: 'Số tiền'
                },
                labels: {
                    formatter: function () {
                        return new Intl.NumberFormat().format(this.value) + ' VND';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [
                {
                    name: 'Đã Bàn Giao',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonth
                },{
                    name: 'Tiếp Nhận',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthDefault
                }
            ]
        });
</script>
@endsection