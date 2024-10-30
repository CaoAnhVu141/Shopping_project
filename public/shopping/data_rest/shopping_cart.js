// // thêm vào giỏ hàng
function addItemsToCart(Idproduct,quantity=1) {
    if (!Idproduct) {
        console.error("ID sản phẩm không hợp lệ");
        return;
    }
const sessionId = localStorage.getItem('id_session');
    fetch(`/api/cart/add/${Idproduct}`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                quantity: quantity,
                    session_id: sessionId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === "Đã thêm dữ liệu thành công") {
                alert("Đã thêm giỏ hàng thành công");
                // Kiểm tra nếu data.data có nội dung
                if (data.data && data.data.length > 0) {
                    showItemsShoppingCart(data.data);
                } else {
                    console.error("Dữ liệu giỏ hàng trống");
                }
            } else {
                console.error("Đã có lỗi xảy ra:", data.message);
                alert(data.message); // Hiển thị thông báo lỗi chi tiết
            }
        })
        .catch(error => {
            console.error('Có lỗi rồi', error);
            alert("Có lỗi xảy ra khi thêm vào giỏ hàng.");
        });
}
// function addItemsToCart(Idproduct, quantity = 1) {
//     if (!Idproduct) {
//         console.error("ID sản phẩm không hợp lệ");
//         return;
//     }

//     // Lấy session ID từ localStorage
//     const sessionId = localStorage.getItem('id_session');

//     fetch(`/api/cart/add/${Idproduct}`, {
//         method: "POST",
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             quantity: quantity,
//             session_id: sessionId  // Truyền session_id vào yêu cầu
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.message === "Đã thêm dữ liệu thành công") {
//             alert("Đã thêm giỏ hàng thành công");
//             if (data.data && data.data.length > 0) {
//                 showItemsShoppingCart(data.data);
//             } else {
//                 console.error("Dữ liệu giỏ hàng trống");
//             }
//         } else {
//             console.error("Đã có lỗi xảy ra:", data.message);
//             alert(data.message);
//         }
//     })
//     .catch(error => {
//         console.error('Có lỗi rồi', error);
//         alert("Có lỗi xảy ra khi thêm vào giỏ hàng.");
//     });
// }

// viết hàm hiển thị danh sách giỏ hàng
function showItemsShoppingCart(valueItems) {
    const listShowCart = document.getElementById('list_showcart');
    if(!listShowCart)
    {
        console.error("Không tìm thấy giá trị");
        return;
    }
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
           <td class="column-3">$${parseFloat(items.price).toFixed(2)}</td>
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

//@tiếp tục xử lý nút thêm vào giỏ hàng
// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.js-addcart-detail').forEach(button => {
//         button.addEventListener('click', function(event) {
//             event.preventDefault();
//             // Lấy ID sản phẩm từ thuộc tính data-id của nút
//             const Idproduct = this.getAttribute('data-id');
//             console.log("Sao khoan hoài vậy a? ");
//             // Gọi hàm addItemsToCart với ID sản phẩm
//             addItemsToCart(Idproduct);
//         });
//     });
// });


//@ thực thi viết hàm cập nhật số lượng và giá cờ men lại


// sự kiện của chat GPT
document.addEventListener('DOMContentLoaded', function () {
    // Sự kiện cho nút tăng số lượng
    document.querySelector('.btn-num-product-up').addEventListener('click', function () {
        const quantityInput = document.getElementById('product-quantity');
        const newQuantity = parseInt(quantityInput.value) + 1;
        quantityInput.value = newQuantity;
    });

    // Sự kiện cho nút giảm số lượng
    document.querySelector('.btn-num-product-down').addEventListener('click', function () {
        const quantityInput = document.getElementById('product-quantity');
        const newQuantity = Math.max(parseInt(quantityInput.value) - 1, 1); // Giữ cho số lượng không nhỏ hơn 1
        quantityInput.value = newQuantity;
    });

    // Sự kiện thêm vào giỏ hàng
    document.querySelector('.js-addcart-detail').addEventListener('click', function () {
        const Idproduct = this.getAttribute('data-id'); // Lấy ID sản phẩm từ nút
        const quantity = parseInt(document.getElementById('product-quantity').value); // Lấy số lượng hiện tại
        addItemsToCart(Idproduct, quantity);
    });
});












