<div class="card-body text-center">
    <p>Phương thức thanh toán: Ví điện tử VNPAY</p>
    <p>Tổng số tiền: 200,000 VND</p>
    <button id="vnpay-button" class="btn btn-primary">Thanh toán qua VNPAY</button>
</div>

<script>
    document.getElementById('vnpay-button').addEventListener('click', function () {
        fetch('/api/payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Chuyển hướng đến URL thanh toán
                window.location.href = data.payment_url;
            } else {
                alert('Không thể tạo giao dịch thanh toán!');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
