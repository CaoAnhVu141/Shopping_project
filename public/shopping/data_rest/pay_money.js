
document.addEventListener('DOMContentLoaded',function()
{
    // //@Viết hàm hiển thị toàn bộ sản phẩm ra
    function showAllItemsPayMoney()
    {
        fetch(`/make-payment`).then(response => response.json())
        .then(data =>{
            const container = document.getElementById('cart-items-container');
            container.innerHTML = '';
            let totalPrice = 0;
            if(data.length > 0)
            {
                data.forEach(items => {
                    totalPrice += parseFloat(items.total_price);
                    const row = `
            <div class="product-info">
                <img src="" alt="Product Image">
                <div class="ml-12">
                    <h6>${items.product_name}</h6>
                    <h7>Màu sắc: ${items.color}</h7><br>
                    <h7>Kích thước: ${items.size}</h7>
                </div>
                <div class="text-right">
                    <span>${parseFloat(items.total_price).toLocaleString()} đ</span>
                </div>
            </div>`;
            container.insertAdjacentHTML('beforeend',row);
            });
            // hiển thị tổng tiền và giảm giá tạm thời cho 0
            showAllMoneyItems(totalPrice,0);
        }
            else{
                alert("Vui lòng thêm sản phẩm để tiến hành thanh toán");
                console.log('Không có giá trị nào cả');
            }
        }).catch(error => console.error('Đã có lỗi xảy ra',error));
    }

    // //@thực thi hiển thị tổng tiền đơn hàng
    function showAllMoneyItems(total_price=0, discount=0)
    {
        const getElement =  document.getElementById('order-summary-container');
        total_payment = total_price- discount;
        const summaryHTML = `
            <div class="order-summary">
                <div class="item">
                    <span>Tổng tiền:</span>
                    <span>${parseFloat(total_price).toLocaleString()} đ</span>
                </div>
                <div class="item">
                    <span>Tổng khuyến mãi:</span>
                    <span>${discount.toLocaleString()} đ</span>
                </div>
                <div class="item">
                    <span>Phí vận chuyển:</span>
                    <span>Miễn phí</span>
                </div>
                <hr>
                <div class="total">
                    <span>Cần thanh toán:</span>
                    <span>${total_payment.toLocaleString()} đ</span>
                </div>
            </div>
            <button class="btn btn-order btn-block mt-4">Đặt hàng</button>
        `;
        // getElement.innerHTML = summaryHTML;
        getElement.insertAdjacentHTML('beforeend', summaryHTML);

    }
    showAllItemsPayMoney();
});

