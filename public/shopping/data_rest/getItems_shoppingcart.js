document.addEventListener('DOMContentLoaded', function () {
    function displayCartItems(items) {
        let itemsShoppingCart = document.getElementById('items-shoppingcart');
        itemsShoppingCart.innerHTML = '';
        items.forEach(data => {
            const row = `
                <tr class="table_row">
            <td class="column-1">
                <div class="how-itemcart1">
                    <img src="images/item-cart-04.jpg" alt="IMG">
                </div>
            </td>
            <td class="column-2">${data.product_name}</td>
            <td class="column-3">${data.price.toLocaleString()} đ</td>
            <td class="column-4">
                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" data-id="${data.id_product}" data-price="${data.price}">
                        <i class="fs-16 zmdi zmdi-minus"></i>
                    </div>
                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="${data.quantity}" data-id="${data.id_product}">
                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" data-id="${data.id_product}" data-price="${data.price}">
                        <i class="fs-16 zmdi zmdi-plus"></i>
                    </div>
                </div>
            </td>
            <td class="column-5 total-price" data-id="${data.id_product}">${data.total_price.toLocaleString()} đ</td>
        </tr>
            `;
            itemsShoppingCart.insertAdjacentHTML('beforeend', row);
        });
        attachQuantityEvents();
    }

    function showFetchAllItems() {
        fetch('/get/cart', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    displayCartItems(data);
                } else {
                    alert("Bạn chưa có sản phẩm nào trong giỏ hàng");
                    console.log("Không có giá trị trong giỏ hàng");
                }
            }).catch(error => console.error('Đã có lỗi xảy ra', error));
    }
    showFetchAllItems()

    // viết hàm cập nhật số lượng trong giỏ hàng
    function updateQuantityItemsShopping(button, change) {
        const dataProduct = button.getAttribute('data-id');
        const dataPrice = parseInt(button.getAttribute('data-price'));
        const input = document.querySelector(`input[data-id="${dataProduct}"]`);
        const totalPrice = document.querySelector(`.total-price[data-id="${dataProduct}"]`);

        let quantity = parseInt(input.value) + change;
        if (quantity < 1) quantity = 1;

        input.value = quantity;
        const newTotalPrice = quantity * dataPrice;
        totalPrice.innerHTML = `${newTotalPrice.toLocaleString()} đ`;
    }

    function attachQuantityEvents() {
        // gọi sự kiện khi bấm thêm và giảm
        document.querySelectorAll('.btn-num-product-down').forEach(button => {
            button.addEventListener('click', function () {
                console.log("Đóng gạch cho anh đi em");
                updateQuantityItemsShopping(button, -1);
            })
        });


        document.querySelectorAll('.btn-num-product-up').forEach(button => {
            button.addEventListener('click', function () {
                console.log("Bê quá anh ơi");
                updateQuantityItemsShopping(button, 1);
            })
        })
    }
});
