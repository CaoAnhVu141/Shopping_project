<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận thanh toán</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Xác nhận thanh toán với VNPAY</h3>
            </div>
            <div class="card-body text-center">
                <p>Phương thức thanh toán: Ví điện tử VN PAY</p>
                <p>Tổng số tiền: 200,000 VND</p>

                <!-- Nút xác nhận thanh toán -->
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Xác nhận thanh toán bằng VNPAY</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
