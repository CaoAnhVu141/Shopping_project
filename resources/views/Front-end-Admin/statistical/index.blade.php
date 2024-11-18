@extends('LayOut.admin-dashboard.master_admin')
@section('content')
<section class="content-header">
    <h1>
        Thống Kê
        <small>website</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">thống kê</li>
    </ol>
</section>
<section class="content">
    <div class="row" style="margin-bottom: 20px">
        <div class="col-sm-8">
            <div class="box-title">
                <form action="" method="GET" class="form-inline">
                    <select name="mt" class="form-control">
                        <option value="">_ Tháng trong năm _</option>
                        <option value="">Tháng</option>
                    </select>
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i> Search</button>
                    <button type="submit" name="export" value="true" class="btn btn-info">
                        <i class="fa fa-save"> </i> Export
                    </button>
                </form>
            </div><br>
            {{-- @@todo --}}
            <figure class="highcharts-figure">
                <div id="container2" data-list-day="" data-money-default="" data-money-process="" data-money-success=""
                    data-money-cancel="" data-mt=""></div>
            </figure>
        </div>
        {{-- @@todo --}}
        <div class="col-sm-4">
            <figure class="highcharts-figure">
                <div id="container" data-json=""></div>
            </figure>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-7">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Doanh Số</h3>
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
                                <input type="date" value="" name="dateBefore" class="form-control"
                                    id="validationCustom01">
                                <input type="date" value="" name="dateAfter" class="form-control"
                                    id="validationCustom01">
                                <span class="text-danger"></span>
                                <select name="day" class="form-control">
                                    <option value="">_ Ngày trong tháng _</option>
                                    <option value="</option>
                                </select>
                                <select name=" month="" class="form-control">
                                    <option value="">_ Tháng trong năm _</option>
                                    <option value="">Tháng</option>
                                </select>
                                <select name="year" class="form-control">
                                    <option value="">_ Năm _</option>
                                    <option value="2019">Năm 2019</option>
                                    <option value="2020">Năm 2020</option>
                                    <option value="2021">Năm 2021</option>
                                    <option value="2022">Năm 2022</option>
                                    <option value="2023">Năm 2023</option>
                                </select>
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i>
                                    Search</button>
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
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        Tháng Năm
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tổng</td>
                                    <td><span style="color: red"></span></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Top 10 khách hàng mua chi nhiều tiền nhất</h3>
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
                                    <th>STT</th>
                                    <th>Info</th>
                                    <th>Money</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>Name: </li>
                                            <li>Email: </li>
                                            <li>Phone: </li>
                                            <li>Address: </li>
                                        </ul>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">top sản phẩm bán trong tháng 7</h3>
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
                                    <th>STT</th>
                                    <th>số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>Name: </li>
                                            {{-- <li>Email: {{ $$item->product->pro_price }}</li> --}}
                                            <li>Tổng số: </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
@endsection