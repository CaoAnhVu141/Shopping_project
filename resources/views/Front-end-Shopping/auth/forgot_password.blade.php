<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
   <link rel="stylesheet" href="{{ asset('css/forgot_password.css') }}">
</head>
<body>
    @if(session('success'))
       <div class="alert alert-success">
           {{ session('success') }}
       </div>
   @endif

   @if(session('error'))
       <div class="alert alert-danger">
           {{ session('error') }}
       </div>
   @endif
   
    <div class="container">

        <div class="form-email">
            <img alt="Logo" height="40" src="{{asset('images/users/logo.jpg')}}" width="40"/>
            <h1>
            Bạn đang quên mật khẩu?
            </h1>
            <p>
            Đừng lo, chúng tôi sẽ giúp bạn.
            </p>
            <form method="POST" class="form-send-email" action="{{route('auth.sumitReset')}}">
                @csrf
                <div class="form-group">
                    <label for="email">Nhập lại email của bạn</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    @error('email') 
                        <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                    <button type="submit" class="btn btn-primary btn-block">Gửi email</button>
            </form>
            <a href="#">
                <i class="fas fa-arrow-left"></i>
                    Quay lại đăng nhập
            </a>
        </div>
    </div>
   <script> 
    setTimeout(function() {
        const successAlert = document.querySelector('.alert-success');
        const errorAlert = document.querySelector('.alert-error');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 3000); 
</script>
</body>
</html>