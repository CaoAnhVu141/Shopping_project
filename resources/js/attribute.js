document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/attribute')  // Gọi đúng API
        .then(response => response.json())  // Chuyển đổi phản hồi thành JSON
        .then(attributes => {
            const attributeList = document.getElementById('attribute-list');
            attributeList.innerHTML = '';  // Xóa nội dung cũ nếu có

            // Lặp qua danh sách attributes và thêm vào giao diện
            attributes.forEach((attribute, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${attribute.id_attribute}</td>
                    <td><img src="${attribute.image}" width="150px" height="100px" /></td>
                    <td>${attribute.name}</td>
                    // <td>${attribute.describe}</td>
                    // <td>${attribute.checkactive ? 'Show' : 'Hide'}</td>
                    // <td>${attribute.created_at}</td>
                    // <td>${attribute.updated_at}</td>
                    // <td>${attribute.added_by}</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-primary" onclick="return confirm('Bạn chắc chắn là sửa chứ')"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="#" class="btn btn-xs btn-danger js-delete-confirm" onclick="return confirm('Bạn chắc chắn là xoá chứ')"><i class="fa fa-trash"></i> Delete</a>
                    </td>`;
                attributeList.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('Lỗi khi lấy dữ liệu:', error);
        });
});
