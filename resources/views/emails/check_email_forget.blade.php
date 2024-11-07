<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/forgot_password.css') }}">
</head>
<body>
    <div class="container">
        <div class="text-center">
           <h2>Xin chào {{$customer->name}}</h2>
            <p>Vui lòng click vào link dưới đây để đặt lại mật khẩu</p>
            <p><a href="{{ $resetLink }}">Đặt lại mật khẩu</a></p>
        </div>
    </div>
</body>
</html>