<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <title>MY BUS · Đặt vé trực tuyến</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/byticket.css') }}">
</head>
<body>
@include('pages.header')
<div class="page-wrapper">
    <div class="booking-card">
        <!-- Form tìm kiếm với select điểm đi / điểm đến đã cập nhật theo yêu cầu -->
        <div class="search-banner">
            <div class="field-group">
                <label><i class="fas fa-map-marker-alt"></i> Điểm đi</label>
                <select id="fromPlace" name="from">
                    <option value="">Chọn điểm đi</option>
                    <option value="Hà Nội">Hà Nội</option>
                    <option value="Nam Định">Nam Định</option>
                    <option value="Ninh Bình">Ninh Bình</option>
                    <option value="Thanh Hóa">Thanh Hóa</option>
                    <option value="Hải Phòng">Hải Phòng</option>
                </select>
            </div>

            <div class="field-group">
                <label><i class="fas fa-flag-checkered"></i> Điểm đến</label>
                <select id="toPlace" name="to">
                    <option value="">Chọn điểm đến</option>
                    <option value="Hà Nội">Hà Nội</option>
                    <option value="Nam Định">Nam Định</option>
                    <option value="Ninh Bình">Ninh Bình</option>
                    <option value="Thanh Hóa">Thanh Hóa</option>
                    <option value="Hải Phòng">Hải Phòng</option>
                </select>
            </div>

            <div class="field-group">
                <label><i class="far fa-calendar-alt"></i> Ngày đi</label>
                <input type="date" id="travelDate" name="date" />
            </div>

            <button class="btn-primary" id="searchBtn"><i class="fas fa-search"></i> Tìm chuyến</button>
        </div>

        <!-- KẾT QUẢ + GHẾ + TÓM TẮT -->
        <div class="result-section">
            <!-- cột trái: thông tin chuyến & ghế -->
            <div>
                <div class="trip-detail">
                    <div class="trip-header">
                        <div class="trip-time">07:05 <i class="fas fa-arrow-right"></i> 11:00</div>
                        <div class="station-badge"><i class="fas fa-building"></i> BX Ô Môn</div>
                    </div>
                    <div class="route-highlight">
                        <div class="route-info-stack">
                            <strong>📅 Ngày khởi hành: <span id="displayDateHeader">--/--/----</span></strong>
                            <span>🕒 Thời gian trung bình: 4 giờ 0 phút</span>
                            <span>📍 Quãng đường: 160km</span>
                        </div>
                        <div class="select-badge"><i class="fas fa-exchange-alt"></i></div>
                    </div>

                    <!-- Khu vực chọn ghế hiện đại -->
                    <div class="seat-area">
                        <h4><i class="fas fa-couch"></i> Sơ đồ ghế (chọn ghế trống)</h4>
                        <div class="seat-grid" id="seatContainer">
                            <!-- ghế sẽ được tạo bằng js -->
                        </div>
                        <div class="legend">
                            <span><span class="legend-dot" style="background:#eff6ff; border:1px solid #dce5f0;"></span> Trống</span>
                            <span><span class="legend-dot" style="background:#f39c12;"></span> Đang chọn</span>
                            <span><span class="legend-dot" style="background:#eef2f6; border:1px solid #cbd5e1;"></span> Đã đặt</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- sidebar tổng kết đơn hàng -->
            <div class="summary-card" id="summaryBox">
                <h3><i class="fas fa-receipt"></i> Thông tin đặt vé</h3>
                <div class="info-row"><span>Tuyến:</span><span><strong id="routeName">-- → --</strong></span></div>
                <div class="info-row"><span>Ngày đi:</span><span id="displayDate">--/--/----</span></div>
                <div class="info-row"><span>Ghế đã chọn:</span><span id="selectedSeatsLabel">Chưa có ghế</span></div>
                <div class="info-row"><span>Biển số xe:</span><span>65D1-50354</span></div>
                <div class="info-row"><span>Đơn giá / vé:</span><span><strong>150.000đ</strong></span></div>
                <div class="total-price" id="totalPriceDisplay">0đ</div>
                <button class="btn-book-final" id="bookNowBtn"><i class="fas fa-check-circle"></i> ĐẶT VÉ NGAY</button>
                <p style="font-size: 11px; margin-top: 12px; color:#6c86a3;"><i class="fas fa-shield-alt"></i> Hoàn vé linh hoạt · Thanh toán an toàn</p>
            </div>
        </div>
    </div>
</div>
@include('pages.footer')
<script>
    // === KHỞI TẠO DỮ LIỆU GHẾ VÀ TÍNH NĂNG CHỌN (UI THUẦN) ===
    const seatLabels = ['A01','A02','A03','A04','A05','B01','B02','B03','B04','B05','C01','C02','C03','C04','C05','D01','D02','D03','D04','D05'];
    // 20 ghế, một số ghế booked (demo)
    let seatStatus = {
        'A03': 'booked',
        'B04': 'booked',
        'C02': 'booked',
        'D05': 'booked'
    };
    let selectedSeats = []; // lưu tên ghế đang chọn

    function renderSeats() {
        const container = document.getElementById('seatContainer');
        if (!container) return;
        container.innerHTML = '';
        seatLabels.forEach(label => {
            let status = seatStatus[label] || 'available';
            let isSelected = selectedSeats.includes(label);
            if (isSelected) status = 'selected';
            const seatDiv = document.createElement('div');
            seatDiv.className = `seat ${status}`;
            seatDiv.innerText = label;
            if (status !== 'booked') {
                seatDiv.style.cursor = 'pointer';
                seatDiv.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (seatStatus[label] === 'booked') return;
                    if (selectedSeats.includes(label)) {
                        selectedSeats = selectedSeats.filter(s => s !== label);
                    } else {
                        selectedSeats.push(label);
                    }
                    renderSeats();
                    updateSummary();
                });
            } else {
                seatDiv.style.cursor = 'not-allowed';
            }
            container.appendChild(seatDiv);
        });
    }

    function updateSummary() {
        const selectedCount = selectedSeats.length;
        const pricePerTicket = 150000;
        const total = selectedCount * pricePerTicket;
        document.getElementById('selectedSeatsLabel').innerText = selectedCount === 0 ? 'Chưa có ghế' : selectedSeats.join(', ');
        document.getElementById('totalPriceDisplay').innerHTML = total.toLocaleString('vi-VN') + 'đ';
        const bookBtn = document.getElementById('bookNowBtn');
        if (selectedCount === 0) {
            bookBtn.style.opacity = '0.7';
        } else {
            bookBtn.style.opacity = '1';
        }
    }

    // Cập nhật ngày hiện tại và min date (không cho chọn quá khứ)
    const dateInput = document.getElementById('travelDate');
    const today = new Date().toISOString().split('T')[0];
    if (dateInput) {
        dateInput.value = today;
        dateInput.setAttribute('min', today);
    }

    // hiển thị ngày lên sidebar và header
    function updateDateDisplay() {
        const dateVal = document.getElementById('travelDate').value;
        if (dateVal) {
            const formatted = new Date(dateVal).toLocaleDateString('vi-VN');
            document.getElementById('displayDate').innerText = formatted;
            const headerDateElem = document.getElementById('displayDateHeader');
            if (headerDateElem) headerDateElem.innerText = formatted;
        } else {
            document.getElementById('displayDate').innerText = 'Chưa chọn';
            const headerDateElem = document.getElementById('displayDateHeader');
            if (headerDateElem) headerDateElem.innerText = '--/--/----';
        }
    }
    if (dateInput) {
        dateInput.addEventListener('change', updateDateDisplay);
        updateDateDisplay();
    }

    // Cập nhật tên tuyến theo điểm đi/đến (từ select đã cập nhật)
    function updateRouteName() {
        const fromSelect = document.getElementById('fromPlace');
        const toSelect = document.getElementById('toPlace');
        let fromText = fromSelect.options[fromSelect.selectedIndex]?.value;
        let toText = toSelect.options[toSelect.selectedIndex]?.value;
        if (!fromText) fromText = '?';
        if (!toText) toText = '?';
        document.getElementById('routeName').innerText = `${fromText} → ${toText}`;
    }
    const fromSelect = document.getElementById('fromPlace');
    const toSelect = document.getElementById('toPlace');
    if (fromSelect && toSelect) {
        fromSelect.addEventListener('change', updateRouteName);
        toSelect.addEventListener('change', updateRouteName);
        updateRouteName();
    }

    // nút tìm kiếm: cập nhật tuyến và reset ghế
    document.getElementById('searchBtn')?.addEventListener('click', () => {
        // reset chọn ghế
        selectedSeats = [];
        renderSeats();
        updateSummary();
        updateRouteName();
        updateDateDisplay();
        
        const fromVal = fromSelect.options[fromSelect.selectedIndex]?.value;
        const toVal = toSelect.options[toSelect.selectedIndex]?.value;
        if (!fromVal || !toVal) {
            alert('🔍 Vui lòng chọn đầy đủ điểm đi và điểm đến!');
        } else {
            alert(`🔍 Đã tìm chuyến xe từ ${fromVal} → ${toVal}. Vui lòng chọn ghế.`);
        }
    });

    // đặt vé
    document.getElementById('bookNowBtn')?.addEventListener('click', () => {
        if (selectedSeats.length === 0) {
            alert('⚠️ Vui lòng chọn ít nhất 1 ghế trước khi đặt vé.');
            return;
        }
        const date = document.getElementById('travelDate').value;
        const from = fromSelect.options[fromSelect.selectedIndex]?.value || '?';
        const to = toSelect.options[toSelect.selectedIndex]?.value || '?';
        const formattedDate = date ? new Date(date).toLocaleDateString('vi-VN') : 'Chưa rõ';
        alert(`✅ Đặt vé thành công!\nTuyến: ${from} → ${to}\nNgày: ${formattedDate}\nGhế: ${selectedSeats.join(', ')}\nTổng tiền: ${(selectedSeats.length * 150000).toLocaleString('vi-VN')}đ\nCảm ơn bạn đã chọn MY BUS!`);
        // Giữ nguyên trạng thái ghế đã chọn để demo, có thể reset nếu muốn
    });

    // khởi tạo giao diện ghế
    renderSeats();
    updateSummary();
</script>
</body>
</html>

