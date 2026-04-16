<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng Ký - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

</head>
<body>
    {{-- Include header --}}
    @include('pages.header')
    
    <div class="main-wrapper">
        <div class="register-container">
            <div class="register-card">
                <div class="register-header">
                    <h1>🚌 Tạo Tài Khoản</h1>
                    <p>Hành trình MY BUS bắt đầu từ đây</p>
                </div>
                
                <div class="register-body">
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

                    <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                        @csrf
                        
                        <div class="input-group">
                            <label for="fullName">Họ và tên</label>
                            <input 
                                type="text" 
                                id="fullName"
                                name="fullName"
                                placeholder="Nhập họ và tên của bạn" 
                                value="{{ old('fullName') }}"
                                required
                            >
                        </div>

                        <div class="input-group">
                            <label for="phone">Số điện thoại</label>
                            <input 
                                type="tel" 
                                id="phone"
                                name="phone"
                                placeholder="Nhập số điện thoại" 
                                value="{{ old('phone') }}"
                                autocomplete="username"
                                required
                            >
                        </div>

                        <div class="input-group">
                            <label for="email">Email</label>
                            <input 
                                type="email" 
                                id="email"
                                name="email"
                                placeholder="Nhập email (không bắt buộc)" 
                                value="{{ old('email') }}"
                            >
                        </div>

                        <div class="input-group">
                            <label for="password">Mật khẩu</label>
                            <input 
                                type="password" 
                                id="password"
                                name="password"
                                placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)" 
                                required
                            >
                        </div>

                        <div class="input-group">
                            <label for="password_confirmation">Xác nhận mật khẩu</label>
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Nhập lại mật khẩu" 
                                required
                            >
                        </div>

                        <div class="checkbox-group">
                            <input 
                                type="checkbox" 
                                id="showPassword"
                                class="show-password-checkbox"
                            >
                            <label for="showPassword">Hiển thị mật khẩu</label>
                        </div>

                        <button type="submit" class="btn-register" id="submitBtn">
                            Đăng ký
                        </button>

                        <div class="login-link">
                            Đã là thành viên? 
                            <a href="{{ route('login') }}">Đăng nhập ngay</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Include footer --}}
    @include('pages.footer')

</body>
</html>