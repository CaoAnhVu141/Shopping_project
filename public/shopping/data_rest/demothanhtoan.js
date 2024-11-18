document.getElementById('vnpay-button').addEventListener('click', async function () {
    // Số tiền thanh toán (200,000 VND)
    const amount = 200000; // Đơn vị là VND

    try {
        // Gửi yêu cầu POST đến API
        const response = await fetch(`/api/payment`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ amount: amount }),
        });

        const data = await response.json();
        console.log(data);
        if (data.success) {
            // Chuyển hướng người dùng đến URL thanh toán VNPay
            window.location.href = data.payment_url;
        } else {
            alert('Không thể tạo thanh toán. Vui lòng thử lại.');
        }
    } catch (error) {
        console.error('Lỗi khi gửi yêu cầu thanh toán:', error);
        alert('Đã xảy ra lỗi, vui lòng thử lại.');
    }
});
