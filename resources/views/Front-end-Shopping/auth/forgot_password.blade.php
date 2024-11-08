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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Forgot Password</h2>
                <form method="POST" action="{{route('auth.sumitReset')}}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Enter your email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        @error('email') 
                            <small class="help-block">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                </form>
                <p class="text-center mt-3">
                    <a href="login.html">Back to Login</a>
                </p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>