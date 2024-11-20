document.addEventListener('DOMContentLoaded', function () {
    getAllItems();
    const dashboard = document.getElementById('dashboard_list');
    if (!dashboard) {
        console.error('Không tìm thấy phần tử dashboard_list');
        return;
    }
    fetch(`api/dashboard`).then(response => response.json())
        .then(data => {
            dashboard.innerHTML = ''; // Reset nội dung
            if (data.data.length > 0) {
                data.data.forEach((item,index) => {
                    const formatMoney = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(item.price);
                    const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>
                                <ul>
                                    <li>Name: ${item.order.customer_name ? item.order.customer_name : item.order.customer.name}</li>
                                    <li>Email: ${item.order.customer_email ? item.order.customer_email : item.order.customer.email}</li>
                                    <li>Phone: ${item.order.customer_email ? item.order.customer_email : item.order.customer.phone}</li>
                                    <li>Address: ${item.order.shipping_address ? item.order.shipping_address : item.order.customer.address}</li>
                                </ul>
                            </td>
                            <td>${formatMoney}</td>
                            <td>
                                <span class="label label-success" style="cursor: default; pointer-events: none;">
                                    ${item.status}
                                </span>
                            </td>
                            <td>
                                <span class="label label-info" style="cursor: default; pointer-events: none;">
                                    ${item.order.payment.payment_method}
                                </span>
                            </td>
                            <td>${moment(item.created_at).format("DD/MM/YYYY")}</td>
                        </tr>`;
                    dashboard.innerHTML += row;
                });
            } else {
                dashboard.innerHTML = '<tr><td colspan="7">Không có đơn hàng</td></tr>';
            }
        }).catch(error => console.error('Có lỗi xảy ra:', error));
});

// viết phương thức hiện thị toàn bộ đơn hàng qua button
function getAllItems() {
    const item_dashboard = document.getElementById('list_item');
    if (!item_dashboard) {
        console.error('Không tìm thấy phần tử list_item');
        return;
    }
    fetch(`api/get-orders`)
        .then(response => response.json())
        .then(data => {
            item_dashboard.innerHTML = ''; // Xóa nội dung cũ
            console.log(data.data);
            if (data && data.data.length > 0) {
                data.data.forEach((item,index) => {
                    const formatMoney = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(item.price);
                    const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>
                                <ul>
                                    <li>Name: ${item.order.customer_name ? item.order.customer_name : item.order.customer.name}</li>
                                    <li>Email: ${item.order.customer_email ? item.order.customer_email : item.order.customer.email}</li>
                                    <li>Phone: ${item.order.customer_phone ? item.order.customer_phone : item.order.customer.phone}</li>
                                    <li>Address: ${item.order.shipping_address ? item.order.shipping_address : item.order.customer.address}</li>
                                </ul>
                            </td>
                            <td>${formatMoney}</td>
                            <td class="status-cell">
                                <span class="label label-warning" style="cursor: default; pointer-events: none;">
                                    ${item.status}
                                </span>
                            </td>
                            <td>
                                <span class="label label-info" style="cursor: default; pointer-events: none;">
                                    ${item.order.payment.payment_method}
                                </span>
                            </td>
                            <td>${moment(item.created_at).format("DD/MM/YYYY")}</td>
                            <td>
                                <a href="/view-detail/${item.encrypted_id}" class="btn btn-xs btn-info js-preview-view" data-id="${item.id_order_item}">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-xs">Action</button>
                                    <button type="button" class="btn btn-success btn-xs dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="" class="update-status" data-id="${item.id_order_item}" data-status="Đang Chuẩn Bị">Đang Chuẩn Bị</a></li>
                                        <li><a href="" class="update-status" data-id="${item.id_order_item}" data-status="Đã Bàn Giao">Đã Bàn Giao</a></li>
                                        <li><a href="" class="update-status" data-id="${item.id_order_item}" data-status="Đang Vận Chuyển">Đang Vận Chuyển</a></li>
                                        <li><a href="" class="update-status" data-id="${item.id_order_item}" data-status="Hủy">Hủy</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>`;
                    item_dashboard.innerHTML += row; // Thêm nội dung vào bảng
                });
                // Gắn sự kiện cập nhật trạng thái cho các nút sau khi các phần tử được thêm vào DOM
                document.querySelectorAll('.update-status').forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        const orderId = this.getAttribute('data-id');
                        const newStatus = this.getAttribute('data-status');
                        // Gọi API cập nhật trạng thái
                        updateStatusDashBoard(orderId, newStatus);
                    });
                });
                // Hiển thị các link phân trang
                const paginationLinks = document.getElementById('pagination-links');
                // paginationLinks.innerHTML = createPaginationLinks(data);
            } else {
                item_dashboard.innerHTML = '<tr><td colspan="7">Không có đơn hàng</td></tr>';
            }
        })
        .catch(error => console.error('Đã có lỗi xảy ra:', error));
}

//@viết hàm cập nhật trạng thái đơn hàng
function updateStatusDashBoard(idOrder, newStatus) {
    fetch(`${window.location.origin}/api/update/dashboard-status/${idOrder}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: newStatus
            })
        })
        .then(response => {
            // Kiểm tra nếu phản hồi không phải là JSON
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Chỉ cố gắng phân tích nếu phản hồi là OK
        })
        .then(data => {
            if (data.message === 'Cập nhật thành công') {
                // Cập nhật lại giao diện
                const statusLabel = document.querySelector(`[data-id="${idOrder}"]`).closest('tr').querySelector('.status-cell');;
                statusLabel.innerHTML = `<span class="label label-warning">${newStatus}</span>`;
            } else {
                console.error('Cập nhật thất bại:', data.message);
            }
        })
        .catch(error => console.error('Đã có lỗi xảy ra:', error));
}
// Hàm hiện thị view cho tìm kiếm dashboard @chua fix
function showViewSearchDashboard(data_dashboard) {
    const data_view = document.getElementById('list_item');
    data_view.innerHTML = ''; // Xóa nội dung cũ

    data_dashboard.forEach((item,index) => {
        const row = document.createElement('tr');
        // Định dạng tiền tệ
        const formatMoney = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(item.total_item || 0);
        // Nhúng HTML vào `row`
        row.innerHTML = `
            <td>${index+1}</td>
            <td>
                <ul>
                    <li>Name: ${item.customer ? item.customer.name : 'N/A'}</li>
                    <li>Email: ${item.customer ? item.customer.email : 'N/A'}</li>
                    <li>Phone: ${item.customer ? item.customer.phone : 'N/A'}</li>
                    <li>Address: ${item.customer ? item.customer.address : 'N/A'}</li>
                </ul>
            </td>
            <td>${formatMoney}</td>
            <td class="status-cell">
                <span class="label label-warning">${item.status || 'N/A'}</span>
            </td>
            <td>
                <span class="label label-info">${item.payment ? item.payment.payment_method : 'N/A'}</span>
            </td>
            <td>${item.created_at ? moment(item.created_at).format("DD/MM/YYYY") : 'N/A'}</td>
            <td>
                <a href="/view-detail/${item.id_order}" class="btn btn-xs btn-info js-preview-view" data-id="${item.id_order}">
                    <i class="fa fa-eye"></i> View
                </a>
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-xs">Action</button>
                    <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="" class="update-status" data-id="${item.id_order}" data-status="Đang Chuẩn Bị">Đang Chuẩn Bị</a></li>
                        <li><a href="" class="update-status" data-id="${item.id_order}" data-status="Đã Bàn Giao">Đã Bàn Giao</a></li>
                        <li><a href="" class="update-status" data-id="${item.id_order}" data-status="Đang Vận Chuyển">Đang Vận Chuyển</a></li>
                        <li><a href="" class="update-status" data-id="${item.id_order}" data-status="Hủy">Hủy</a></li>
                    </ul>
                </div>
            </td>`;

        // Thêm hàng `row` vào `data_view`
        data_view.appendChild(row);
    });
}

// Gắn sự kiện một lần cho toàn bộ `data_view` để xử lý cập nhật trạng thái
document.getElementById('list_item').addEventListener('click', function (event) {
    if (event.target.classList.contains('update-status')) {
        event.preventDefault();
        const orderId = event.target.getAttribute('data-id');
        const newStatus = event.target.getAttribute('data-status');
        updateStatusDashBoard(orderId, newStatus);
    }
});
// Hàm xử lý sự kiện tìm kiếm dashboard
document.getElementById('btn-search').addEventListener('click', function (event) {
    event.preventDefault();

    const status_query = document.getElementById('status_active').value;
    const email_query = document.getElementById('search_email').value.trim();

    if (!email_query && !status_query) {
        alert("Vui lòng nhập email hoặc chọn trạng thái để tìm kiếm");
        return;
    }
    const value_item = new URLSearchParams({
        status: status_query,
        email: email_query
    }).toString();

    fetch(`/api/dashboard/search?${value_item}`)
        .then(response => response.json())
        .then(data => {
            if (data.data && data.data.length > 0) {
                showViewSearchDashboard(data.data);
            } else {
                document.getElementById('list_item').innerHTML = '<tr><td colspan="5">Không tìm thấy kết quả</td></tr>';
            }
        })
        .catch(error => console.error("Đã có lỗi xảy ra", error));
});













// @hàm xử lý phân trang
function createPaginationLinks(data) {
    let links = '';
    if (data.prev_page_url) {
        links += `<li><a href="#" class="pagination-link" data-page="${data.current_page - 1}">Previous</a></li>`;
    }

    for (let i = 1; i <= data.last_page; i++) {
        links += `<li class="${i === data.current_page ? 'active' : ''}">
                    <a href="#" class="pagination-link" data-page="${i}">${i}</a>
                  </li>`;
    }
    if (data.next_page_url) {
        links += `<li><a href="#" class="pagination-link" data-page="${data.current_page + 1}">Next</a></li>`;
    }
    return links;
}
