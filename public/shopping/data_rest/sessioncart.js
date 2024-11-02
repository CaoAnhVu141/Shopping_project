document.addEventListener('DOMContentLoaded', function() {
    const sessionId = localStorage.getItem('id_session'); // Lấy session ID từ Local Storage

    fetch('/get/cart', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Session-ID': sessionId // Gửi session ID qua header
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Hiển thị dữ liệu giỏ hàng trên console
        // Thực hiện các xử lý khác để hiển thị giỏ hàng trên trang nếu cần
    })
    .catch(error => console.error('Error:', error));
});
