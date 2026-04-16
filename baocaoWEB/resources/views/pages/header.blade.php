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
                <li><a href="{{ url('/bill') }}">Hóa đơn</a></li>
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

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    /* Important: Body padding-top để tránh header đè lên nội dung */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f4f4;
        color: #333;
        padding-top: 70px !important; /* Bù cho header fixed */
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
    
    .logo {
        flex-shrink: 0;
        margin-right: 20px;
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
        opacity: 0.9;
    }
    
    .navbar ul li a:hover {
        color: #0f766e;
    }
    
    .user-actions {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .user-actions span {
        font-size: 14px;
    }
    
    .user-actions a,
    .logout-btn {
        color: #333;
        text-decoration: none;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
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
    
    /* Responsive header */
    @media (max-width: 768px) {
        body {
            padding-top: 120px !important;
        }
    }
    
    @media (max-width: 700px) {
        .container-header {
            flex-direction: column;
            text-align: center;
            gap: 8px;
            padding: 8px 0;
        }
        
        .navbar ul {
            justify-content: center;
            gap: 15px;
        }
        
        .user-actions {
            margin-left: 0;
            justify-content: center;
        }
    }
    
    @media (max-width: 480px) {
        body {
            padding-top: 150px !important;
        }
        
        .logo h1 {
            font-size: 16px;
        }
        
        .logo p {
            font-size: 9px;
        }
        
        .navbar ul li a {
            font-size: 12px;
        }
        
        .user-actions a,
        .logout-btn {
            padding: 4px 10px;
            font-size: 12px;
        }
        
        .user-actions span {
            font-size: 12px;
        }
    }
</style>
