document.addEventListener('DOMContentLoaded', function () {

     // Lấy id_order từ URL
     const urlPath = window.location.pathname;
     const id_order = urlPath.split('/').pop(); // Lấy giá trị cuối cùng trong URL
 
     // Kiểm tra nếu id_order là một số hợp lệ và gọi hàm
     if (!isNaN(id_order)) {
         viewDetailHistoryBuyItems(id_order);
     } else {
         console.error('ID đơn hàng không hợp lệ:', id_order);
     }

    // Hàm hiển thị chi tiết sản phẩm đã đặt
    function viewDetailHistoryBuyItems(id_order) {
        fetch(`/api/detail-history-items/${id_order}`).then(response => response.json())
            .then(data => {
                const getDataElement = document.getElementById('view-history');
                getDataElement.innerHTML = '';
                if (data.message === "Lấy dữ liệu thành công") {
                    data.data.forEach(items => {
                        const order = items.order;
                        let productsHtml = '';
                        // Lặp qua các sản phẩm trong đơn hàng để hiển thị thông tin chi tiết
                        order.order_items.forEach(item => {
                            productsHtml += `
                            <div class="product-item">
                                <img src="${item.product.image_url}" alt="${item.product.name}">
                                <div class="product-info">
                                    <p class="product-name">${item.product.name}</p>
                                    <p>Số lượng: ${item.quantity}</p>
                                    <p>Giá mỗi sản phẩm: ${Number(item.price).toLocaleString()}₫</p>
                                    <p>Thành tiền: ${(item.quantity * item.price).toLocaleString()}₫</p>
                                </div>
                            </div>
                            <hr>`;
                        });
                        const row = `
                        <div class="order-summary">
                            <p><strong>Người nhận:</strong> ${order.customer_name}</p>
                            <p><strong>Địa chỉ giao hàng:</strong> ${order.shipping_address}</p>
                            <p><strong>Số điện thoại:</strong> ${order.customer_phone}</p>
                            <p><strong>Trạng thái đơn hàng:</strong> ${order.status}</p>
                            <p><strong>Ngày đặt hàng:</strong> ${new Date(order.order_date).toLocaleDateString()}</p>
                        </div>

                        <h3 class="mt-4">Danh sách sản phẩm</h3>
                        <div class="product-list">
                            ${productsHtml}
                        </div>
                        <div class="order-total">
                            <h4>Tổng cộng: ${Number(order.total_item).toLocaleString()}₫</h4>
                        </div>
                        <div class="text-center mt-4">
                            <a href="" class="btn btn-secondary">Quay lại lịch sử mua hàng</a>
                        </div>`;

                        getDataElement.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    getDataElement.innerHTML = '<p>Không có dữ liệu lịch sử cho đơn hàng này.</p>';
                }
            }).catch(error => console.error('Đã có lỗi xảy ra', error));
    }
});
