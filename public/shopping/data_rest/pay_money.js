document.addEventListener('DOMContentLoaded', function () {
    // //@Viết hàm hiển thị toàn bộ sản phẩm ra
    function showAllItemsPayMoney() {
        fetch(`api/make-payment`).then(response => response.json())
            .then(data => {
                const container = document.getElementById('cart-items-container');
                container.innerHTML = '';
                let totalPrice = 0;
                if (data.length > 0) {
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
                        container.insertAdjacentHTML('beforeend', row);
                    });
                    // hiển thị tổng tiền và giảm giá tạm thời cho 0
                    showAllMoneyItems(totalPrice, 0);
                } else {
                    alert("Vui lòng thêm sản phẩm để tiến hành thanh toán");
                    console.log('Không có giá trị nào cả');
                }
            }).catch(error => console.error('Đã có lỗi xảy ra', error));
    }

    // //@thực thi hiển thị tổng tiền đơn hàng
    function showAllMoneyItems(total_price = 0, discount = 0) {
        const getElement = document.getElementById('order-summary-container');
        total_payment = total_price - discount;
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
        `;
        // <button class="btn btn-order btn-block mt-4">Đặt hàng</button>
        // getElement.innerHTML = summaryHTML;
        getElement.insertAdjacentHTML('beforeend', summaryHTML);

    }

    // //@thực thi viết hàm đặt hàng
    // function orderAllItemsShoppingCart() {
    //     //thực thi lấy dữ liệu từ form
    //     const name = document.querySelector('input[name="customer_name"]').value;
    //     const phone = document.querySelector('input[name="customer_phone"]').value;
    //     const email = document.querySelector('input[name="customer_email"]').value;
    //     const address = document.querySelector('input[name="shipping_address"]').value;
    //     const payment_method = document.querySelector('input[name="payment_method"]:checked').value;
    //     const shipping_method = document.querySelector('input[name="shipping_method"]:checked').value;

    //     if(!address)
    //     {
    //         alert("Vui lòng điền địa chỉ vào");
    //         return;
    //     }
    //     const orderData = {
    //         customer_name: name,
    //         customer_phone: phone,
    //         customer_email: email,
    //         shipping_address: address,

    //         shipping_method: shipping_method,
    //         payment_method: payment_method,
    //     };
    //     console.log("Dữ liệu orderData: ", orderData);
    //     // thực thi gọi api cho đặt hàng
    //     fetch(`/api/order-items`, {
    //             method: "POST",
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             },
    //             body: JSON.stringify(orderData)
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.message == "Đặt hàng thành công") {
    //                 alert("Bạn đã đặt hàng thành công");
    //                 console.log("Đã đặt hàng thành công rồi nè");
    //             } else {
    //                 alert("Lỗi đặt hàng rồi bạn ơi");
    //                 console.log(error);
    //             }
    //         })
    //         .catch(error => console.error('Đã có lỗi xảy ra', error));
    // }

    // //@ lắng nghe sự kiện đặt hàng
    // document.addEventListener('click', function (event) {
    //     if (event.target && event.target.id == 'btn-order') {
    //         event.preventDefault();
    //         console.log("Đóng gạch cho anh");
    //         orderAllItemsShoppingCart();
    //     }
    // });


    // //@thực thi viết hàm đặt hàng
    function orderAllItemsShoppingCart() {
        // Lấy dữ liệu từ form
        const name = document.querySelector('input[name="customer_name"]').value;
        const phone = document.querySelector('input[name="customer_phone"]').value;
        const email = document.querySelector('input[name="customer_email"]').value;
        // Lấy giá trị từ dropdown Tỉnh, Quận/Huyện, Phường/Xã
        const province = document.querySelector('select[name="method_province"]').selectedOptions[0].text;
        const district = document.querySelector('select[name="method_district"]').selectedOptions[0].text;
        const commune = document.querySelector('select[name="method_ward"]').selectedOptions[0].text;

        // Lấy địa chỉ chi tiết
        const address_details = document.querySelector('textarea[name="shipping_address"]').value;

        // Kết hợp thành địa chỉ đầy đủ
        const shipping_address = `${address_details}, ${commune}, ${district}, ${province}`;
        if (province === "0" || district === "0" || commune === "0" || !address_details) {
            alert("Vui lòng điền đầy đủ thông tin địa chỉ.");
            return;
        }
        // Lấy phương thức thanh toán và phương thức vận chuyển
        const payment_method = document.querySelector('input[name="payment_method"]:checked').value;
        const shipping_method = document.querySelector('input[name="shipping_method"]:checked').value;

        // Dữ liệu đặt hàng
        const orderData = {
            customer_name: name,
            customer_phone: phone,
            customer_email: email,
            shipping_address: shipping_address,
            shipping_method: shipping_method,
            payment_method: payment_method,
        };

        console.log("Dữ liệu orderData: ", orderData);

        // Thực thi gọi API để đặt hàng
        fetch(`/api/order-items`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(orderData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.message == "Đặt hàng thành công") {
                    alert("Bạn đã đặt hàng thành công");
                    console.log("Đã đặt hàng thành công rồi nè");
                } else {
                    alert("Lỗi đặt hàng rồi bạn ơi");
                    console.log(data.error);
                }
            })
            .catch(error => console.error('Đã có lỗi xảy ra', error));
    }

    //@ Lắng nghe sự kiện đặt hàng
    document.addEventListener('click', function (event) {
        if (event.target && event.target.id == 'btn-order') {
            event.preventDefault();
            console.log("Đang thực hiện đặt hàng");
            orderAllItemsShoppingCart();
        }
    });

    //@ thực thi viết phương thức đặt hàng
    showAllItemsPayMoney();
});
