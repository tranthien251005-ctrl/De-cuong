<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chú Thiện xe bus</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f4;
            color: #333;
        }
        .container-header{
            width: 90%;
            margin: 0 auto;
            display: flex;
            align-items: center;
        }
        .main-header{
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            margin-right: 20px;
        }
        .logo h1{
            font-size: 20px;
            margin-bottom: 5px;
        }
        .logo p{
            font-size: 12px;
            opacity: 0.8;
        }
        .navbar ul{
            display: flex;
            list-style: none;
            gap: 20px;
        }
        .navbar ul li a{
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
            opacity: 0.9;
        }
        .navbar ul li a:hover{
            color: oklch(62.3% 0.214 259.815);
        }
        .user-actions{
            margin-left: auto;
        }
        .user-actions a{
            color: #333;
            text-decoration: none;
            margin-left: 15px;
            padding: 7px 12px;
            border-radius: 5px;
            transition: 0.3s;
            font-weight: 500;
        }
        .user-actions .register{
            color: #fff;
            background-color: #00a949;
        }
        .user-actions .register:hover{
            background-color: #058d3e;
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="container-header">
        <div class="logo">
            <h1>🚌 CHÚ THIỆN</h1>
            <p>An toàn - Nhanh chóng - Tiện lợi</p>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="/index.php">Trang chủ</a></li>
                <li><a href="{{ url('/byticket') }}">Đặt vé</a></li>
                <li><a href="#">Hóa đơn</a></li>
            </ul>
        </nav>
        <div class="user-actions">
            <?php if(isset($_SESSION['user'])): ?>
                <span>Xin chào, <?php echo $_SESSION['user']; ?></span>
                <a href="logout.php">Đăng xuất</a>
            <?php else: ?>
                <a class="login" href="{{ url('/login')}}">Đăng nhập</a>
                <a class="register" href="/register">Đăng ký</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="container">