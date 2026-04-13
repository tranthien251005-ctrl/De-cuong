<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng Nhập - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .login-container {
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(8px);
            border-radius: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.03), 0 2px 6px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            transition: transform 0.3s ease;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .login-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.05);
        }
        .login-header {
            background: linear-gradient(135deg, #78d0ff 0%, #d0f0fd 100%);
            padding: 2rem;
            text-align: center;
        }
        .login-header h1 {
            color: #0f766e;
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }
        .login-header p {
            color: #5b9b8e;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }
        .login-body {
            padding: 2rem;
            background: white;
        }
        .input-group {
            margin-bottom: 1.5rem;
        }
        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #6b7280;
            font-size: 1.0rem;
        }
        .input-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-size: 1rem;
            background: #fefefe;
        }
        .input-group input:focus {
            outline: none;
            border-color: #99f6e4;
            box-shadow: 0 0 0 3px rgba(153, 246, 228, 0.15);
            background: white;
        }
        .input-group input.error {
            border-color: #fdba74;
        }
        .error-message {
            background: #fff7ed;
            color: #c2410c;
            padding: 0.75rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            border-left: 3px solid #fdba74;
            animation: shake 0.3s ease-in-out;
        }
        .success-message {
            background: #f0fdf4;
            color: #15803d;
            padding: 0.75rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            border-left: 3px solid #86efac;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #1ec9b0 0%, #91fde7 100%);
            color: #014a4a;
            padding: 0.875rem;
            border: none;
            border-radius: 0.75rem;
            font-size: 1.0rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(94, 234, 212, 0.25);
            background: linear-gradient(135deg, #2dd4bf 0%, #5eead4 100%);
            color: #0f3a35;
        }
        .btn-login:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #9ca3af;
        }
        .register-link a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
            text-decoration: underline;
            color: #0d9488;
        }
        .forgot-password {
            text-align: right;
            margin-top: 0.5rem;
        }
        .forgot-password a {
            color: #a1a1aa;
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.2s;
        }
        .forgot-password a:hover {
            color: #14b8a6;
        }
        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #115e59;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.6s linear infinite;
            margin-right: 0.5rem;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Ghi đè style của header để phù hợp với trang login */
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #f9fef9 50%, #f1f5f9 100%);
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        /* Đảm bảo header và footer không bị ảnh hưởng */
        .main-header {
            position: relative;
            background: white;
        }
        
        .main-footer {
            margin-top: 0;
        }
    </style>
</head>
<body>
    {{-- Include header --}}
    @include('pages.header')
    
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>🚌 Chào mừng bạn</h1>
                <p>Đăng nhập để đặt vé xe online</p>
            </div>
            
            <div class="login-body">
                @if ($errors->any())
                    <div class="error-message">
                        <strong>⚠️ Lỗi!</strong> {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="success-message">
                        <strong>✓ Thành công!</strong> {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                    @csrf
                    
                    <div class="input-group">
                        <label for="phone">Số điện thoại</label>
                        <input 
                            type="text" 
                            id="phone"
                            name="phone"
                            placeholder="Nhập số điện thoại" 
                            value="{{ old('phone') }}"
                            autocomplete="username"
                            required
                        >
                    </div>

                    <div class="input-group">
                        <label for="password">Mật khẩu</label>
                        <input 
                            type="password" 
                            id="password"
                            name="password"
                            placeholder="Nhập mật khẩu" 
                            autocomplete="current-password"
                            required
                        >
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                        </div>
                    </div>

                    <button type="submit" class="btn-login" id="submitBtn">
                        Đăng Nhập
                    </button>

                    <div class="register-link">
                        Chưa có tài khoản? 
                        {{-- <a href="{{ route('register') }}">Đăng ký ngay</a> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Include footer --}}
    @include('pages.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const phoneInput = document.getElementById('phone');
            const passwordInput = document.getElementById('password');
            
            // Xóa class error khi người dùng nhập
            phoneInput.addEventListener('input', function() {
                this.classList.remove('error');
                const errorDiv = document.querySelector('.error-message');
                if (errorDiv && errorDiv.style.display !== 'none') {
                    errorDiv.style.display = 'none';
                }
            });
            
            passwordInput.addEventListener('input', function() {
                this.classList.remove('error');
                const errorDiv = document.querySelector('.error-message');
                if (errorDiv && errorDiv.style.display !== 'none') {
                    errorDiv.style.display = 'none';
                }
            });
            
            // Xử lý submit form
            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    const phone = phoneInput.value.trim();
                    const password = passwordInput.value.trim();
                    
                    if (!phone) {
                        e.preventDefault();
                        showError('Vui lòng nhập số điện thoại');
                        phoneInput.classList.add('error');
                        return false;
                    }
                    
                    if (!password) {
                        e.preventDefault();
                        showError('Vui lòng nhập mật khẩu');
                        passwordInput.classList.add('error');
                        return false;
                    }
                    
                    // Hiển thị trạng thái loading
                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="loading-spinner"></span> Đang xử lý...';
                    submitBtn.dataset.originalText = originalText;
                    
                    return true;
                });
            }
            
            // Hàm hiển thị lỗi
            function showError(message) {
                const existingError = document.querySelector('.error-message');
                if (existingError) existingError.remove();
                
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.innerHTML = '<strong>⚠️ Lỗi!</strong> ' + message;
                
                const loginBody = document.querySelector('.login-body');
                loginBody.insertBefore(errorDiv, loginBody.firstChild);
                errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>