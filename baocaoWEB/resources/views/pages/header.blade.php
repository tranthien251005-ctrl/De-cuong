<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f4f4;
        color: #333;
        padding-top: 70px;
    }

    .main-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: #fff;
        z-index: 1000;
        width: 100%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .container-header {
        width: 90%;
        max-width: 1300px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px 0;
    }

    /* Phần bên trái: logo + navbar */
    .left-section {
        display: flex;
        align-items: center;
        gap: 30px; /* Khoảng cách giữa logo và navbar */
    }

    .logo {
        flex-shrink: 0;
    }

    .logo h1 {
        font-size: 20px;
        margin-bottom: 2px;
    }

    .logo p {
        font-size: 12px;
        opacity: 0.8;
    }

    .navbar ul {
        display: flex;
        list-style: none;
        gap: 20px;
    }

    .navbar ul li a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        transition: 0.2s;
    }

    .navbar ul li a:hover {
        color: #0f766e;
    }

    /* Phần bên phải: user actions */
    .user-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-menu {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-name {
        color: #333;
        font-weight: 500;
        font-size: 14px;
    }

    .user-name i {
        color: #0f766e;
        margin-right: 5px;
    }

    .user-actions a,
    .logout-btn {
        color: #333;
        text-decoration: none;
        padding: 6px 14px;
        border-radius: 6px;
        transition: 0.3s;
        font-weight: 500;
        font-size: 14px;
        border: none;
        cursor: pointer;
        background: transparent;
    }

    .user-actions .register {
        color: #fff;
        background-color: #00a949;
    }

    .user-actions .register:hover {
        background-color: #058d3e;
    }

    .user-actions .login:hover,
    .logout-btn:hover {
        background-color: #f0f0f0;
    }
</style>

<header class="main-header">
    <div class="container-header">
        {{-- PHẦN BÊN TRÁI: LOGO + NAVBAR --}}
        <div class="left-section">
            <div class="logo">
                <h1>🚌 CHÚ THIỆN</h1>
                <p>An toàn - Nhanh chóng - Tiện lợi</p>
            </div>
            <nav class="navbar">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('bill') }}">Hóa đơn</a></li>
                </ul>
            </nav>
        </div>

        {{-- PHẦN BÊN PHẢI: USER ACTIONS --}}
        <div class="user-actions">
            @if(session('isLoggedIn'))
                <div class="user-menu">
                    <span class="user-name">
                        <i class="fas fa-user-circle"></i>
                        {{ session('userFullName', session('userName', session('userPhone', 'User'))) }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Đăng xuất</button>
                    </form>
                </div>
            @else
                <a class="login" href="{{ route('login') }}">Đăng nhập</a>
                <a class="register" href="{{ route('register') }}">Đăng ký</a>
            @endif
        </div>
    </div>
</header>
