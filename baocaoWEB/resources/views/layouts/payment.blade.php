<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Thanh toán vé xe</title>
    <style>
        :root {
            --bg: #f4efe7;
            --surface: rgba(255, 255, 255, 0.94);
            --surface-soft: #fffaf2;
            --text: #20323f;
            --muted: #607282;
            --primary: #c66b3d;
            --primary-dark: #9f4f27;
            --line: #eadcc9;
            --shadow: 0 20px 45px rgba(93, 58, 24, 0.12);
            --success: #2d8c68;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255, 213, 156, 0.45), transparent 30%),
                radial-gradient(circle at bottom right, rgba(255, 178, 129, 0.35), transparent 24%),
                linear-gradient(135deg, #f7f1e8 0%, #fff9f2 52%, #f2e8da 100%);
        }

        .payment-page {
            min-height: 100vh;
            padding: 32px 20px 64px;
        }

        .payment-shell {
            max-width: 1120px;
            margin: 0 auto;
        }

        .payment-hero {
            display: grid;
            gap: 28px;
            grid-template-columns: 1.15fr 0.85fr;
            align-items: start;
        }

        .payment-intro {
            display: none;
        }

        .payment-kicker {
            display: inline-flex;
            align-items: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(198, 107, 61, 0.12);
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .payment-intro h1 {
            margin: 18px 0 12px;
            font-size: clamp(32px, 5vw, 48px);
            line-height: 1.1;
        }

        .payment-intro p {
            margin: 0;
            max-width: 620px;
            font-size: 16px;
            line-height: 1.7;
            color: var(--muted);
        }

        .payment-highlights {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 28px;
        }

        .highlight-card {
            padding: 18px 18px 16px;
            border: 1px solid rgba(255, 255, 255, 0.55);
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.62);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow);
        }

        .highlight-card strong {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--primary-dark);
        }

        .highlight-card span {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .payment-card,
        .ticket-summary {
            border-radius: 28px;
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.75);
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
        }

        .payment-card {
            padding: 34px;
        }

        .section-head {
            margin-bottom: 26px;
        }

        .section-head h2 {
            margin: 0 0 8px;
            font-size: 26px;
        }

        .section-head p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .form-grid {
            display: grid;
            gap: 18px 20px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            height: 52px;
            padding: 0 16px;
            border-radius: 16px;
            border: 1px solid var(--line);
            background: #fffdf9;
            font-size: 15px;
            color: var(--text);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(198, 107, 61, 0.16);
            transform: translateY(-1px);
        }

        .ticket-summary {
            padding: 30px;
            position: sticky;
            top: 24px;
        }

        .summary-top {
            padding: 20px;
            border-radius: 22px;
            color: #fffaf6;
            background: linear-gradient(135deg, #243947 0%, #35566b 56%, #4f7b8c 100%);
        }

        .summary-top small {
            display: block;
            margin-bottom: 10px;
            opacity: 0.78;
            font-size: 13px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .summary-top h3 {
            margin: 0;
            font-size: 28px;
        }

        .summary-route {
            margin-top: 12px;
            font-size: 15px;
            line-height: 1.7;
            opacity: 0.9;
        }

        .summary-list {
            margin: 24px 0 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 14px;
        }

        .summary-list li {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 14px;
            border-bottom: 1px dashed var(--line);
            font-size: 15px;
        }

        .summary-list li span:first-child {
            color: var(--muted);
        }

        .summary-list li strong {
            text-align: right;
        }

        .payment-methods {
            margin-top: 26px;
        }

        .payment-methods h3 {
            margin: 0 0 14px;
            font-size: 18px;
        }

        .method-grid {
            display: grid;
            gap: 14px;
        }

        .method-option {
            position: relative;
        }

        .method-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .method-option label {
            display: block;
            padding: 18px 18px 18px 50px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--surface-soft);
            cursor: pointer;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .method-option label::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 18px;
            width: 18px;
            height: 18px;
            border: 2px solid #d2b392;
            border-radius: 50%;
            transform: translateY(-50%);
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .method-option input:checked + label {
            border-color: rgba(198, 107, 61, 0.55);
            box-shadow: 0 10px 22px rgba(198, 107, 61, 0.14);
            transform: translateY(-2px);
        }

        .method-option input:checked + label::before {
            border-color: var(--primary);
            background: radial-gradient(circle, var(--primary) 0 45%, #fff 46% 100%);
        }

        .method-title {
            display: block;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .method-desc {
            display: block;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .summary-total {
            margin-top: 24px;
            padding: 18px 20px;
            border-radius: 20px;
            background: #fff8ef;
            border: 1px solid #f0d9bc;
        }

        .summary-total span {
            display: block;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .summary-total strong {
            font-size: 30px;
            color: var(--primary-dark);
        }

        .pay-button {
            width: 100%;
            margin-top: 20px;
            padding: 16px 20px;
            border: none;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--primary) 0%, #d5854a 100%);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 16px 30px rgba(198, 107, 61, 0.22);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 34px rgba(198, 107, 61, 0.28);
        }

        .secure-note {
            margin: 14px 0 0;
            text-align: center;
            font-size: 13px;
            color: var(--success);
        }

    </style>
</head>
<body>
    @include('pages.header')

    <section class="payment-page">
        <div class="payment-shell">
            <div class="payment-intro">
                <span class="payment-kicker">Thanh toán vé xe</span>
                <h1>Hoàn tất thông tin thanh toán cho chuyến đi của bạn</h1>
                <p>
                    Điền họ tên và số điện thoại để xác nhận người đặt vé. Các thông tin mã vé,
                    ghế ngồi, điểm đến và giá tiền được hiển thị rõ ràng để bạn dễ dàng kiểm tra
                    trước khi thanh toán.
                </p>

                <div class="payment-highlights">
                    <div class="highlight-card">
                        <strong>Thông tin dễ sửa</strong>
                        <span>Họ tên và số điện thoại có thể nhập và thay đổi trực tiếp.</span>
                    </div>
                    <div class="highlight-card">
                        <strong>Chi tiết minh bạch</strong>
                        <span>Hiển thị ghế ngồi, mã vé, điểm đến và giá tiền ngay trên trang.</span>
                    </div>
                    <div class="highlight-card">
                        <strong>Thanh toán linh hoạt</strong>
                        <span>Hỗ trợ hai hình thức: tiền mặt và chuyển khoản.</span>
                    </div>
                </div>
            </div>

            <div class="payment-hero">
                <div class="payment-card">
                    <div class="section-head">
                        <h2>Thông tin người thanh toán</h2>
                        <p>Bạn có thể thay đổi hai trường dưới đây trước khi xác nhận đơn vé.</p>
                    </div>

                    <form>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="fullName">Họ tên</label>
                                <input
                                    type="text"
                                    id="fullName"
                                    name="fullName"
                                    placeholder="Nhập họ tên của bạn"
                                    value="Nguyen Van A"
                                >
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber">Số điện thoại</label>
                                <input
                                    type="tel"
                                    id="phoneNumber"
                                    name="phoneNumber"
                                    placeholder="Nhập số điện thoại"
                                    value="0901234567"
                                >
                            </div>

                            <div class="form-group">
                                <label for="seatNumber">Ghế ngồi</label>
                                <input
                                    type="text"
                                    id="seatNumber"
                                    name="seatNumber"
                                    value="A05"
                                    readonly
                                >
                            </div>

                            <div class="form-group">
                                <label for="ticketCode">Mã vé</label>
                                <input
                                    type="text"
                                    id="ticketCode"
                                    name="ticketCode"
                                    value="VE-2026-00125"
                                    readonly
                                >
                            </div>

                            <div class="form-group">
                                <label for="destination">Điểm đến</label>
                                <input
                                    type="text"
                                    id="destination"
                                    name="destination"
                                    value="Cần Thơ"
                                    readonly
                                >
                            </div>

                            <div class="form-group">
                                <label for="price">Giá tiền</label>
                                <input
                                    type="text"
                                    id="price"
                                    name="price"
                                    value="250.000 VND"
                                    readonly
                                >
                            </div>
                        </div>
                    </form>
                </div>

                <aside class="ticket-summary">
                    <div class="summary-top">
                        <small>Thông tin đơn vé</small>
                        <h3 id="tripTitle">Chuyến xe Đà Nẵng - Cần Thơ</h3>
                        <div class="summary-route" id="tripMeta">
                            Khởi hành theo lịch đã chọn | Ngày đi 18/04/2026
                        </div>
                    </div>

                    <ul class="summary-list">
                        <li>
                            <span>Mã vé</span>
                            <strong id="summaryTicketCode">VE-2026-00125</strong>
                        </li>
                        <li>
                            <span>Ghế ngồi</span>
                            <strong id="summarySeatNumber">A05</strong>
                        </li>
                        <li>
                            <span>Điểm đến</span>
                            <strong id="summaryDestination">Cần Thơ</strong>
                        </li>
                        <li>
                            <span>Giá vé</span>
                            <strong id="summaryPrice">250.000 VND</strong>
                        </li>
                    </ul>

                    <div class="payment-methods">
                        <h3>Hình thức thanh toán</h3>

                        <div class="method-grid">
                            <div class="method-option">
                                <input type="radio" id="cash" name="paymentMethod" checked>
                                <label for="cash">
                                    <span class="method-title">Tiền mặt</span>
                                    <span class="method-desc">Thanh toán trực tiếp tại quầy hoặc khi nhận vé.</span>
                                </label>
                            </div>

                            <div class="method-option">
                                <input type="radio" id="banking" name="paymentMethod">
                                <label for="banking">
                                    <span class="method-title">Chuyển khoản</span>
                                    <span class="method-desc">Thanh toán qua tài khoản ngân hàng để xác nhận nhanh hơn.</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="summary-total">
                        <span>Tổng thanh toán</span>
                        <strong id="totalAmount">250.000 VND</strong>
                    </div>

                    <button type="button" class="pay-button">Xác nhận thanh toán</button>
                    <p class="secure-note">Thông tin thanh toán được hiển thị rõ ràng và dễ kiểm tra.</p>
                </aside>
            </div>
        </div>
    </section>

    <script>
        const data = @json(session('payment'));
        const fromPlace = data?.from || 'Đà Nẵng';
        const toPlace = data?.to || 'Cần Thơ';
        const travelDate = data?.date || '';
        const seatNumber = data?.seats || '';
        const ticketCode = data?.ticketCode || '';
        const totalPrice = data?.total || '';

        document.title = `Thanh toán vé xe ${fromPlace} - ${toPlace}`;
        document.getElementById('seatNumber').value = seatNumber;
        document.getElementById('ticketCode').value = ticketCode;
        document.getElementById('destination').value = toPlace;
        document.getElementById('price').value = totalPrice;
        document.getElementById('tripTitle').textContent = `Chuyến xe ${fromPlace} - ${toPlace}`;
        document.getElementById('tripMeta').textContent = `Tuyến: ${fromPlace} → ${toPlace} | Ngày đi ${travelDate}`;
        document.getElementById('summaryTicketCode').textContent = ticketCode;
        document.getElementById('summarySeatNumber').textContent = seatNumber;
        document.getElementById('summaryDestination').textContent = toPlace;
        document.getElementById('summaryPrice').textContent = totalPrice;
        document.getElementById('totalAmount').textContent = totalPrice;
    </script>

    @include('pages.footer')
</body>
</html>
