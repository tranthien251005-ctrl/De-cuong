// public/js/register.js

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registerForm");
    const submitBtn = document.getElementById("submitBtn");
    const passwordInput = document.getElementById("password");
    const confirmInput = document.getElementById("password_confirmation");
    const togglePassword = document.getElementById("togglePassword");
    const toggleConfirmPassword = document.getElementById(
        "toggleConfirmPassword",
    );
    const phoneInput = document.getElementById("phone");
    const fullNameInput = document.getElementById("fullName");
    const emailInput = document.getElementById("email");

    // Hiển thị/ẩn mật khẩu cho ô mật khẩu
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener("click", function () {
            const type =
                passwordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            passwordInput.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    }

    // Hiển thị/ẩn mật khẩu cho ô xác nhận mật khẩu
    if (toggleConfirmPassword && confirmInput) {
        toggleConfirmPassword.addEventListener("click", function () {
            const type =
                confirmInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            confirmInput.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    }

    // Xóa class error khi người dùng nhập
    const clearErrorOnInput = (input) => {
        if (input) {
            input.addEventListener("input", function () {
                this.classList.remove("error");
                const errorDiv = document.querySelector(".error-message");
                if (errorDiv && errorDiv.style.display !== "none") {
                    errorDiv.style.display = "none";
                }
            });
        }
    };

    clearErrorOnInput(phoneInput);
    clearErrorOnInput(passwordInput);
    clearErrorOnInput(confirmInput);
    clearErrorOnInput(fullNameInput);
    clearErrorOnInput(emailInput);

    // Xử lý submit form
    if (form && submitBtn) {
        form.addEventListener("submit", function (e) {
            const fullName = fullNameInput ? fullNameInput.value.trim() : "";
            const phone = phoneInput ? phoneInput.value.trim() : "";
            const email = emailInput ? emailInput.value.trim() : "";
            const password = passwordInput ? passwordInput.value : "";
            const confirmPassword = confirmInput ? confirmInput.value : "";

            // Validate họ tên
            if (!full_name) {
                e.preventDefault();
                showError("Vui lòng nhập họ và tên");
                if (full_nameInput) full_nameInput.classList.add("error");
                return false;
            }

            if (full_name.length < 3) {
                e.preventDefault();
                showError("Họ và tên phải có ít nhất 3 ký tự");
                if (full_nameInput) full_nameInput.classList.add("error");
                return false;
            }

            // Validate email (nếu có)
            if (email && !isValidEmail(email)) {
                e.preventDefault();
                showError("Email không hợp lệ");
                if (emailInput) emailInput.classList.add("error");
                return false;
            }

            // Validate số điện thoại
            if (!phone) {
                e.preventDefault();
                showError("Vui lòng nhập số điện thoại");
                if (phoneInput) phoneInput.classList.add("error");
                return false;
            }

            const phoneRegex = /^(0[3|5|7|8|9])+([0-9]{8})$/;
            if (!phoneRegex.test(phone)) {
                e.preventDefault();
                showError(
                    "Số điện thoại không hợp lệ (phải bắt đầu bằng 03, 05, 07, 08, 09 và có 10 số)",
                );
                if (phoneInput) phoneInput.classList.add("error");
                return false;
            }

            // Validate mật khẩu
            if (!password) {
                e.preventDefault();
                showError("Vui lòng nhập mật khẩu");
                if (passwordInput) passwordInput.classList.add("error");
                return false;
            }

            if (password.length < 6) {
                e.preventDefault();
                showError("Mật khẩu phải có ít nhất 6 ký tự");
                if (passwordInput) passwordInput.classList.add("error");
                return false;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                showError("Mật khẩu xác nhận không khớp");
                if (confirmInput) confirmInput.classList.add("error");
                return false;
            }

            // Hiển thị trạng thái loading
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';
            submitBtn.dataset.originalText = originalText;

            return true;
        });
    }

    // Hàm hiển thị lỗi
    function showError(message) {
        const existingError = document.querySelector(".error-message");
        if (existingError) existingError.remove();

        const errorDiv = document.createElement("div");
        errorDiv.className = "error-message";
        errorDiv.innerHTML = "<strong>⚠️ Lỗi!</strong> " + message;

        const registerBody = document.querySelector(".register-body");
        if (registerBody) {
            registerBody.insertBefore(errorDiv, registerBody.firstChild);
            errorDiv.scrollIntoView({ behavior: "smooth", block: "center" });
        }
    }

    // Hàm kiểm tra email hợp lệ
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
        return emailRegex.test(email);
    }
});
