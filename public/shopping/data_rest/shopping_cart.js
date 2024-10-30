// thêm vào giỏ hàng
function addItemsToCard(Idproduct) {
    if (!Idproduct) {
        console.error("ID sản phẩm không hợp lệ");
        return;
    }
    fetch(`api/cart/add/${Idproduct}`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                quantity: 1
            })
        }).then(response => response.json())
        .then(data => {
            if (data.message === "Đã thêm dữ liệu thành công") {
                alert("Đã thêm giỏ hàng thành công");
                if (data.data) {
                    showItemsShoppingCart(data.data);
                } else {
                    console.error("Dữ liệu giỏ hàng trống");
                }
            } else {
                console.error("Đã có lỗi xảy ra:", data.message);
            }
        })
        .catch(error => {
            console.error('Có lỗi rồi', error);
            alert("Có lỗi xảy ra khi thêm vào giỏ hàng.");
        });
}


// viết hàm hiển thị danh sách giỏ hàng
function showItemsShoppingCart(valueItems) {
    const listShowCart = document.getElementById('list_showcart');
    listShowCart.innerHTML = '';
    valueItems.forEach(items => {
        const row = document.createElement('tr');
        row.classList.add('table_row');
        row.innerHTML = `
            <td class="column-1">
                <div class="how-itemcart1">
                    <img src="${items.image}" alt="IMG">
                </div>
            </td>
            <td class="column-2">${items.name}</td>
            <td class="column-3">$${items.price}</td>
            <td class="column-4">
                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="updateQuantity(${items.id_shopping_cart}, -1)">
                        <i class="fs-16 zmdi zmdi-minus"></i>
                    </div>
                    <input class="mtext-104 cl3 txt-center num-product" type="number" value="${items.quantity}" onchange="changeQuantity(${items.id_shopping_cart}, this.value)">

                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="updateQuantity(${items.id_shopping_cart}, 1)">
                        <i class="fs-16 zmdi zmdi-plus"></i>
                    </div>
                </div>
            </td>
            <td class="column-5">$${items.total_price}</td>
        `;
        listShowCart.appendChild(row); //thêm hàng mới vào table
    })
}
