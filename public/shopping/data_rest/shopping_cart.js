document.addEventListener('DOMContentLoaded', function () {
    // Hàm thêm sản phẩm vào giỏ hàng
    function addItemsToCart(Idproduct, quantity = 1) {
        if (!Idproduct) {
            console.error("ID sản phẩm không hợp lệ");
            return;
        }
        const sessionId = localStorage.getItem('id_session');
        // thực hiện lấy giá trị attribute
        const size = document.querySelector('select[name="size"]').value;
        const color = document.querySelector('select[name="color"]').value;

        if(!size && !color )
        {
            alert("Vui lòng chọn kích thước và màu sắc");
            console.error("Đã có lỗi khi thêm");
        }
        fetch(`/api/cart/add/${Idproduct}`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    quantity: quantity,
                    session_id: sessionId,
                    size: size,
                    color: color
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "Đã thêm dữ liệu thành công") {
                    alert("Đã thêm giỏ hàng thành công");
                    // Gọi hàm để cập nhật giỏ hàng ngay lập tức
                    showFetchItems();
                } else {
                    console.error("Đã có lỗi xảy ra:", data.message);
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Có lỗi rồi', error);
                alert("Có lỗi xảy ra khi thêm vào giỏ hàng.");
            });
    }

    // Hàm hiển thị sản phẩm trong giỏ hàng và cập nhật số lượng
    function showFetchItems() {
        fetch('/get/cart', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    document.getElementById('items-cart').innerHTML = `<li>${data.message}</li>`;
                    //bổ sung để lấy giá trị trong giỏ hàng
                    document.querySelector('.icon-header-noti').setAttribute('data-notify', '0');
                } else {
                    displayCartItems(data);
                    const totalItems = data.reduce((acc, item) => acc + item.quantity, 0);
                    document.querySelector('.icon-header-noti').setAttribute('data-notify', totalItems);
                }
            }).catch(error => console.error('Đã có lỗi xảy ra', error));
    }
    // Hàm để hiển thị sản phẩm trong danh sách giỏ hàng
    function displayCartItems(items) {
        let cartContent = document.getElementById('items-cart');
        cartContent.innerHTML = '';
        let totalPrice = 0;
        // chỉ cho in ra 3 sản phẩm thôi nè
        const itemsCartShopping = items.slice(0,3);
        itemsCartShopping.forEach(data => {
            totalPrice += parseFloat(data.total_price);
            const row = `<li class="header-cart-item flex-w flex-t m-b-12">
                <div class="header-cart-item-img">
                    <img src="{{asset("shoppimg/images/item-cart-01.jpg")}}" alt="IMG">
                </div>
                <div class="header-cart-item-txt p-t-8">
                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                        ${data.product_name}
                    </a>
                    <span class="header-cart-item-info">
                        ${data.quantity} x ${parseFloat(data.price).toLocaleString()} VND
                    </span>
                </div>
            </li>`;
            cartContent.insertAdjacentHTML('beforeend', row);
        });
        const cartTotalElement = document.getElementById('cart-total');
        if (cartTotalElement) {
            cartTotalElement.textContent = `Tổng tiền: ${totalPrice.toLocaleString()} VND`;
        } else {
            console.error('Không tìm thấy phần tử có ID "cart-total"');
        }

    }
    // Sự kiện tăng và giảm số lượng
    const quantityUp = document.querySelector('.btn-num-product-up');
    const quantityDown = document.querySelector('.btn-num-product-down');
    const addCartButton = document.querySelector('.js-addcart-detail');
    if (quantityUp && quantityDown && addCartButton) {
        quantityUp.addEventListener('click', function () {
            const quantityInput = document.getElementById('product-quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });
        quantityDown.addEventListener('click', function () {
            const quantityInput = document.getElementById('product-quantity');
            quantityInput.value = Math.max(parseInt(quantityInput.value) - 1, 1);
        });
        addCartButton.addEventListener('click', function () {
            const Idproduct = this.getAttribute('data-id');
            const quantity = parseInt(document.getElementById('product-quantity').value);
            addItemsToCart(Idproduct, quantity);
        });
    }
    // Gọi `showFetchItems` khi trang tải xong
    showFetchItems();
});
