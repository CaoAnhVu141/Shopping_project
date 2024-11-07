// hiển tị toàn bộ danh sách sản phẩm trong giỏ hàng
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
            <td class="column-3">${parseFloat(data.price).toLocaleString()} đ</td>
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
            <td class="column-5 total-price" data-id="${data.id_product}">${parseFloat(data.total_price).toLocaleString()} đ</td>
            <td>
            <a href="" class="btn-delete-item text-red-500 hover:bg-red-500 hover:text-white rounded-full px-3 py-1 transition-all duration-300" data-id="${data.id_product}">
                Xoá
            </a>
        </td>
        </tr>
            `;
            itemsShoppingCart.insertAdjacentHTML('beforeend', row);
        });
        // gọi hàm xoá
        buttonDeleteItems();
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
                    displayCartItems(data); // Hiển thị giỏ hàng khi có sản phẩm
                    updateTotalAllItems(); // Cập nhật tổng tiền
                } else {
                    // Hiển thị thông báo khi giỏ hàng trống
                    document.getElementById('items-shoppingcart').innerHTML = "<tr><td colspan='5'>Giỏ hàng của bạn đang trống</td></tr>";
                    // Cập nhật tổng tiền về 0 khi không có sản phẩm
                    document.getElementById('subtotal').innerText = "0 đ";
                    document.getElementById('total').innerText = "0 đ";
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
        // cập nhật lại tổng tiền trong giỏ hàng
        updateTotalAllItems();
        // cập nhật lên server
        updateQuantityOnServer(dataProduct, quantity);


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

    // viết hàm cập nhật số lượng của giỏ hàng
    function updateQuantityOnServer(productId, quantity) {
        fetch(`update-shopping-cart`, {
                method: "PUT",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id_product: productId,
                    quantity: quantity
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    showFetchAllItems();
                    alert("Cập nhật giỏ hàng thành công");
                } else {
                    alert("Đã có lỗi khi cập nhật");
                }
            }).catch(error => console.error('Đã có lỗi xảy ra', error));
    }
    //@ viết sự kiện cập nhật tổng tiền trong giỏ hàng
    function updateTotalAllItems() {
        // khởi tạo giá trị
        let totalPrice = 0;
        document.querySelectorAll('.total-price').forEach(items => {
            const lastPrice = items.innerHTML.replace(/[^0-9]/g, '');
            const afterPrice = parseFloat(lastPrice);
            totalPrice += afterPrice;
        });
        // thực hiện cập nhật giá trị cho subtal và total
        const subTotalElement = document.getElementById('subtotal');
        const totalElement = document.getElementById('total');
        if (subTotalElement && totalElement) {
            subTotalElement.innerHTML = `${totalPrice.toLocaleString()} đ`;
            totalElement.innerHTML = `${totalPrice.toLocaleString()} đ`;
        } else {
            console.error("Giá trị không có tồn tại");
        }
    }

    //@viết sự kiện xoá sản phẩm trong giỏ hàng
    function deteleItemsShoppingCart(productId) {
        const Id_session = localStorage.getItem('id_session');
        fetch(`/delete/shopping-cart/${productId}`, {
                method: "DELETE",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    session_id: Id_session
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    showFetchAllItems();
                    alert("Bạn đã xoá sản phẩm trong giỏ hàng thành công");
                } else {
                    alert("Đã có lỗi khi xoá");
                    console.error("Đã có lỗi khi xoá");
                }
            })
            .catch(error => console.error('Đã có lỗi xảy ra', error));
    }

    //@gắn sự kiện xoá trong giỏ hàng
    function buttonDeleteItems() {
        document.querySelectorAll('.btn-delete-item').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const data_shop = this.getAttribute('data-id');
                deteleItemsShoppingCart(data_shop);
            })
        })
    }

});
