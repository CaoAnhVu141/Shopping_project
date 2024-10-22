document.addEventListener('DOMContentLoaded', function() {
    // Hàm để lấy dữ liệu phân trang từ API
    function fetchAttributes(page = 1) {
        fetch(`/api/attribute?page=${page}`)  // Thay đổi page động
            .then(response => response.json())  // Chuyển đổi phản hồi thành JSON
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
                            <a href="#" class="btn btn-xs btn-primary">Edit</a>
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
    // Hàm để tạo các link phân trang
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

    // Xử lý sự kiện click vào các link phân trang
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('pagination-link')) {
            event.preventDefault();
            const page = event.target.getAttribute('data-page');
            fetchAttributes(page); // Gọi lại API với trang mới
        }
    });


    // @thực hiện xoá phần tử

    document.addEventListener('click',function(event){
        if(event.target.classList.contains('js-delete-confirm'))
        {
            event.preventDefault();
            const data_id = event.target.getAttribute("data-id");

            if(confirm("Bạn có muốn xoá giá trị này không")){
                fetch(`api/attribute/${data_id}`,{
                    method: 'DELETE',
                    headers:{
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
                .catch(error => console.error("Lỗi",error));
            }
        }
    });

    document.getElementById('create-attribute').addEventListener('click',function(){
        fetch('/create-attribute').then(response => respone.text()).then(data => {
                document.getElementById('content-area').innerHTML = data;
        }).catch(error => console.log("Lỗi",error));
    });

    // Gọi hàm để load dữ liệu lần đầu
    fetchAttributes();


});




