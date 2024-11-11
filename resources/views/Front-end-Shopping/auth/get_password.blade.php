<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('css/get_password.css') }}">
</head>
<body>
    @if ($errors->any())
         <div class="alert alert-error">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif

    <div class="container">

        <h2>
            Tạo mật khẩu mới
        </h2>
        <p>
            Nhập mật khẩu mới của bạn.
        </p>
        <form method="POST" action="{{ route('auth.submitPassword', ['customer' => $customer->id_customer, 'token' => $token]) }}">
            @csrf
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
            <button type="submit">Cập nhật mật khẩu</button>
        </form>
    </div> 

<script> 
    setTimeout(function() {
        const errorAlert = document.querySelector('.alert-error');
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 3000); 
</script>
</body>
</html>