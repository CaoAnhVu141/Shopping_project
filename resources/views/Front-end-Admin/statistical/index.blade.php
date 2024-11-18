@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <h1>
        Thống Kê
        <small>Website</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Thống kê</li>
    </ol>
    <link rel="stylesheet" href="{{ asset('shopping/css/statistical.css') }}">
</section>
<section class="content">
    <div class="row" style="margin-bottom: 20px">
        <!-- Bộ lọc Thống kê -->
        <div class="col-sm-12">
            <div class="box-title">
                <form action="" method="GET" class="form-inline">
                    <select name="month" class="form-control">
                        <option value="">_ Chọn Tháng _</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">Tháng {{ $i }}</option>
                        @endfor
                    </select>
                    <select name="year" class="form-control">
                        <option value="">_ Chọn Năm _</option>
                        @for ($y = 2019; $y <= now()->year; $y++)
                            <option value="{{ $y }}">Năm {{ $y }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i> Tìm kiếm</button>
                    <button type="submit" name="export" value="true" class="btn btn-info">
                        <i class="fa fa-save"> </i> Xuất Excel
                    </button>
                </form>
            </div>
            <br>
        </div>
        <!-- Biểu đồ Doanh thu -->
        <div class="col-sm-11">
            <figure class="highcharts-figure">
                <div id="revenue-chart" style="height: 400px;"></div>
            </figure>
        </div>
        <!-- Biểu đồ trạng thái đơn hàng -->
        <div class="col-sm-5">
            <figure class="highcharts-figure">
            </figure>
        </div>
    </div>

    <!-- Doanh số hàng ngày -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Doanh Số Hàng Ngày</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ngày</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>Tổng</strong></td>
                                    <td><strong></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top khách hàng -->
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>THỐNG KÊ SẢN PHẨM</strong></h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tổng sản phẩm</th>
                                    <th>Sản phẩm hot</th>
                                    <th>Tổng doanh thu dự kiến</th>
                                </tr>
                            </thead>
                            <tbody id="statistical_product">
                               {{-- Sẽ hiển thị chỗ này trong js --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>SỐ LƯỢNG TRONG KHO THẤP</strong></h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng còn lại</th>
                                </tr>
                            </thead>
                            <tbody id="top-out-stock">
                                {{-- Dữ liệu sẽ hiển thị nơi này --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top sản phẩm bán chạy -->
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>DANH SÁCH SẢN PHẨM BÁN CHẠY NHẤT</strong></h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng bán</th>
                                </tr>
                            </thead>
                            <tbody id="top-best-seller">
                                {{-- Hiển thị dữ liệu ở nơi này --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script src="{{ asset("shopping/data_rest/statiscical.js") }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

{{-- @section('script')
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
                text: 'Biểu đồ số đơn hàng'
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
        let listMoneyMonthDefault = $('#container2').attr('data-money-default');
        listMoneyMonthDefault = JSON.parse(listMoneyMonthDefault);
        let listMoneyMonthProcess = $('#container2').attr('data-money-process');
        listMoneyMonthProcess = JSON.parse(listMoneyMonthProcess);
        let listMoneyMonthSuccess = $('#container2').attr('data-money-success');
        listMoneyMonthSuccess = JSON.parse(listMoneyMonthSuccess);
        let listMoneyMonthCancel = $('#container2').attr('data-money-cancel');
        listMoneyMonthCancel = JSON.parse(listMoneyMonthCancel);
        let mt = $('#container2').attr('data-mt');
        Highcharts.chart('container2', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Biểu đồ doanh số các ngày trong tháng ' + mt
            },
            subtitle: {
                text: 'Hải Anh Watch'
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
                    name: 'Tiếp Nhận',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthDefault
                },
                {
                    name: 'Đang vận chuyển',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthProcess
                },
                {
                    name: 'Đã Bàn Giao',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthSuccess
                },
                {
                    name: 'Đã hủy',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthCancel
                }
            ]
        });
</script>
@endsection --}}