<style>
    .main-header,
    .main-header * {
        box-sizing: border-box;
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
        gap: 8px;
        padding: 6px 0;
    }

    .left-section {
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .logo {
        flex-shrink: 0;
    }

    .logo h1 {
        font-size: 18px;
        line-height: 1.15;
        margin: 0 0 1px;
    }

    .logo p {
        font-size: 11px;
        line-height: 1.2;
        opacity: 0.8;
        margin: 0;
    }

    .navbar ul {
        display: flex;
        list-style: none;
        gap: 18px;
        margin: 0;
        padding: 0;
    }

    .navbar ul li a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: 0.2s;
    }

    .navbar ul li a:hover {
        color: #0f766e;
    }

    .user-actions,
    .user-menu {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-name {
        color: #333;
        font-weight: 500;
        font-size: 13px;
    }

    .user-name i {
        color: #0f766e;
        margin-right: 5px;
    }

    .user-actions a,
    .logout-btn {
        color: #333;
        text-decoration: none;
        padding: 5px 12px;
        border-radius: 6px;
        transition: 0.3s;
        font-weight: 500;
        font-size: 13px;
        border: none;
        cursor: pointer;
        background: transparent;
        font-family: inherit;
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

    @media (max-width: 768px) {
        .container-header {
            width: 94%;
            align-items: flex-start;
        }

        .left-section {
            gap: 14px;
            flex-wrap: wrap;
        }

        .navbar ul {
            gap: 12px;
        }
    }
</style>

<header class="main-header">
    <div class="container-header">
        <div class="left-section">
            <div class="logo">
                <h1>🚌 CHÚ THIỆN</h1>
                <p>An toàn - Nhanh chóng - Tiện lợi</p>
            </div>
            <nav class="navbar">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('home') }}#routes">Đặt vé</a></li>
                    <li><a href="{{ route('bill') }}">Hóa đơn</a></li>
                </ul>
            </nav>
        </div>

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
