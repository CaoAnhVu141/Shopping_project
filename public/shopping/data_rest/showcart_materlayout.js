document.addEventListener('DOMContentLoaded', function () {
    // Hàm hiển thị sản phẩm trong giỏ hàng và cập nhật số lượng
    function showFetchItems() {
        fetch('/get/cart', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.message) {
                    const itemsCartElement = document.getElementById('items-cart');
                    if (itemsCartElement) {
                        itemsCartElement.innerHTML = `<li>${data.message}</li>`;
                    }
                    // Cập nhật thông báo số lượng giỏ hàng thành 0
                    const iconHeaderNoti = document.querySelector('.icon-header-noti');
                    if (iconHeaderNoti) {
                        iconHeaderNoti.setAttribute('data-notify', '0');
                    }
                } else {
                    displayCartItems(data);
                    const totalItems = data.reduce((acc, item) => acc + item.quantity, 0);
                    const iconHeaderNoti = document.querySelector('.icon-header-noti');
                    if (iconHeaderNoti) {
                        iconHeaderNoti.setAttribute('data-notify', totalItems);
                    }
                }
            })
            .catch(error => console.error('Đã có lỗi xảy ra:', error));
    }

    // Hàm để hiển thị sản phẩm trong danh sách giỏ hàng
    function displayCartItems(items) {
        const cartContent = document.getElementById('items-cart');
        if (!cartContent) {
            console.error('Không tìm thấy phần tử có ID "items-cart"');
            return;
        }

        cartContent.innerHTML = '';
        let totalPrice = 0;

        // Chỉ hiển thị tối đa 3 sản phẩm
        const itemsCartShopping = items.slice(0, 3);
        itemsCartShopping.forEach(data => {
            totalPrice += parseFloat(data.total_price);
            const row = `<li class="header-cart-item flex-w flex-t m-b-12">
                <div class="header-cart-item-img">
                    <img src="/path/to/your/image/item-cart-01.jpg" alt="IMG">
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

        // Cập nhật tổng tiền
        const cartTotalElement = document.getElementById('cart-total');
        if (cartTotalElement) {
            cartTotalElement.textContent = `Tổng tiền: ${totalPrice.toLocaleString()} VND`;
        } else {
            console.error('Không tìm thấy phần tử có ID "cart-total"');
        }
    }

    // Gọi `showFetchItems` khi trang tải xong
    showFetchItems();
});
