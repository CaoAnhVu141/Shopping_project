<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Bin-It">
    <meta property="og:url"/>
    <meta property="og:type" content="truongbinit"/>
    <meta property="og:title" content="Website TruongBin"/>
    <meta property="og:description" content="Wellcome to my Website"/>

    <title>Người Dùng | Quản Lý Bán Hàng</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="admin/manager/css/style.css">
    <!-- Latest compiled and minified CSS -->
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <!--===============================================================================================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!--===============================================================================================-->
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <!--===============================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        function sortUsers() {
            // Sử dụng AJAX để gửi yêu cầu POST đến route xử lý sắp xếp
            $.ajax({
                url: 'manager-users/sort', // Đường dẫn đến route xử lý sắp xếp
                type: 'GET',
                data: {
                    // Dữ liệu có thể gửi cùng với yêu cầu, ví dụ: csrf token
                    '_token': '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Xử lý dữ liệu trả về nếu cần
                    console.log(response);
                },
                error: function (xhr) {
                    // Xử lý lỗi nếu có
                    console.log(xhr.responseText);
                }
            });
        }

        //Phân Trang Cho Table
        function Pager(tableName, itemsPerPage) {
            this.tableName = tableName;
            this.itemsPerPage = itemsPerPage;
            this.currentPage = 1;
            this.pages = 0;
            this.inited = false;

            this.showRecords = function (from, to) {
                var rows = document.getElementById(tableName).rows;
                for (var i = 1; i < rows.length; i++) {
                    if (i < from || i > to)
                        rows[i].style.display = 'none';
                    else
                        rows[i].style.display = '';
                }
            }

            this.showPage = function (pageNumber) {
                if (!this.inited) {
                    alert("not inited");
                    return;
                }
                var oldPageAnchor = document.getElementById('pg' + this.currentPage);
                oldPageAnchor.className = 'pg-normal';

                this.currentPage = pageNumber;
                var newPageAnchor = document.getElementById('pg' + this.currentPage);
                newPageAnchor.className = 'pg-selected';

                var from = (pageNumber - 1) * itemsPerPage + 1;
                var to = from + itemsPerPage - 1;
                this.showRecords(from, to);
            }

            this.prev = function () {
                if (this.currentPage > 1)
                    this.showPage(this.currentPage - 1);
            }

            this.next = function () {
                if (this.currentPage < this.pages) {
                    this.showPage(this.currentPage + 1);
                }
            }

            this.init = function () {
                var rows = document.getElementById(tableName).rows;
                var records = (rows.length - 1);
                this.pages = Math.ceil(records / itemsPerPage);
                this.inited = true;
            }
            this.showPageNav = function (pagerName, positionId) {
                if (!this.inited) {
                    alert("not inited");
                    return;
                }
                var element = document.getElementById(positionId);

                var pagerHtml = '<span onclick="' + pagerName +
                    '.prev();" class="pg-normal">&#171</span> | ';
                for (var page = 1; page <= this.pages; page++)
                    pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName +
                        '.showPage(' + page + ');">' + page + '</span> | ';
                pagerHtml += '<span onclick="' + pagerName + '.next();" class="pg-normal">&#187;</span>';

                element.innerHTML = pagerHtml;
            }
        }

        function confirmDelete(userId) {
            if (confirm('Bạn có chắc chắn muốn xóa người dùng này không?')) {
                // Nếu người dùng chấp nhận, chuyển hướng đến tuyến đường xóa
                window.location.href = '/users/' + userId;
            }
        }
    </script>
</head>

<body onload="time()">
<script>
    // swal("Xin Chào Admin", "Chúc Bạn 1 Ngày Tốt Lành Nhé", "");
</script>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> QUẢN
                LÝ Người Dùng</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="{{ route('manageruser') }}" data-toggle="tooltip" data-placement="bottom"
                                      title="Người Dùng">Người Dùng</a></li>
                <li><a href="{{ route('showalluser') }}" data-toggle="tooltip" data-placement="bottom"
                       title="ĐIỂM DANH">ĐIỂM DANH</a></li>
                <li><a href="" data-toggle="tooltip" data-placement="bottom" title="TIỀN LƯƠNG">TIỀN LƯƠNG</a></li>
                <li><a href="" data-toggle="tooltip" data-placement="bottom" title="LỊCH CÔNG TÁC">LỊCH CÔNG TÁC</a>
                </li>
                <li><a href="#contact" data-toggle="tooltip" data-placement="bottom" title="BÁO CÁO">BÁO CÁO</a>
                </li>
                <li><a href="#tour" data-toggle="tooltip" data-placement="bottom" title="SỰ KIỆN">SỰ KIỆN</a></li>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="TÀI KHOẢN"><b>Tài Khoản</b>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown">
                        <li><a href="{{ route('admin.logout') }}" data-toggle="tooltip" data-placement="bottom"
                               title="ĐĂNG XUẤT"><b>Đăng xuất <i class="fas fa-sign-out-alt"></i></b></a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid al">
    <div id="clock"></div>
    <Br>
    <form action="">
    </form>
    <b>CHỨC NĂNG CHÍNH:</b><Br>
    <div class="container mt-5">
        <form id="searchForm" action="{{ route('searchUser') }}" method="GET">
            <input type="text" id="searchInput" name="searchTerm" class="form-control" placeholder="Nhập từ khóa tìm kiếm...">
            <button type="submit" class="btn btn-primary mt-2">Tìm kiếm</button>
        </form>
    </div>
{{--    <a href="{{ route('managerusers.orderBy') }}" class="nv" data-toggle="tooltip" data-placement="top"--}}
{{--       title="Lọc Dữ Liệu">--}}
{{--        <i class="fa fa-filter" aria-hidden="true"></i>--}}
{{--    </a>--}}
    <button class="nv xuat" data-toggle="tooltip" data-placement="top" title="Xuất File"><i
            class="fas fa-file-import"></i></button>
    <button class="nv cog" data-toggle="tooltip" data-placement="bottom" title=""><i
            class="fas fa-cogs"></i></button>
    <div class="table-title">
        <div class="row">

        </div>

    </div>
    <div class="container mt-5">
        <h2>Kết Quả Tìm Kiếm cho "{{ $searchTerm }}"</h2>
        <table class="table table-bordered mt-3">
            <thead>
            <tr class="ex">
                <th width="50px">ID</th>
                <th width="100px">Tên Người Dùng</th>
                <th width="250px">Email</th>
                <th>PassWord</th>
                <th>Số Điện Thoại</th>
                <th>Ảnh</th>
                <th>Địa chỉ</th>
                <th>Ngày Tạo</th>
                <th>Cập Nhật</th>
                <th width="5px">Tính Năng</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>Che</td>
                    <td>{{ $user->phone }}</td>
                    <td><img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" style="width: 50px; height: 50px;"></td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <a href="#" class="add" title="Lưu Lại" data-toggle="tooltip">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('editUser', ['id' => $user->user_id]) }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <form action="{{ route('deleteUser', ['id' => $user->user_id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Xóa" data-toggle="tooltip">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Phân trang bắt đầu -->
    <div id="pageNavPosition" class="text-right">
        <ul class="pagination">
            @if ($users->onFirstPage())
                <li class="disabled"><span>&laquo;</span></li>
            @else
                <li><a href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <li class="{{ $i == $users->currentPage() ? 'active' : '' }}">
                    <a href="{{ $users->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($users->hasMorePages())
                <li><a href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><span>&raquo;</span></li>
            @endif
        </ul>
    </div>
    <!-- Phân trang kết thúc -->

    <hr class="hr1">
    <div class="container-fluid end">
        <div class="row text-center">
            <div class="col-lg-12 link">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-youtube"></i>
                <i class="fab fa-google"></i>
            </div>
            <div class="col-lg-12">
                2024 Quan Ly Nguoi Dung | Design by <a href="#">GroupF</a>
            </div>
        </div>
    </div>
    <script src="admin/manager/jquery.min.js"></script>
    <script type="text/javascript">



        //Thời Gian
        function time() {
            var today = new Date();
            var weekday = new Array(7);
            weekday[0] = "Chủ Nhật";
            weekday[1] = "Thứ Hai";
            weekday[2] = "Thứ Ba";
            weekday[3] = "Thứ Tư";
            weekday[4] = "Thứ Năm";
            weekday[5] = "Thứ Sáu";
            weekday[6] = "Thứ Bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            nowTime = h + ":" + m + ":" + s;
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = day + ', ' + dd + '/' + mm + '/' + yyyy;
            tmp = '<i class="fa fa-clock-o" aria-hidden="true"></i> <span class="date">' + today + ' | ' + nowTime +
                '</span>';
            document.getElementById("clock").innerHTML = tmp;
            clocktime = setTimeout("time()", "1000", "Javascript");

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
        }

        //Thêm
        // $(document).ready(function () {
        //     $('[data-toggle="tooltip"]').tooltip();
        //     var actions = $("table td:last-child").html();
        //     $(".add-new").click(function () {
        //         $(this).attr("disabled", "disabled");
        //         var index = $("table tbody tr:last-child").index();
        //         var row = '<tr>' +
        //             '<td><input type="text" class="form-control" name="name" id="name" placeholder="Nhập Tên"></td>' +
        //             '<td><input type="text" class="form-control" name="gioitinh" id="gioitinh" placeholder="Nhập Giới Tính"></td>' +
        //             '<td><input type="text" class="form-control" name="namsinh" id="namsinh" value="" placeholder="Nhập Ngày Sinh"></td>' +
        //             '<td><input type="text" class="form-control" name="diachi" id="diachi" value="" placeholder="Nhập Địa Chỉ"></td>' +
        //             '<td><input type="text" class="form-control" name="chucvu" id="chucvu" value="" placeholder="Nhập Chức Vụ"></td>' +
        //             '<td>' + actions + '</td>' +
        //             '</tr>';
        //         $("table").append(row);
        //         $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        //         $('[data-toggle="tooltip"]').tooltip();
        //     });
        //
        //Kiểm tra rỗng
        $(document).on("click", ".add", function () {
            var empty = false;
            var input = $(this).parents("tr").find('input[type="text"]');
            input.each(function () {
                if (!$(this).val()) {
                    $(this).addClass("error");
                    swal("Thông Báo!", "Dữ Liệu Trống Vui Lòng Kiểm Tra", "error");
                    empty = true;
                } else {
                    $(this).removeClass("error");
                    swal("Thông Báo!", "Bạn Chưa Nhập Dữ Liệu", "warning");
                }
            });
            $(this).parents("tr").find(".error").first().focus();
            if (!empty) {
                input.each(function () {
                    $(this).parent("td").html($(this).val());
                    swal("Thành Công", "Bạn Đã Cập Nhật Thành Công", "success");
                });
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").removeAttr("disabled");
            }
        });
        // Sửa
        // Thêm thông báo khi nhấn nút "Lưu Lại"
        $(document).on("click", ".add", function () {
            Swal.fire(
                'Thành Công!',
                'Bạn Đã Sửa Thành Công',
                'success'
            );
        });

        // Sửa
        $(document).on("click", ".edit", function () {
            $(this).parents("tr").find("td:not(:last-child)").each(function () {
                const text = $(this).text().trim();
                $(this).html('<input type="text" class="form-control" value="' + text + '">');
            });
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").attr("disabled", "disabled");
        });

        // Xóa
        $(document).on("click", ".delete", function () {
            $(this).parents("tr").remove();
            swal("Thành Công!", "Bạn Đã Xóa Thành Công", "success");
            $(".add-new").removeAttr("disabled");
        });
        })
        ;
        //Not use
        jQuery(function () {
            jQuery(".cog").click(function () {
                swal("Sorry!", "Tính Năng Này Chưa Có", "error");
            });
        });
        //Tool tip
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>

</html>
