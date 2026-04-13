<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>MY BUS - Hành trình tiếp theo của bạn</title>
    <!-- Font Awesome & Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
       
    </style>
</head>
<body>

<!-- PHẦN HERO BẮT MẮT -->
<div class="hero">
    <div class="hero-content">
        <h1><i class="fas fa-bus-alt"></i> HÀNH TRÌNH TIẾP THEO CỦA BẠN</h1>
        <p>Đặt vé trực tuyến nhanh chóng, an toàn và tiện lợi nhất cùng MY BUS — Trải nghiệm di chuyển đẳng cấp</p>
        
        <!-- Form tìm kiếm UI thuần, không xử lý dữ liệu phía client -->
        <div class="search-banner">
    <select id="fromPlace" name="from">
        <option value="">📍 Chọn điểm đi</option>
        <option value="Ha Noi">Hà Nội</option>
        <option value="Nam Dinh">Nam Định</option>
        <option value="Ninh Binh">Ninh Bình</option>
        <option value="Thanh Hoa">Thanh Hóa</option>
        <option value="Hai Phong">Hải Phòng</option>
    </select>

    <select id="toPlace" name="to">
        <option value="">📍 Chọn điểm đến</option>
        <option value="Ha Noi">Hà Nội</option>
        <option value="Nam Dinh">Nam Định</option>
        <option value="Ninh Binh">Ninh Bình</option>
        <option value="Thanh Hoa">Thanh Hóa</option>
        <option value="Hai Phong">Hải Phòng</option>
    </select>

    <input type="date" id="travelDate" name="date">

    <script>
        const today = new Date().toISOString().split('T')[0];
        const dateInput = document.getElementById('travelDate');
        
        // Gán ngày hiện tại
        dateInput.value = today;
        
        // Chặn không cho chọn ngày trong quá khứ
        dateInput.setAttribute('min', today);
    </script>
    <button type="button"><i class="fas fa-search"></i> Tìm chuyến</button>
</div>

        <!-- Thống kê trang trí -->
        <div class="stats-row">
            <div class="stat-card"><div class="stat-number">⭐ 4.9</div><div class="stat-label">Đánh giá từ khách</div></div>
            <div class="stat-card"><div class="stat-number">🚌 120+</div><div class="stat-label">Chuyến xe mỗi ngày</div></div>
            <div class="stat-card"><div class="stat-number">💺 98%</div><div class="stat-label">Đúng giờ</div></div>
        </div>
    </div>
</div>

<!-- NỘI DUNG CHÍNH: DANH SÁCH TUYẾN XE -->
<div class="main-container">
    <div class="page-title">
        <i class="fas fa-map-marked-alt"></i>
        🚍 DANH SÁCH TUYỂN XE TRỰC TUYẾN
        <i class="fas fa-ticket-alt"></i>
    </div>

    <div class="routes-grid">
        <!-- TUYỂN SỐ 1 - Nam Định → Hà Nội (03:00) -->
        <div class="route-card">
            <div class="route-header"><i class="fas fa-route"></i> TUYẾN SỐ 1</div>
            <div class="route-body">
                <div class="route-points">
                    <span class="from-to">Nam Định</span>
                    <span class="arrow"><i class="fas fa-long-arrow-alt-right"></i></span>
                    <span class="from-to">Hà Nội</span>
                </div>
                <div class="route-info">
                    <div class="info-item"><div class="info-label">⏱️ THỜI GIAN</div><div class="info-value">3H</div></div>
                    <div class="info-item"><div class="info-label">📍 KHOẢNG CÁCH</div><div class="info-value">150KM</div></div>
                </div>
                <div class="times">
                    <span class="time-badge"><i class="far fa-clock"></i> 03:00</span>
                    <span><i class="fas fa-arrow-right"></i></span>
                    <span class="time-badge"><i class="far fa-clock"></i> 06:00</span>
                </div>
                <div class="price-section">
                    <div class="price-label">GIÁ VÉ TỪ</div>
                    <div class="price-value">150.000 <span class="price-unit">đ</span></div>
                </div>
                <button class="btn-book"><i class="fas fa-calendar-check"></i> ĐẶT NGAY</button>
            </div>
        </div>

        <!-- TUYỂN SỐ 2 - Hà Nội → Nam Định (08:00) -->
        <div class="route-card">
            <div class="route-header"><i class="fas fa-route"></i> TUYẾN SỐ 2</div>
            <div class="route-body">
                <div class="route-points">
                    <span class="from-to">Hà Nội</span>
                    <span class="arrow"><i class="fas fa-long-arrow-alt-right"></i></span>
                    <span class="from-to">Nam Định</span>
                </div>
                <div class="route-info">
                    <div class="info-item"><div class="info-label">⏱️ THỜI GIAN</div><div class="info-value">3H</div></div>
                    <div class="info-item"><div class="info-label">📍 KHOẢNG CÁCH</div><div class="info-value">150KM</div></div>
                </div>
                <div class="times">
                    <span class="time-badge"><i class="far fa-clock"></i> 08:00</span>
                    <span><i class="fas fa-arrow-right"></i></span>
                    <span class="time-badge"><i class="far fa-clock"></i> 11:00</span>
                </div>
                <div class="price-section">
                    <div class="price-label">GIÁ VÉ TỪ</div>
                    <div class="price-value">150.000 <span class="price-unit">đ</span></div>
                </div>
                <button class="btn-book"><i class="fas fa-calendar-check"></i> ĐẶT NGAY</button>
            </div>
        </div>

        <!-- TUYỂN SỐ 3 - Nam Định → Hà Nội (14:00) -->
        <div class="route-card">
            <div class="route-header"><i class="fas fa-route"></i> TUYẾN SỐ 3</div>
            <div class="route-body">
                <div class="route-points">
                    <span class="from-to">Nam Định</span>
                    <span class="arrow"><i class="fas fa-long-arrow-alt-right"></i></span>
                    <span class="from-to">Hà Nội</span>
                </div>
                <div class="route-info">
                    <div class="info-item"><div class="info-label">⏱️ THỜI GIAN</div><div class="info-value">5H</div></div>
                    <div class="info-item"><div class="info-label">📍 KHOẢNG CÁCH</div><div class="info-value">150KM</div></div>
                </div>
                <div class="times">
                    <span class="time-badge"><i class="far fa-clock"></i> 14:00</span>
                    <span><i class="fas fa-arrow-right"></i></span>
                    <span class="time-badge"><i class="far fa-clock"></i> 17:00</span>
                </div>
                <div class="price-section">
                    <div class="price-label">GIÁ VÉ TỪ</div>
                    <div class="price-value">150.000 <span class="price-unit">đ</span></div>
                </div>
                <button class="btn-book"><i class="fas fa-calendar-check"></i> ĐẶT NGAY</button>
            </div>
        </div>

        <!-- TUYỂN SỐ 4 - Hà Nội → Nam Định (18:00) -->
        <div class="route-card">
            <div class="route-header"><i class="fas fa-route"></i> TUYẾN SỐ 4</div>
            <div class="route-body">
                <div class="route-points">
                    <span class="from-to">Hà Nội</span>
                    <span class="arrow"><i class="fas fa-long-arrow-alt-right"></i></span>
                    <span class="from-to">Nam Định</span>
                </div>
                <div class="route-info">
                    <div class="info-item"><div class="info-label">⏱️ THỜI GIAN</div><div class="info-value">4H</div></div>
                    <div class="info-item"><div class="info-label">📍 KHOẢNG CÁCH</div><div class="info-value">150KM</div></div>
                </div>
                <div class="times">
                    <span class="time-badge"><i class="far fa-clock"></i> 18:00</span>
                    <span><i class="fas fa-arrow-right"></i></span>
                    <span class="time-badge"><i class="far fa-clock"></i> 21:00</span>
                </div>
                <div class="price-section">
                    <div class="price-label">GIÁ VÉ TỪ</div>
                    <div class="price-value">150.000 <span class="price-unit">đ</span></div>
                </div>
                <button class="btn-book"><i class="fas fa-calendar-check"></i> ĐẶT NGAY</button>
            </div>
        </div>

        <!-- TUYẾN MỞ RỘNG 5: Hà Nội → Ninh Bình (thêm màu sắc) -->
        <div class="route-card">
            <div class="route-header"><i class="fas fa-mountain"></i> TUYẾN VIP 5</div>
            <div class="route-body">
                <div class="route-points">
                    <span class="from-to">Hà Nội</span>
                    <span class="arrow"><i class="fas fa-long-arrow-alt-right"></i></span>
                    <span class="from-to">Ninh Bình</span>
                </div>
                <div class="route-info">
                    <div class="info-item"><div class="info-label">⏱️ THỜI GIAN</div><div class="info-value">2H30</div></div>
                    <div class="info-item"><div class="info-label">📍 KHOẢNG CÁCH</div><div class="info-value">110KM</div></div>
                </div>
                <div class="times">
                    <span class="time-badge"><i class="far fa-clock"></i> 07:30</span>
                    <span><i class="fas fa-arrow-right"></i></span>
                    <span class="time-badge"><i class="far fa-clock"></i> 10:00</span>
                </div>
                <div class="price-section">
                    <div class="price-label">GIÁ VÉ TỪ</div>
                    <div class="price-value">120.000 <span class="price-unit">đ</span></div>
                </div>
                <button class="btn-book"><i class="fas fa-calendar-check"></i> ĐẶT NGAY</button>
            </div>
        </div>

        <!-- TUYẾN MỞ RỘNG 6: Nam Định → Thanh Hóa -->
        <div class="route-card">
            <div class="route-header"><i class="fas fa-water"></i> TUYẾN SỐ 6</div>
            <div class="route-body">
                <div class="route-points">
                    <span class="from-to">Nam Định</span>
                    <span class="arrow"><i class="fas fa-long-arrow-alt-right"></i></span>
                    <span class="from-to">Thanh Hóa</span>
                </div>
                <div class="route-info">
                    <div class="info-item"><div class="info-label">⏱️ THỜI GIAN</div><div class="info-value">2H</div></div>
                    <div class="info-item"><div class="info-label">📍 KHOẢNG CÁCH</div><div class="info-value">85KM</div></div>
                </div>
                <div class="times">
                    <span class="time-badge"><i class="far fa-clock"></i> 09:00</span>
                    <span><i class="fas fa-arrow-right"></i></span>
                    <span class="time-badge"><i class="far fa-clock"></i> 11:00</span>
                </div>
                <div class="price-section">
                    <div class="price-label">GIÁ VÉ TỪ</div>
                    <div class="price-value">90.000 <span class="price-unit">đ</span></div>
                </div>
                <button class="btn-book"><i class="fas fa-calendar-check"></i> ĐẶT NGAY</button>
            </div>
        </div>
    </div>

    <!-- KHU VỰC KHUYẾN MÃI & PHẢN HỒI (UI tinh tế) -->
    <div class="promo-block">
        <div class="testimonial-text">
            <i class="fas fa-quote-left" style="color:#f39c12; margin-right: 6px;"></i> 
            "MY BUS thực sự chuyên nghiệp, ghế ngồi thoải mái, đúng giờ. Rất hài lòng!"
            <div style="margin-top: 8px; font-weight: 600;">— Chị Lan Anh, Hà Nam</div>
        </div>
        <div class="promo-badge"><i class="fas fa-gift"></i> MÃ GIẢM 20K: MYBUS20</div>
        <div class="promo-badge" style="background:#b64926;"><i class="fas fa-shield-alt"></i> ĐẶT VÉ LINH HOẠT</div>
    </div>
</div>

@include('pages.footer')

</body>
</html>