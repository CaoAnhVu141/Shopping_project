document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form"); // Chỉ định form cần validate

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Ngăn gửi form nếu có lỗi

        const name = document.querySelector('input[name="customer_name"]').value.trim();
        const phone = document.querySelector('input[name="customer_phone"]').value.trim();
        const email = document.querySelector('input[name="customer_email"]').value.trim();

        let errors = [];

        // Validate tên (không chứa ký tự đặc biệt)
        if (!/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơ\s]*$/.test(name)) {
            errors.push("Họ và tên không được chứa ký tự đặc biệt.");
        }

        // Validate số điện thoại (phải là số VN, bắt đầu bằng 03, 05, 07, 08, 09, dài 10 số)
        if (!/^(03|05|07|08|09)\d{8}$/.test(phone)) {
            errors.push("Số điện thoại không hợp lệ.");
        }

        // Validate email (đúng định dạng)
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errors.push("Email không hợp lệ.");
        }

        // Hiển thị lỗi
        if (errors.length > 0) {
            alert(errors.join("\n")); // Hoặc bạn có thể hiển thị lỗi trên giao diện
            return false;
        }

        // Nếu không có lỗi, submit form
        form.submit();
    });
});
