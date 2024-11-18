<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{asset('shopping/css/success_buy_items.css') }}">
</head>
<body>
    <div class="container">
        <div class="success-icon">✔</div>
        <div class="success-message">Đặt hàng thành công!</div>
        <div class="order-details">
            Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.<br>
            Một email xác nhận đơn hàng đã được gửi tới <strong></strong>.
        </div>
        <div class="buttons">
            <a href="/Home" class="button button-primary">Quay về trang chủ</a>
            <a href="{{ Route('history-buy') }}" class="button button-secondary">Xem đơn hàng</a>
        </div>
    </div>
</body>
</html>