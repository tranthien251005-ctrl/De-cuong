<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Lịch sử hóa đơn vé xe</title>
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
</head>
<body>
    @include('pages.header')
    <section class="bill-page">
        <div class="bill-page__shell">
            <div class="bill-hero">
                <div>
                    <span class="bill-eyebrow">TRANG HÓA ĐƠN</span>
                    <h1>Lịch sử hóa đơn vé xe</h1>
                    <p>Theo dõi nhanh tuyến xe, ngày đi, giờ đi, trạng thái chờ đón hoặc đã đi, số tiền và số ghế đã đặt.</p>
                </div>

                <!-- Các thẻ thống kê tượng trưng (số liệu minh họa) -->
                <div class="bill-summary-grid">
                    <div class="bill-summary-card">
                        <span>Tổng hóa đơn</span>
                        <strong>12</strong>
                        <p>Số hóa đơn vé xe bạn có thể xem lại trên trang này.</p>
                    </div>
                    <div class="bill-summary-card">
                        <span>Chờ đón</span>
                        <strong>5</strong>
                        <p>Những chuyến sắp khởi hành và đang chờ đến giờ đón.</p>
                    </div>
                    <div class="bill-summary-card">
                        <span>Đã đi</span>
                        <strong>7</strong>
                        <p>Những hóa đơn của các chuyến xe đã hoàn thành.</p>
                    </div>
                    <div class="bill-summary-card">
                        <span>Tổng chi phí</span>
                        <strong>2.345.000đ</strong>
                        <p>Tổng số tiền của toàn bộ lịch sử hóa đơn hiển thị.</p>
                    </div>
                </div>
            </div>

            <div class="bill-history-card">
                <div class="bill-toolbar">
                    <div>
                        <h2>Lịch sử hóa đơn</h2>
                        <p>Bảng dưới đây hiển thị tuyến xe, ngày đi, giờ đi, trạng thái, số tiền và số ghế của từng hóa đơn.</p>
                    </div>

                    <div class="bill-filters" aria-label="Lọc hóa đơn theo trạng thái">
                        <button class="bill-filter-btn is-active" type="button" data-filter="all">Tất cả</button>
                        <button class="bill-filter-btn" type="button" data-filter="waiting">Chờ đón</button>
                        <button class="bill-filter-btn" type="button" data-filter="done">Đã đi</button>
                    </div>
                </div>

                <div class="bill-table-wrapper">
                    <table class="bill-table">
                        <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Tuyến xe</th>
                                <th>Ngày đi</th>
                                <th>Giờ đi</th>
                                <th>Trạng thái</th>
                                <th>Số tiền</th>
                                <th>Số ghế</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dòng 1: Chờ đón -->
                            <tr class="bill-row">
                                <td data-label="Mã hóa đơn">
                                    <span class="bill-code">HD-10245</span>
                                    <span class="bill-caption">Hóa đơn đã thanh toán</span>
                                </td>
                                <td data-label="Tuyến xe"><span class="bill-route">Hà Nội → Hải Phòng</span></td>
                                <td data-label="Ngày đi">15/04/2026</td>
                                <td data-label="Giờ đi">08:30</td>
                                <td data-label="Trạng thái"><span class="status-badge status-badge--waiting">Chờ đón</span></td>
                                <td data-label="Số tiền"><span class="bill-money">220.000đ</span></td>
                                <td data-label="Số ghế">
                                    <div class="seat-tags"><span class="seat-tag">A1</span><span class="seat-tag">A2</span></div>
                                </td>
                            </tr>
                            <!-- Dòng 2: Đã đi -->
                            <tr class="bill-row">
                                <td data-label="Mã hóa đơn">
                                    <span class="bill-code">HD-10289</span>
                                    <span class="bill-caption">Hóa đơn đã thanh toán</span>
                                </td>
                                <td data-label="Tuyến xe"><span class="bill-route">Hồ Chí Minh → Vũng Tàu</span></td>
                                <td data-label="Ngày đi">10/04/2026</td>
                                <td data-label="Giờ đi">13:45</td>
                                <td data-label="Trạng thái"><span class="status-badge status-badge--done">Đã đi</span></td>
                                <td data-label="Số tiền"><span class="bill-money">180.000đ</span></td>
                                <td data-label="Số ghế">
                                    <div class="seat-tags"><span class="seat-tag">C3</span></div>
                                </td>
                            </tr>
                            <!-- Dòng 3: Đã đi (nhiều ghế) -->
                            <tr class="bill-row">
                                <td data-label="Mã hóa đơn">
                                    <span class="bill-code">HD-10344</span>
                                    <span class="bill-caption">Hóa đơn đã thanh toán</span>
                                </td>
                                <td data-label="Tuyến xe"><span class="bill-route">Đà Nẵng → Huế</span></td>
                                <td data-label="Ngày đi">12/04/2026</td>
                                <td data-label="Giờ đi">06:20</td>
                                <td data-label="Trạng thái"><span class="status-badge status-badge--done">Đã đi</span></td>
                                <td data-label="Số tiền"><span class="bill-money">135.000đ</span></td>
                                <td data-label="Số ghế">
                                    <div class="seat-tags"><span class="seat-tag">B5</span><span class="seat-tag">B6</span><span class="seat-tag">B7</span></div>
                                </td>
                            </tr>
                            <!-- Dòng 4: Chờ đón -->
                            <tr class="bill-row">
                                <td data-label="Mã hóa đơn">
                                    <span class="bill-code">HD-10788</span>
                                    <span class="bill-caption">Hóa đơn đã thanh toán</span>
                                </td>
                                <td data-label="Tuyến xe"><span class="bill-route">Nha Trang → Đà Lạt</span></td>
                                <td data-label="Ngày đi">20/04/2026</td>
                                <td data-label="Giờ đi">22:10</td>
                                <td data-label="Trạng thái"><span class="status-badge status-badge--waiting">Chờ đón</span></td>
                                <td data-label="Số tiền"><span class="bill-money">310.000đ</span></td>
                                <td data-label="Số ghế">
                                    <div class="seat-tags"><span class="seat-tag">D2</span><span class="seat-tag">D3</span></div>
                                </td>
                            </tr>
                            <!-- Dòng 5: Đã đi -->
                            <tr class="bill-row">
                                <td data-label="Mã hóa đơn">
                                    <span class="bill-code">HD-10901</span>
                                    <span class="bill-caption">Hóa đơn đã thanh toán</span>
                                </td>
                                <td data-label="Tuyến xe"><span class="bill-route">Cần Thơ → Hà Tiên</span></td>
                                <td data-label="Ngày đi">05/04/2026</td>
                                <td data-label="Giờ đi">07:00</td>
                                <td data-label="Trạng thái"><span class="status-badge status-badge--done">Đã đi</span></td>
                                <td data-label="Số tiền"><span class="bill-money">95.000đ</span></td>
                                <td data-label="Số ghế">
                                    <div class="seat-tags"><span class="seat-tag">E1</span></div>
                                </td>
                            </tr>
                            <!-- Dòng 6: Chờ đón (xe giường nằm) -->
                            <tr class="bill-row">
                                <td data-label="Mã hóa đơn">
                                    <span class="bill-code">HD-11123</span>
                                    <span class="bill-caption">Hóa đơn đã thanh toán</span>
                                </td>
                                <td data-label="Tuyến xe"><span class="bill-route">Hà Nội → Sapa</span></td>
                                <td data-label="Ngày đi">25/04/2026</td>
                                <td data-label="Giờ đi">21:30</td>
                                <td data-label="Trạng thái"><span class="status-badge status-badge--waiting">Chờ đón</span></td>
                                <td data-label="Số tiền"><span class="bill-money">420.000đ</span></td>
                                <td data-label="Số ghế">
                                    <div class="seat-tags"><span class="seat-tag">F12</span><span class="seat-tag">F14</span><span class="seat-tag">F16</span></div>
                                </td>
                            </tr>
                            <!-- Dòng 7: Chờ đón thêm -->
                            <tr class="bill-row">
                                <td data-label="Mã hóa đơn">
                                    <span class="bill-code">HD-11256</span>
                                    <span class="bill-caption">Hóa đơn đã thanh toán</span>
                                </td>
                                <td data-label="Tuyến xe"><span class="bill-route">TP.HCM → Mũi Né</span></td>
                                <td data-label="Ngày đi">18/04/2026</td>
                                <td data-label="Giờ đi">07:15</td>
                                <td data-label="Trạng thái"><span class="status-badge status-badge--waiting">Chờ đón</span></td>
                                <td data-label="Số tiền"><span class="bill-money">265.000đ</span></td>
                                <td data-label="Số ghế">
                                    <div class="seat-tags"><span class="seat-tag">G7</span></div>
                                </td>
                            </tr>
                            <!-- Dòng 8: Đã đi -->
                            <tr class="bill-row">
                                <td data-label="Mã hóa đơn">
                                    <span class="bill-code">HD-11589</span>
                                    <span class="bill-caption">Hóa đơn đã thanh toán</span>
                                </td>
                                <td data-label="Tuyến xe"><span class="bill-route">Hải Phòng → Quảng Ninh</span></td>
                                <td data-label="Ngày đi">02/04/2026</td>
                                <td data-label="Giờ đi">14:50</td>
                                <td data-label="Trạng thái"><span class="status-badge status-badge--done">Đã đi</span></td>
                                <td data-label="Số tiền"><span class="bill-money">89.000đ</span></td>
                                <td data-label="Số ghế">
                                    <div class="seat-tags"><span class="seat-tag">H3</span><span class="seat-tag">H4</span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Không có empty state vì đã có dữ liệu mẫu -->
                </div>
            </div>
        </div>
    </section>
    <!-- Giải thích nhỏ: đây là giao diện tĩnh tượng trưng, không có xử lý logic filter phức tạp, chỉ hiển thị đúng yêu cầu: tuyến xe, ngày đi, giờ đi, trạng thái (chờ đón/đã đi), số tiền, số ghế -->
    @include('pages.footer')
</body>
</html>
