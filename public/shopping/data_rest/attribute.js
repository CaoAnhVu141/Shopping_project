document.addEventListener('DOMContentLoaded', function () {
    // Hàm để lấy dữ liệu phân trang từ API
    function fetchAttributes(page = 1) {
        fetch(`/api/attribute?page=${page}`) // Thay đổi page động
            .then(response => response.json()) // Chuyển đổi phản hồi thành JSON
            .then(data => {
                const attributeList = document.getElementById('attribute-list');
                attributeList.innerHTML = ''; // Xóa nội dung cũ nếu có

                // Lặp qua danh sách attributes trong `data.data`
                data.data.forEach((attribute, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${(data.from + index)}</td>
                        <td>${attribute.name}</td>
                        <td>${attribute.describe}</td>
                        <td>${attribute.checkactive ? 'Show' : 'Hide'}</td>
                        <td>${attribute.created_at}</td>
                        <td>
                            <a href="" class="btn btn-xs btn-primary js-update-confirm" data-id="${attribute.id_attribute}">Edit</a>
                            <a href="" class="btn btn-xs btn-danger js-delete-confirm" data-id="${attribute.id_attribute}">Delete</a>
                        </td>`;
                    attributeList.appendChild(tr);
                });

                // Hiển thị các link phân trang
                const paginationLinks = document.getElementById('pagination-links');
                paginationLinks.innerHTML = createPaginationLinks(data);
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu:', error));
    }


    // @Hàm để tạo các link phân trang
    function createPaginationLinks(data) {
        let links = '';
        if (data.prev_page_url) {
            links += `<li><a href="#" class="pagination-link" data-page="${data.current_page - 1}">Previous</a></li>`;
        }

        for (let i = 1; i <= data.last_page; i++) {
            links += `<li class="${i === data.current_page ? 'active' : ''}">
                        <a href="#" class="pagination-link" data-page="${i}">${i}</a>
                      </li>`;
        }

        if (data.next_page_url) {
            links += `<li><a href="#" class="pagination-link" data-page="${data.current_page + 1}">Next</a></li>`;
        }
        return links;
    }

    //@ Xử lý sự kiện click vào các link phân trang
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('pagination-link')) {
            event.preventDefault();
            const page = event.target.getAttribute('data-page');
            fetchAttributes(page); // Gọi lại API với trang mới
        }
    });

    // @thực hiện xoá phần tử
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('js-delete-confirm')) {
            event.preventDefault();
            const data_id = event.target.getAttribute("data-id");
            if (confirm("Bạn có muốn xoá giá trị này không")) {
                fetch(`api/attribute/${data_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(respone => respone.json())
                    .then(data => {
                        if (data.message === 'Xoá thành công!') {
                            alert("Bạn đã xoá thành công");
                            fetchAttributes();
                        } else {
                            alert("Không thể xoá phần tử");
                        }
                    })
                    .catch(error => console.error("Lỗi", error));
            }
        }
    });

    document.getElementById('create-attribute').addEventListener('click', function (event) {
        event.preventDefault();
        loadButtonCreate(); // Gọi hàm loadButtonCreate để tải form "Thêm mới"
    });

    // @thực thi thêm vào database
    function loadButtonCreate() {
        fetch('/api/attribute/create')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content-area').innerHTML = data;
                submitDataAttribute('create-attribute-form');
            })
            .catch(error => console.log("Đã xảy ra lỗi", error));
    }

    //
    function submitDataAttribute(data_form) {
        const form = document.getElementById(data_form);
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            // Gửi dữ liệu qua AJAX
            fetch('/api/attribute/create', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert("Bạn thêm dữ liệu thành công");
                        window.location.href = '/attribute';
                    }
                })
                .catch(error => {
                    alert("Đã xảy ra lỗi khi thêm dữ liệu. Vui lòng thử lại.");
                    console.log("Lỗi khi thêm vào", error);
                });
        });
    }

    //@ thực thi viết hàm load lại trang
    function loadAgainIndex() {
        fetch('/attribute').then(response => response.text()).then(data => {
                document.getElementById('content-area').innerHTML = data;
                fetchAttributes();
            })
            .catch(error => console.log("Đã có lỗi khi load lại trang", error));
    }


    // @bắt đầu sự kiện nút edit
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('js-update-confirm')) {
            event.preventDefault();
            const data_id = event.target.getAttribute('data-id');
            // thực thi gọi api
            fetch(`/api/attribute/update/${data_id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('content-area').innerHTML = data.html;
                    submitToUpdate('form-edit', data_id);
                })
                .catch(error => console.error('Đã xảy ra lỗi', error));

        }
    });

    function submitToUpdate(form_id, data_id) {
        const form = document.getElementById(form_id);
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Ngăn hành động submit mặc định

            const formData = new FormData(this); // Lấy dữ liệu từ form
            console.log([...formData]); // In dữ liệu form ra để kiểm tra

            // Gửi dữ liệu cập nhật qua fetch
            fetch(`/api/attribute/update/${data_id}`, {
                    method: 'PUT',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert('Cập nhật thành công!');
                        console.log(data_id);
                        // window.location.href = '/attribute';
                    } else {
                        alert('Cập nhật thất bại, vui lòng thử lại.');
                    }
                })
                .catch(error => console.error('Lỗi khi cập nhật:', error));
        });
    }

    // @thực thi edit
    function loadButtonEdit() {
        fetch('api/attribute/update').then(respone => respone.text()).then(data => {

            document.getElementById('js-update-confirm').innerHTML = data;
        }).catch(error => console.log("Đã xảy ra lỗi", error));
    }


    // @hiển thị dữ liệu khi tìm kiếm
    function showDataSearch(attribute) {
        const attributeList = document.getElementById('attribute-list');
        attributeList.innerHTML = '';
        // lặp kết quả
        attribute.forEach(attribute => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                        <td>${attribute.name}</td>
                        <td>${attribute.describe}</td>
                        <td>${attribute.checkactive ? 'Show' : 'Hide'}</td>
                        <td>${attribute.created_at}</td>
                        <td>
                            <a href="" class="btn btn-xs btn-primary js-update-confirm" data-id="${attribute.id_attribute}">Edit</a>
                            <a href="" class="btn btn-xs btn-danger js-delete-confirm" data-id="${attribute.id_attribute}">Delete</a>
                        </td>`;
            attributeList.appendChild(tr);
        });

    }

    // @ xử lý sự kiện nhấn tìm kiếm
    document.getElementById('btn-search').addEventListener('click',function(){
            const query = document.getElementById('search-key').value;
            //gọi api tìm kiếm
            fetch(`api/attribute/search?query=${query}`).then(response => response.json()).then(data => {
                if(data.data.length > 0)
                {
                    showDataSearch(data.data);
                }
                else{
                    document.getElementById('attribute-list').innerHTML = '<tr><td colspan="5">Không tìm thấy kết quả</td></tr>';
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
            });
    })


    // document.getElementById('btn-search').addEventListener('click',function(){
    //     const query = document.getElementById('search-key').value;

    //     fetch(`api/attribute/search?query=${query}`).then(response => response.json())
    //     .then(data => {
    //         if(data.data.length > 0)
    //         {
    //             showDataSearch(data.data);
    //         }
    //         else{
    //             document.getElementById('attribute-list').innerHTML = '<tr><td colspan="5">Không tìm thấy kết quả</td></tr>';
    //         }
    //     }).catch(error => {
    //         console.error('Đã có lỗi xảy ra',error)
    //     });

    // })


    // Gọi hàm để load dữ liệu lần đầu
    fetchAttributes();

});
