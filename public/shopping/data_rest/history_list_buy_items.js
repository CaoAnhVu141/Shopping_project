document.addEventListener('DOMContentLoaded', function () {

    // Hàm hiển thị danh sách lịch sử mua hàng
    function showAllHistoryofItems(page = 1) {
        fetch(`/api/history-buy-items?page=${page}`).then(response => response.json())
            .then(data => {
                const getElement = document.getElementById('order-items');
                const paginationElement = document.getElementById('pagination');
                getElement.innerHTML = '';
                paginationElement.innerHTML = '';

                if (data.data && data.data.data.length > 0) {
                    data.data.data.forEach(items => {
                        const [year, month, day] = items.created_at.split('T')[0].split('-');
                        const formattedDate = `${day}/${month}/${year}`;
                        const row = `
                        <div class="order-item">
                            <div class="order-img">
                                <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid">
                            </div>
                            <div class="order-info">
                                <p><strong>${items.customer_name}</strong></p>
                                <p>Địa chỉ: ${items.shipping_address}</p>
                                <p>Trạng thái: ${items.status}</p>
                                <p>Số điện thoại: ${items.customer_phone}</p>
                                <p>Ngày đặt hàng: ${formattedDate}</p>
                            </div>
                            <div class="order-price">
                                <div class="order-total">
                                    <p>Thành tiền: <span class="new-price">${parseFloat(items.total_item).toLocaleString()}₫</span></p>
                                </div>
                                <div class="order-action-container">
                                <button class="btn-readmore" data-id="${items.id_order}">Xem chi tiết</button>
                                <button class="btn-remove-active" data-id="${items.id_order}">Huỷ đơn hàng</button>
                                </div>

                            </div>
                        </div>`;
                        getElement.insertAdjacentHTML('beforeend', row);
                    });

                    // Xử lý sự kiện click "Xem chi tiết"
                    document.querySelectorAll('.btn-readmore').forEach(button => {
                        button.addEventListener('click', function () {
                            const dataShow = this.getAttribute('data-id');
                            window.location.href = `/detail-history/${dataShow}`;
                        });
                    });

                    // Xử lý sự kiện click "Huỷ đơn hàng"
                    document.querySelectorAll('.btn-remove-active').forEach(button => {
                        button.addEventListener('click', function () {
                            const data_id = this.getAttribute('data-id');
                            cancelActiveStatusItems(data_id);
                        });
                    });

                    // Tạo phân trang
                    createPaginate(data.data.current_page, data.data.last_page);
                } else {
                    getElement.innerHTML = '<p>Không có lịch sử mua hàng.</p>';
                }
            }).catch(error => console.error('Đã có lỗi xảy ra', error));
    }

    // Hàm huỷ đơn hàng
    function cancelActiveStatusItems(id_order) {
        fetch(`/api/cancel-status-items/${id_order}`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    reason: 'User canceled the order'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "Huỷ đơn hàng thành công") {
                    alert("Bạn đã huỷ đơn hàng thành công");
                    showAllHistoryofItems(); // Tải lại danh sách đơn hàng
                } else {
                    alert("Xin lỗi, đơn hàng không thể huỷ");
                }
            })
            .catch(error => console.log('Đã có lỗi xảy ra', error));
    }

    // Hàm thực thi tạo phân trang
    function createPaginate(currentPage, lastPage) {
        const pagiElement = document.getElementById('pagination');
        pagiElement.innerHTML = '';

        // Nút "Trang trước"
        if (currentPage > 1) {
            const prevButton = document.createElement('button');
            prevButton.textContent = 'Trang trước';
            prevButton.addEventListener('click', () => showAllHistoryofItems(currentPage - 1));
            pagiElement.appendChild(prevButton);
        }

        // Nút số trang
        for (let i = 1; i <= lastPage; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            pageButton.classList.add('pagination-button');
            if (i === currentPage) pageButton.classList.add('active');

            pageButton.addEventListener('click', function () {
                showAllHistoryofItems(i);
            });
            pagiElement.appendChild(pageButton);
        }

        // Nút "Trang sau"
        if (currentPage < lastPage) {
            const nextButton = document.createElement('button');
            nextButton.textContent = 'Trang sau';
            nextButton.addEventListener('click', () => showAllHistoryofItems(currentPage + 1));
            pagiElement.appendChild(nextButton);
        }
    }

    // Hàm tìm kiếm full text search
    function findDataFullTextSearch(keyword) {
        fetch(`/api/search-history-items?key=${encodeURIComponent(keyword)}`)
            .then(response => response.json())
            .then(data => {
                const getElement = document.getElementById('order-items');
                getElement.innerHTML = '';

                if (data.data && data.data.length > 0) {
                    console.log("Tìm kiếm thành công");
                    data.data.forEach(items => {
                        const [year, month, day] = items.created_at.split('T')[0].split('-');
                        const formattedDate = `${day}/${month}/${year}`;
                        const row = `
                        <div class="order-item">
                            <div class="order-img">
                                <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid">
                            </div>
                            <div class="order-info">
                                <p><strong>${items.order.customer_name}</strong></p>
                                <p>Địa chỉ: ${items.order.shipping_address}</p>
                                <p>Trạng thái: ${items.order.status}</p>
                                <p>Số điện thoại: ${items.order.customer_phone}</p>
                                <p>Ngày đặt hàng: ${formattedDate}</p>
                            </div>
                            <div class="order-price">
                                <del>118.000₫</del>
                                <div class="new-price">89.000₫</div>
                                <div class="order-total">
                                    <p>Thành tiền: <span class="new-price">${parseFloat(items.order.total_item).toLocaleString()}₫</span></p>
                                </div>
                                <div class="order-action">
                                    <button class="btn-readmore" data-id="${items.order.id_order}">Xem chi tiết</button>
                                </div>
                                <div class="order-action">
                                    <button class="btn-remove-active" data-id="${items.order.id_order}">Huỷ đơn hàng</button>
                                </div>
                            </div>
                        </div>`;
                        getElement.insertAdjacentHTML('beforeend', row);
                    });

                    // Xử lý sự kiện click "Xem chi tiết" và "Huỷ đơn hàng"
                    document.querySelectorAll('.btn-readmore').forEach(button => {
                        button.addEventListener('click', function () {
                            const dataShow = this.getAttribute('data-id');
                            window.location.href = `/detail-history/${dataShow}`;
                        });
                    });

                    document.querySelectorAll('.btn-remove-active').forEach(button => {
                        button.addEventListener('click', function () {
                            const data_id = this.getAttribute('data-id');
                            cancelActiveStatusItems(data_id);
                        });
                    });
                } else {
                    console.log("Không có dữ liệu");
                    getElement.innerHTML = '<p>Không có dữ liệu tìm kiếm</p>';
                }
            })
            .catch(error => console.error('Đã có lỗi xảy ra', error));
    }


    //viết sự kiện click btn-buyitems
    const button_data = document.getElementById('btn-search');
    button_data.addEventListener('click', function (event) {
        event.preventDefault();
        console.log("Sao khoan hoài vậy anh?");
        const input_ỉtems = document.getElementById('btn-buyitems').value;
        console.log(input_ỉtems);
        findDataFullTextSearch(input_ỉtems);
    });

    // Khởi chạy hiển thị danh sách đơn hàng lần đầu
    showAllHistoryofItems();
});
