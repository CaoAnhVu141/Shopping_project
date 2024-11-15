document.addEventListener('DOMContentLoaded', function () {

    // Hàm hiển thị danh sách lịch sử mua hàng
    function showAllHistoryofItems() {
        fetch(`api/history-buy-items`).then(response => response.json())
            .then(data => {
                const getElement = document.getElementById('order-items');
                getElement.innerHTML = '';
                if (data.data.length > 0) {
                    data.data.forEach(items => {
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
                                <del>118.000₫</del>
                                <div class="new-price">89.000₫</div>
                                <div class="order-total">
                                    <p>Thành tiền: <span class="new-price">${parseFloat(items.total_item).toLocaleString()}₫</span></p>
                                </div>
                                <div class="order-action">
                                    <button class="btn-readmore" data-id="${items.id_order}">Xem chi tiết</button>
                                </div>
                                 <div class="order-action">
                                    <button class="btn-remove-active" id="btn-remove-active" data-id="${items.id_order}">Huỷ đơn hàng</button>
                                </div>
                            </div>
                        </div>`;
                        getElement.insertAdjacentHTML('beforeend', row);
                    });
                    // xử lý sự kiện onclick
                    const buttons = document.querySelectorAll('.btn-readmore');
                    buttons.forEach(button => {
                        button.addEventListener('click',function(){
                            const dataShow = this.getAttribute('data-id');
                            window.location.href = `/detail-history/${dataShow}`;
                        });
                    });

                    //@ xử lý huỷ đơn hàng
                    const cancelItems = document.querySelectorAll('.btn-remove-active');
                    cancelItems.forEach(button => {
                        button.addEventListener('click',function(){
                            const data_id = this.getAttribute('data-id');
                            cancelActiveStatusItems(data_id);
                           console.log("Huỷ oke la rồi nè");
                        })
                    })
                } else {
                    getElement.innerHTML = '<p>Không có lịch sử mua hàng.</p>';
                }
            }).catch(error => console.error('Đã có lỗi xảy ra', error));
    }

    //@ huỷ đơn hàng
    function cancelActiveStatusItems(id_order)
    {
        fetch(`api/cancel-status-items/${id_order}`,{
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            }
            ,body: JSON.stringify({ reason: 'User canceled the order' })
        })
        .then(response => response.json())
        .then(data => {
            if(data.message == "Huỷ đơn hàng thành công")
            {
                alert("Bạn đã huỷ đơn hàng thành công");
                console.log("Huỷ đơn hàng thành công");
                showAllHistoryofItems();
            }
            else{
                alert("Xin lỗi, Bạn không thẻ huỷ đơn hàng");
                console.error(error => console.error("Lỗi huỷ đơn hàng",error));
            }
        })
        .catch(error => console.log('Đã có lỗi xảy ra',error));
    }

    showAllHistoryofItems();
});
