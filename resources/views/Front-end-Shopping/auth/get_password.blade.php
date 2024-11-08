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
  <form method="POST" action="{{ route('auth.submitPassword', ['customer' => $customer->id_customer, 'token' => $customer->token]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update password</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>