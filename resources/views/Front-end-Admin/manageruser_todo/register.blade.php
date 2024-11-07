<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Người Dùng | Quản Lý Bán Hàng</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        .avatar-container {
            position: relative;
            width: 150px;
        }

        .avatar-preview {
            width: 150px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 2px;
            margin-bottom: 10px;
        }

        input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Đăng Ký Người Dùng</h2>
    <form action="{{ route('registerUser') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Tên Người Dùng:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Số Điện Thoại:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh:</label>
            <div class="avatar-container">
                <img src="#" alt="Ảnh người dùng" class="avatar-preview" id="currentAvatar" style="width: 150px; height: 150px;">
                <input type="file" class="form-control-file" id="newAvatar" name="avatar" accept="image/*" onchange="previewNewAvatar()">
            </div>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <select class="form-control" id="address" name="address" required>
                <option value="">Chọn Thành Phố</option>
                <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                <option value="Trà Vinh">Trà Vinh</option>
                <option value="Bình Thuận">Bình Thuận</option>
                <option value="Vĩnh Long">Vĩnh Long</option>
                <option value="Long An">Long An</option>
                <option value="Cần Thơ">Cần Thơ</option>
                <option value="Ninh Bình">Ninh Bình</option>
                <option value="Ninh Thuận">Ninh Thuận</option>
                <option value="Vũng Tàu">Vũng Tàu</option>
                <option value="Sóc Trăng">Sóc Trăng</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Ký</button>
    </form>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function previewNewAvatar() {
        var newAvatarInput = document.getElementById('newAvatar');
        var avatarPreview = document.getElementById('currentAvatar');

        if (newAvatarInput.files && newAvatarInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                avatarPreview.src = e.target.result;
            }

            reader.readAsDataURL(newAvatarInput.files[0]);
        }
    }
</script>
</body>
</html>
