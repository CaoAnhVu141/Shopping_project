// // viết hàm tải modal cho sản phẩm
// function loadModalProducts(productId) {
//     fetch(`api/get-product/${productId}`).then(response => response.json()).then(data => {

//         if (data.message == "Giá trị hợp lệ") {
//             const rowModal = `

//             <div class="overlay-modal1 js-hide-modal1"></div>
//                     <div class="container">
//                         <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
//                             <button class="how-pos3 hov3 trans-04 js-hide-modal1">
//                                 <img src="/shopping/images/icons/icon-close.png" alt="CLOSE">
//                             </button>
//                             <div class="row">
//                                 <div class="col-md-6 col-lg-7 p-b-30">
//                                     <div class="p-l-25 p-r-30 p-lr-0-lg">
//                                         <div class="wrap-slick3 flex-sb flex-w">
//                                             <div class="wrap-slick3-dots"></div>
//                                             <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
//                                             <div class="slick3 gallery-lb">

//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                                 <div class="col-md-6 col-lg-5 p-b-30">
//                                     <div class="p-r-50 p-t-5 p-lr-0-lg">
//                                         <h4 class="mtext-105 cl2 js-name-detail p-b-14">${data.name}</h4>
//                                         <span class="mtext-106 cl2">${data.price}</span>
//                                         <p class="stext-102 cl3 p-t-23">${data.description}</p>
//                                         <div class="p-t-33">
//                                             <div class="flex-w flex-r-m p-b-10">
//                                                 <div class="size-203 flex-c-m respon6">Size</div>
//                                                 <div class="size-204 respon6-next">
//                                                     <select class="js-select2" name="size">

//                                                     </select>
//                                                 </div>
//                                             </div>
//                                             <div class="flex-w flex-r-m p-b-10">
//                                                 <div class="size-203 flex-c-m respon6">Color</div>
//                                                 <div class="size-204 respon6-next">
//                                                     <select class="js-select2" name="color">

//                                                     </select>
//                                                 </div>
//                                             </div>
//                                             <div class="flex-w flex-r-m p-b-10">
//                                                 <div class="size-204 flex-w flex-m respon6-next">
//                                                     <div class="wrap-num-product flex-w m-r-20 m-tb-10">
//                                                         <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
//                                                             <i class="fs-16 zmdi zmdi-minus"></i>
//                                                         </div>
//                                                         <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">
//                                                         <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
//                                                             <i class="fs-16 zmdi zmdi-plus"></i>
//                                                         </div>
//                                                     </div>
//                                                     <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
//                                                         Add to cart
//                                                     </button>
//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>`;

//             //@nhúng nội dung vào theme
//             document.querySelector('.wrap-modal1').innerHTML = rowModal;
//             // Cập nhật giá trị
//             const model = document.querySelectorAll('.js-modal1');
//             if (model) {
//                 model.classList.add('show-modal1');
//             }
//             // viết sự kiện đóng modal
//             document.querySelectorAll('.js-hide-modal1').forEach(button => {
//                 button.addEventListener('click', () => {
//                     const modal = document.querySelector('.js-modal1');
//                     if (modal) {
//                         modal.classList.remove('show-modal1');
//                     }
//                 });
//             });
//         } else {
//             alert("Không tìm thấy sản phẩm tương ứng");
//         }
//     }).catch(error => console.error('Đã có lỗi xảy ra', error));
// }

// // viết sự kiện onclick

// document.querySelectorAll('.js-show-modal1').forEach(button => {
//     button.addEventListener('click', function (event) {
//         event.preventDefault();
//         // lấy id về và thực thi gọi hàm lên
//         const dataLoadId = this.getAttribute('data-id');
//         console.log("Đóng cho anh nha cho em ID là: " + dataLoadId);
//         loadModalProducts(dataLoadId);
//     });
// });


// // Hàm tải modal sản phẩm
function loadModalProducts(productId) {
    fetch(`api/get-product/${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.message === "Giá trị hợp lệ") {
                // console.log(data.data.name);
                const rowModal = `
            <div class="overlay-modal1 js-hide-modal1"></div>
                    <div class="container">
                        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                            <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                                <img src="/shopping/images/icons/icon-close.png" alt="CLOSE">
                            </button>
                            <div class="row">
                                <div class="col-md-6 col-lg-7 p-b-30">
                                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                                        <div class="wrap-slick3 flex-sb flex-w">
                                            <div class="wrap-slick3-dots"></div>
                                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                                            <div class="slick3 gallery-lb">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-5 p-b-30">
                                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">${data.data.name}</h4>
                                        <span class="mtext-106 cl2">${data.data.price}</span>
                                        <p class="stext-102 cl3 p-t-23">${data.data.describe}</p>
                                        <div class="p-t-33">
                                            <div class="flex-w flex-r-m p-b-10">
                                                <div class="size-203 flex-c-m respon6">Size</div>
                                                <div class="size-204 respon6-next">
                                                    <select class="js-select2" name="size">
                                                        <option>Choose an option</option>
                                                        <option>Size S</option>
                                                        <option>Size M</option>
                                                        <option>Size L</option>
                                                        <option>Size XL</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex-w flex-r-m p-b-10">
                                                <div class="size-203 flex-c-m respon6">Color</div>
                                                <div class="size-204 respon6-next">
                                                    <select class="js-select2" name="color">
                                                         <option>Choose an option</option>
                                                        <option>Red</option>
                                                        <option>Blue</option>
                                                        <option>White</option>
                                                        <option>Grey</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex-w flex-r-m p-b-10">
                                                <div class="size-204 flex-w flex-m respon6-next">
                                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                                        </div>
                                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">
                                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                                        </div>
                                                    </div>
                                                    <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                        Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                // Nhúng nội dung vào modal
                document.querySelector('.wrap-modal1').innerHTML = rowModal;

                // Hiển thị modal
                const modal = document.querySelector('.js-modal1');
                if (modal) {
                    modal.classList.add('show-modal1');
                }

                // Đặt sự kiện đóng modal
                document.querySelectorAll('.js-hide-modal1').forEach(button => {
                    button.addEventListener('click', () => {
                        const modal = document.querySelector('.js-modal1');
                        if (modal) {
                            modal.classList.remove('show-modal1');
                        }
                    });
                });
            } else {
                alert("Không tìm thấy sản phẩm tương ứng");
            }
        })
        .catch(error => console.error('Đã có lỗi xảy ra', error));
}

// Sự kiện click cho nút Quick View
document.querySelectorAll('.js-show-modal1').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        // Lấy ID sản phẩm và gọi hàm hiển thị modal
        const dataLoadId = this.getAttribute('data-id');
        console.log("Đóng cho anh nha cho em ID là: " + dataLoadId);

        loadModalProducts(dataLoadId);
    });
});

// Hàm hiển thị dữ liệu chi tiết sản phẩm (product_detail)
function loadDataProductDetail(Idproduct) {
    fetch(`product_detail/${Idproduct}`)
        .then(response => response.text())
        .then(html => {
            document.getAttribute('#row').innerHTML = html;  // Đảm bảo chỉ chọn phần tử đầu tiên có ID "row"
            // Cập nhật URL mà không cần reload lại trang
            history.pushState(null, '', `product_detail/${Idproduct}`);
        })
        .catch(error => console.error('Đã có lỗi xảy ra', error));
}

// Xử lý sự kiện khi người dùng nhấn nút "quay lại" trên trình duyệt
window.addEventListener('popstate', function() {
    location.reload();
});

// Thực thi sự kiện cho bấm vào chi tiết
document.querySelectorAll('product-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        // Lấy product ID và gọi hàm tải chi tiết sản phẩm
        const productId = this.getAttribute('data-id');
        loadDataProductDetail(productId);
    });
});


