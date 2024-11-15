$(document).ready(function() {
    // Lấy tỉnh thành
    $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm')
        .done(function(data_tinh) {
            if (data_tinh.error == 0) {
                $.each(data_tinh.data, function(key_tinh, val_tinh) {
                    $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
                });
            } else {
                alert("Không thể tải dữ liệu tỉnh thành.");
            }
        })
        .fail(function() {
            alert("Lỗi kết nối đến API tỉnh thành.");
        });

    // Khi thay đổi Tỉnh/Thành phố
    $("#tinh").change(function() {
        var idtinh = $(this).val();
        if (idtinh != "0") {
            $("#quan").prop("disabled", false);
            // Lấy quận huyện
            $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm')
                .done(function(data_quan) {
                    if (data_quan.error == 0) {
                        $("#quan").html('<option value="0">Chọn Quận Huyện</option>');
                        $("#phuong").html('<option value="0">Chọn Phường Xã</option>');
                        $.each(data_quan.data, function(key_quan, val_quan) {
                            $("#quan").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
                        });
                    } else {
                        alert("Không thể tải dữ liệu quận/huyện.");
                    }
                })
                .fail(function() {
                    alert("Lỗi kết nối đến API quận/huyện.");
                });
        } else {
            $("#quan, #phuong").html('<option value="0">Quận/Huyện hoặc Xã/Phường</option>').prop("disabled", true);
        }
    });

    // Khi thay đổi Quận/Huyện
    $("#quan").change(function() {
        var idquan = $(this).val();
        if (idquan != "0") {
            $("#phuong").prop("disabled", false);
            // Lấy phường xã
            $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm')
                .done(function(data_phuong) {
                    if (data_phuong.error == 0) {
                        $("#phuong").html('<option value="0">Chọn Phường Xã</option>');
                        $.each(data_phuong.data, function(key_phuong, val_phuong) {
                            $("#phuong").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                        });
                    } else {
                        alert("Không thể tải dữ liệu phường/xã.");
                    }
                })
                .fail(function() {
                    alert("Lỗi kết nối đến API phường/xã.");
                });
        } else {
            $("#phuong").html('<option value="0">Chọn Phường Xã</option>').prop("disabled", true);
        }
    });
});
<script src="https://esgoo.net/scripts/jquery.js"></script>