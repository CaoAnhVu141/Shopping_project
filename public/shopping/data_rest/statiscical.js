document.addEventListener('DOMContentLoaded', function () {
    function showDataProductStatistical(statisticalData) {
        const getElement = document.getElementById('statistical_product');
        getElement.innerHTML = '';
        // Dữ liệu hàng thống kê
        const row = `
            <tr>
                <td>1</td>
                <td>${statisticalData.total_product}</td>
                <td>${statisticalData.hot_product}</td>
                <td>${parseFloat(statisticalData.total_revenue).toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                })}</td>
            </tr>
        `;
        getElement.insertAdjacentHTML('beforeend', row);
    }

    function showDataOutOfProduct(statisticalData) {
        const getElement = document.getElementById('top-out-stock');
        getElement.innerHTML = '';
        statisticalData.forEach((items, index) => {
            const row = `
        <tr>
            <td>${index + 1}</td>
            <td>${items.name}</td>
            <td>${items.quantity_available}</td>
        </tr>`;
            getElement.insertAdjacentHTML('beforeend', row);
        });
    }

    function showDataBestSellerProduct(statisticalData) {
        const getElement = document.getElementById('top-best-seller');
        getElement.innerHTML = '';
        statisticalData.forEach((items, index) => {
            const row = `
            <tr>
                <td>${index + 1}</td>
                <td>${items.name}</td>
                <td>${items.total_sold}</td>
            </tr>`;
            getElement.insertAdjacentHTML('beforeend', row);
        });

    }

    //Thống kê sản phẩm
    function statiscialProduct() {
        fetch(`/api/product-staticital`).then(response => response.json())
            .then(data => {
                if (data.message == "Lấy dữ liệu thành công") {
                    showDataProductStatistical(data.data);
                }
            })
            .catch(error => console.error('Đã có lỗi xảy ra', error));
    }
    //
    function staticitalOutOfProduct() {
        fetch(`/api/out-stock-product`).then(response => response.json())
            .then(data => {
                if (data.message == "Lấy dữ liệu thành công") {
                    showDataOutOfProduct(data.data);
                }
            })
            .catch(error => console.error('Đã có lỗi xảy ra', error));
    }

    //Top 10 Sản phẩm bán chạy nhất
    function topBestSellerProduct() {
        fetch(`/api/top-sell-product`).then(response => response.json())
            .then(data => {
                if (data.message == "Lấy dữ liệu thành công") {
                    showDataBestSellerProduct(data.data);
                }
            })
            .catch(error => console.error('Đã có lỗi xảy ra', error));
    }
    //biểu đồ nek
    function renderRevenueChart(data) {
        Highcharts.chart('revenue-chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'DOANH THU THEO THÁNG'
            },
            xAxis: {
                categories: data.map(item => `Tháng ${item.month}`),
                title: {
                    text: 'Tháng',
                    align: 'high'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Doanh thu (VNĐ)'
                },
                labels: {
                    formatter: function () {
                        return this.value.toLocaleString('vi-VN'); // Định dạng số VNĐ
                    }
                }
            },
            tooltip: {
                pointFormat: 'Doanh thu: <b>{point.y:,.0f} VNĐ</b>'
            },
            series: [{
                name: 'Doanh thu',
                data: data.map(item => parseFloat(item.total_revenue)),
                 // Màu cột
                showInLegend: true,
            }]
        });
    }

    //@hiên thị giao diện thống kê theo trạng thái
    function showViewItemsByStattus(data)
    {
        console.log(data);
        Highcharts.chart('order-status-chart', {
            chart: {
                type: 'pie',
                backgroundColor: '#ffffff'
            },
            title: {
                text: 'TRẠNG THÁI ĐƠN HÀNG'
            },
            tooltip: {
                pointFormat: '<b>{point.y} Đơn hàng ({point.percentage:.1f}%)</b>'
            },
            legend: {
                align: 'center',
                verticalAlign: 'bottom',
                layout: 'horizontal'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y} đơn ({point.percentage:.1f}%)',
                        style: {
                            fontSize: '12px'
                        }
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Đơn hàng',
                colorByPoint: true,
                data: data.map(item => ({
                    name: convertStatusToText(item.status), // Chuyển trạng thái thành text
                    y: item.count
                }))
            }]
        });
    }

    //@các trường hợp của trạng thái
    function convertStatusToText(status) {
        switch (status) {
            case 'Đang Chuẩn Bị':
                return 'Đang Chuẩn Bị';
            case 'Đã Bàn Giao':
                return 'Đã Bàn Giao';
            case 'Đang Vận Chuyển':
                return 'Đang Vận Chuyển';
                case 'Đã tiếp nhận':
                return 'Đã tiếp nhận';
            case 'Hủy':
                return 'Hủy';
            default:
                return 'Không xác định';
        }
    }

    //@hiển thị giao view doanh thu theo ngày
    function showViewRevenueDataByDays(statisticalData)
    {
        const getElement = document.getElementById('revenue_by_days');
        getElement.innerHTML = '';

        statisticalData.forEach((items,index) => {
            const row = `
            <tr>
            <td>${index + 1}</td>
            <td>${items.days}</td>
            <td>${parseFloat(items.revenue).toLocaleString()}</td>
            </tr>`;

            getElement.insertAdjacentHTML('beforeend',row);
        });
    }

    //@thực thi hàm thống kê theo tháng
    function fetchRevenueData() {
        fetch('/api/revenue-by-month')
            .then(response => response.json())
            .then(data => {
                if (data.message === "Lấy dữ liệu thành công") {
                    renderRevenueChart(data.data);
                }
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu doanh thu:', error));
    }

    //@thực thi thống kê theo trang thái
    function fetchDataItemsByStatus()
    {
        fetch(`/api/order-by-status`).then(response => response.json())
        .then(data => {
            if(data.message == "Lấy dữ liệu thành công")
            {
                showViewItemsByStattus(data.data);
            }
        })
        .catch(error => console.error('Đã có lỗi xảy ra',error));
    }

    //Thực thi hiển thị thống kê theo ngày
    function fetchDataRevenueDataByDays()
    {
        fetch(`/api/revenue-by-days`).then(response => response.json())
        .then(data => {
            if(data.message = "Lấy dữ liệu thành công")
            {
                showViewRevenueDataByDays(data.data);
            }
        })
        .catch(error => console.error('Đã có lỗi xảy ra',error));
    }


    fetchRevenueData(); //thống kê tháng
    fetchDataItemsByStatus(); //thống kê theo trạng thái
    fetchDataRevenueDataByDays(); //thống kê theo ngày
    statiscialProduct();
    staticitalOutOfProduct();
    topBestSellerProduct();

});
