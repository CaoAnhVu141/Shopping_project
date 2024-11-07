let currentPage = 1;
let currentCategoryId = 0;
let currentMinPrice = 0;
let currentMaxPrice = Infinity;
let currentLoadMoreType = 'category';
let currentSearchQuery = '';

document.addEventListener('DOMContentLoaded', function () {
    const filterCategories = document.querySelectorAll('.filter-tope-group button');
    const priceLinks = document.querySelectorAll('#filter-price .filter-link');
    const sortFilters = document.querySelectorAll('#filter-sort .filter-link');
    const searchInput = document.querySelector('#search-product');
    const loadMoreBtn = document.querySelector('#load-more-button');

    if (sortFilters.length > 0) {
        sortFilters.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                currentSortType = link.dataset.sort;
                currentPage = 1;
                currentLoadMoreType = 'sort';

                loadProductsBySort(currentSortType, currentPage);
            });
        });
    }

    // loc su kien theo danh muc
    if (filterCategories.length > 0) {
        filterCategories.forEach(button => {
            button.addEventListener('click', function () {
                currentCategoryId = button.dataset.filter;
                currentPage = 1;
                currentLoadMoreType = 'category';

                loadProducts(currentCategoryId, currentPage);
            });
        });
    }

    // loc su kien theo gia tien
    if (priceLinks.length > 0) {
        priceLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                const priceRange = link.innerText;
                [currentMinPrice, currentMaxPrice] = parsePriceRange(priceRange);
                currentPage = 1;
                currentLoadMoreType = 'price';

                loadProductsByPrice(currentMinPrice, currentMaxPrice, currentPage);
            });
        });
    }

    // Lay gia tri tien lon nhat va nho nhat
    function parsePriceRange(priceRange) {
        if (priceRange === 'All') return [0, Infinity];

        const range = priceRange.split('-').map(price => parseInt(price.replace(/\D/g, '')));
        return range.length === 2 ? range : [range[0], Infinity];
    }

    function debounce(func, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    searchInput.addEventListener('input', debounce(function () {
        currentSearchQuery = searchInput.value.trim();
        currentPage = 1;
        currentLoadMoreType = 'search';
        searchProducts(currentSearchQuery, currentPage);
    }, 300));


    // Load thêm sản phẩm khi nhấn nút "Load More"
    loadMoreBtn.addEventListener('click', function () {
        currentPage++;
        if (currentLoadMoreType === 'category') {
            loadProducts(currentCategoryId, currentPage);
        } else if (currentLoadMoreType === 'price') {
            loadProductsByPrice(currentMinPrice, currentMaxPrice, currentPage);
        } else if (currentLoadMoreType === 'search') {
            searchProducts(currentSearchQuery, currentPage);
        } else if (currentLoadMoreType === 'sort') {
            loadProductsBySort(currentSortType, currentPage);
        }
    });

    // Loc san pham theo dang sap xep gia
    function loadProductsBySort(sortType, page) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/filter/sort', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ sort: sortType, page: page })
        })
            .then(response => response.json())
            .then(data => renderProducts(data.products, data.total, page))
            .catch(err => console.log('Error: ', err));
    }

    // Loc san pham theo gia
    function loadProductsByPrice(minPrice, maxPrice, page) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/filter/price', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ min_price: minPrice, max_price: maxPrice, page: page })
        })
            .then(response => response.json())
            .then(data => renderProducts(data.products, data.total, page))
            .catch(err => console.log('Error: ', err));
    }

    // loc san pham theo danh muc 
    function loadProducts(categoryId, page) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/load-more/products', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ category_id: categoryId, page: page })
        })
            .then(response => response.json())
            .then(data => {
                const products = data.products;
                const total = data.total;

                // Xóa các sản phẩm cũ nếu là trang đầu tiên (chuyển danh mục)
                if (page === 1) {
                    document.querySelector('.product-grid').innerHTML = '';
                }

                renderProducts(products, total, page);
            })
            .catch(error => console.log('Error', error));
    }

    // tim kiem san pham
    function searchProducts(query, page) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/search/products', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ query: query, page: page })
        })
            .then(response => response.json())
            .then(data => renderProducts(data.products, data.total, page))
            .catch(error => console.log('Error:', error));
    }


    function renderProducts(products, total, page) {
        const productContainer = document.querySelector('.product-grid');
        const loadMoreBtn = document.querySelector('#load-more-button');

        if (!productContainer && !loadMoreBtn) return;

        if (page === 1) {
            productContainer.innerHTML = '';
        }

        products.forEach(product => {
            const productCard = `
              <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 product-item watches">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <img src="../shopping/images/${product.images}">
                        <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                            Quick View
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                ${product.name}
                            </a>

                            <span class="stext-105 cl3">
                                ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)}
                            </span>
                        </div>

                        <div class="block2-txt-child2 flex-r p-t-3">
                            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                <i class="fa fa-heart text-secondary"></i> <!-- Sử dụng Bootstrap để đổi màu -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
            productContainer.innerHTML += productCard;
        });

        console.log(total, page);
        if (total <= page * 8) {
            loadMoreBtn.classList.add('d-none');
            loadMoreBtn.classList.remove('d-flex');
        } else {
            loadMoreBtn.classList.add('d-flex');
            loadMoreBtn.classList.remove('d-none');
        }
    }
});
