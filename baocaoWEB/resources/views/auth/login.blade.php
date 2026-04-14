<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng Nhập - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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

    </script>
</body>
</html>