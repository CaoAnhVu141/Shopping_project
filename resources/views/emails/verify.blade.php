<!-- resources/views/emails/verify.blade.php -->
<h1>Xác thực tài khoản của bạn</h1>
<p>Xin chào, {{ $customer->name }}!</p>
<p>Nhấp vào liên kết bên dưới để xác thực tài khoản của bạn:</p>
<a href="{{ $verificationUrl }}">Xác thực tài khoản</a>
