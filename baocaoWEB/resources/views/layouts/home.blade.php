<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>MY BUS - Hành trình tiếp theo của bạn</title>
    <!-- Font Awesome & Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

</head>
<body>

@include('pages.header')

<div class="main-wrapper">
    <!-- PHẦN HERO BẮT MẮT -->
    <div class="hero">
    <div class="hero-content">
        <h1><i class="fas fa-bus-alt"></i> HÀNH TRÌNH TIẾP THEO CỦA BẠN</h1>
        <p>Đặt vé trực tuyến nhanh chóng, an toàn và tiện lợi nhất cùng MY BUS — Trải nghiệm di chuyển đẳng cấp</p>
        <form method="GET" action="{{ url('/') }}" class="search-banner">
            <select name="from">
                <option value="">📍 Chọn điểm đi</option>
                @foreach($tuyenXes as $tuyen)
                    <option value="{{ $tuyen->diemdi }}" {{ request('from') == $tuyen->diemdi ? 'selected' : '' }}>
                        {{ $tuyen->diemdi }}
                    </option>
                @endforeach
            </select>

            <select name="to">
                <option value="">📍 Chọn điểm đến</option>
                @foreach($tuyenXes as $tuyen)
                    <option value="{{ $tuyen->diemden }}" {{ request('to') == $tuyen->diemden ? 'selected' : '' }}>
                        {{ $tuyen->diemden }}
                    </option>
                @endforeach
            </select>

            <select name="time">
                <option value="">⏰ Giờ đi</option>
                @foreach($tuyenXes as $tuyen)
                    <option value="{{ $tuyen->giodi }}" {{ request('time') == $tuyen->giodi ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($tuyen->giodi)->format('H:i') }}
                    </option>
                @endforeach
            </select>

            <button type="submit"><i class="fas fa-search"></i> Tìm chuyến</button>
        </form>

        <!-- Thống kê trang trí -->
        <div class="stats-row">
            <div class="stat-card"><div class="stat-number">⭐ 4.9</div><div class="stat-label">Đánh giá từ khách</div></div>
            <div class="stat-card"><div class="stat-number">🚌 120+</div><div class="stat-label">Chuyến xe mỗi ngày</div></div>
            <div class="stat-card"><div class="stat-number">💺 98%</div><div class="stat-label">Đúng giờ</div></div>
        </div>
    </div>
</div>

<!-- NỘI DUNG CHÍNH: DANH SÁCH TUYẾN XE -->
<div class="main-container" id="routes">
    <div class="page-title">
        <i class="fas fa-map-marked-alt"></i>
        🚍 DANH SÁCH TUYỂN XE TRỰC TUYẾN
        <i class="fas fa-ticket-alt"></i>
    </div>

    <div class="routes-grid">
    @forelse($tuyenXes as $tuyen)
        <div class="route-card">
            <div class="route-header">
                <i class="fas fa-route"></i> {{ $tuyen->tentuyen }}
            </div>
            <div class="route-body">
                <div class="route-points">
                    <span class="from-to">{{ $tuyen->diemdi }}</span>
                    <span class="arrow"><i class="fas fa-long-arrow-alt-right"></i></span>
                    <span class="from-to">{{ $tuyen->diemden }}</span>
                </div>
                
                <div class="route-info">
                    <div class="info-item">
                        <div class="info-label">⏱️ THỜI GIAN</div>
                        <div class="info-value">{{ $tuyen->thoigiandukien }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">📍 KHOẢNG CÁCH</div>
                        <div class="info-value">{{ $tuyen->khoangcach }}KM</div>
                    </div>
                </div>
                
                <div class="times">
                    <span class="time-badge">
                        <i class="far fa-clock"></i>
                        {{ $tuyen->giodi ? \Carbon\Carbon::parse($tuyen->giodi)->format('H:i') : '--:--' }}
                    </span>
                    @if($tuyen->gioden)
                        <span><i class="fas fa-arrow-right"></i></span>
                        <span class="time-badge">
                            <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($tuyen->gioden)->format('H:i') }}
                        </span>
                    @endif
                </div>
                
                <div class="price-section">
                    <div class="price-label">GIÁ VÉ TỪ</div>
                    <div class="price-value">
                        {{ number_format($tuyen->giatien, 0, ',', '.') }} 
                        <span class="price-unit">.000 vnđ</span>
                    </div>
                </div>
                
                <button class="btn-book" onclick="bookRoute({{ $tuyen->matuyen }})">
                    ĐẶT NGAY
                </button>
            </div>
        </div>
    @empty
        <div class="route-card" style="grid-column: 1 / -1; text-align: center;">
            <div class="route-header">
                <i class="fas fa-exclamation-triangle"></i> Không tìm thấy tuyến xe
            </div>
            <div class="route-body">
                <p>Không có tuyến xe phù hợp với <strong>
                    @if(request('from')) {{ request('from') }} → @endif
                    @if(request('to')) {{ request('to') }} @endif
                    @if(request('time')) lúc {{ request('time') }} @endif
                </strong></p>
                <p>Vui lòng chọn lại điểm đi, điểm đến hoặc giờ đi khác.</p>
            </div>
        </div>
    @endforelse
</div>

<script>
    function bookRoute(routeId) {
        window.location.href = "{{ url('/byticket') }}/" + routeId;
    }
</script>
        <!-- KHU VỰC KHUYẾN MÃI & PHẢN HỒI -->
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
</div>

@include('pages.footer')

</body>
</html>
