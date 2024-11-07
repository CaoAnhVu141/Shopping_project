@extends('LayOut.shopping.master_shopping')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="{{ asset("shopping/css/profile_customer.css") }}">
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="account-container">
                <h5 class="mb-4">Tài khoản của bạn</h5>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="pill" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="true">
                            <i class="fas fa-user"></i> Thông tin cá nhân
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-toggle="pill" href="#orders" role="tab"
                            aria-controls="orders" aria-selected="false">
                            <i class="fas fa-box"></i> Đơn hàng của bạn
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                            aria-controls="password" aria-selected="false">
                            <i class="fas fa-lock"></i> Đổi mật khẩu
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <button class="btn btn-logout btn-block">Đăng xuất</button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
                <!-- Thông tin cá nhân -->
                <div class="tab-pane fade show active account-container" id="profile" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <h6>Thông tin cá nhân</h6>
                    <form>
                        <div class="form-group profile-info">
                            <label for="name">Họ và tên</label>
                            <input type="text" class="form-control" id="name" placeholder="Nhập tên">
                        </div>
                        <div class="form-group profile-info">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập email">
                        </div>
                        <div class="form-group profile-info">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="form-group profile-info">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </form>
                </div>

                <!-- Đơn hàng của bạn -->
                <div class="tab-pane fade account-container" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <h6>Đơn hàng của bạn</h6>
                    <div class="order-item">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/60" alt="Product Image">
                            <div class="ml-3">
                                <strong>Chuột có dây Logitech</strong>
                                <p>Mã đơn: 12345678</p>
                            </div>
                        </div>
                        <span class="text-muted">120.000 đ</span>
                    </div>

                    <div class="order-item">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/60" alt="Product Image">
                            <div class="ml-3">
                                <strong>Bàn phím cơ Razer</strong>
                                <p>Mã đơn: 87654321</p>
                            </div>
                        </div>
                        <span class="text-muted">1.500.000 đ</span>
                    </div>
                </div>

                <!-- Đổi mật khẩu -->
                <div class="tab-pane fade account-container" id="password" role="tabpanel"
                    aria-labelledby="password-tab">
                    <h6>Đổi mật khẩu</h6>
                    <form>
                        <div class="form-group">
                            <label for="currentPassword">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="currentPassword"
                                placeholder="Nhập mật khẩu hiện tại">
                        </div>
                        <div class="form-group">
                            <label for="newPassword">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="newPassword"
                                placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Xác nhận mật khẩu mới">
                        </div>
                        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection