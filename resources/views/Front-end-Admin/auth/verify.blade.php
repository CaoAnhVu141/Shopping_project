<!DOCTYPE html>
<html>
<head>
    <title>Xác thực Email</title>
</head>
<body>
    <p>Nhấp vào liên kết dưới đây để xác thực email của bạn:</p>
    <a href="{{ url('/verify-email/' . $token) }}">Xác thực email</a>
</body>
</html>
