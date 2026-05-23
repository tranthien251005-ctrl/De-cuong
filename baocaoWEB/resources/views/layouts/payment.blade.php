<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Thanh toán vé xe</title>
    <link rel="stylesheet" href="/css/payment.css?v=3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    @include('pages.header')

    <section class="payment-page">
        <div class="payment-shell">
            @if ($errors->any())
                <div class="payment-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="payment-intro">
                <span class="payment-kicker">Thanh toán vé xe</span>
                <h1>Hoàn tất thông tin thanh toán cho chuyến đi của bạn</h1>
                <p>
                    Điền họ tên và số điện thoại để xác nhận người đặt vé. Các thông tin mã vé,
                    ghế ngồi, điểm đến, ngày đi và giá tiền được hiển thị rõ ràng để bạn dễ kiểm tra
                    trước khi đặt vé.
                </p>
            </div>

            <div class="payment-hero">
                <div class="payment-card">
                    <div class="section-head">
                        <h2>Thông tin người thanh toán</h2>
                        <p>Bạn có thể thay đổi họ tên và số điện thoại trước khi xác nhận đơn vé.</p>
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
                                    value="{{ session('userFullName', session('userPhone', '')) }}"
                                >
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber">Số điện thoại</label>
                                <input
                                    type="tel"
                                    id="phoneNumber"
                                    name="phoneNumber"
                                    placeholder="Nhập số điện thoại"
                                    value="{{ session('userPhone', '') }}"
                                >
                            </div>

                            <div class="form-group">
                                <label for="seatNumber">Ghế ngồi</label>
                                <input type="text" id="seatNumber" name="seatNumber" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label for="ticketCode">Mã vé</label>
                                <input type="text" id="ticketCode" name="ticketCode" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label for="travelDate">Ngày đi</label>
                                <input type="text" id="travelDate" name="travelDate" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label for="destination">Điểm đến</label>
                                <input type="text" id="destination" name="destination" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label for="price">Giá tiền</label>
                                <input type="text" id="price" name="price" value="" readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <aside class="ticket-summary">
                    <div class="summary-top">
                        <small>Thông tin đơn vé</small>
                        <h3 id="tripTitle">Chuyến xe</h3>
                        <div class="summary-route" id="tripMeta">
                            Khởi hành theo lịch đã chọn | Ngày đi
                        </div>
                    </div>

                    <ul class="summary-list">
                        <li>
                            <span>Mã vé</span>
                            <strong id="summaryTicketCode"></strong>
                        </li>
                        <li>
                            <span>Ghế ngồi</span>
                            <strong id="summarySeatNumber"></strong>
                        </li>
                        <li>
                            <span>Ngày đi</span>
                            <strong id="summaryTravelDate"></strong>
                        </li>
                        <li>
                            <span>Điểm đến</span>
                            <strong id="summaryDestination"></strong>
                        </li>
                        <li>
                            <span>Giá vé</span>
                            <strong id="summaryPrice"></strong>
                        </li>
                    </ul>

                    <div class="payment-methods">
                        <h3>Hình thức thanh toán</h3>

                        <div class="method-grid">
                            <div class="method-option">
                                <input type="radio" id="cash" name="payment_method" value="tien_mat" form="paymentConfirmForm" checked>
                                <label for="cash">
                                    <span class="method-title">Tiền mặt</span>
                                    <span class="method-desc">Thanh toán trực tiếp tại quầy hoặc khi nhận vé.</span>
                                </label>
                            </div>

                            <div class="method-option">
                                <input type="radio" id="banking" name="payment_method" value="chuyen_khoan" form="paymentConfirmForm">
                                <label for="banking">
                                    <span class="method-title">Chuyển khoản</span>
                                    <span class="method-desc">Thanh toán qua ZaloPay hoặc ứng dụng ngân hàng bằng mã QR.</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="bank-transfer-panel" id="bankTransferPanel" hidden>
                        <div class="bank-transfer-head">
                            <div>
                                <span class="bank-transfer-kicker">QR chuyển khoản</span>
                                <h3>Quét bằng ZaloPay hoặc ứng dụng ngân hàng</h3>
                            </div>
                            <strong id="transferAmount">{{ $payment['transferInfo']['formattedAmount'] ?? '' }}</strong>
                        </div>

                        <div class="bank-transfer-body">
                            <div class="qr-card">
                                <img src="{{ $payment['transferInfo']['qrUrl'] ?? '' }}" alt="QR chuyển khoản" id="transferQrImage">
                                <p>Quét mã để thanh toán đúng số tiền cần trả cho đơn vé.</p>
                            </div>

                            <div class="bank-transfer-details">
                                <div class="transfer-detail">
                                    <span>Ngân hàng</span>
                                    <strong>{{ $payment['transferInfo']['bankName'] ?? '' }}</strong>
                                </div>
                                <div class="transfer-detail">
                                    <span>Chủ tài khoản</span>
                                    <strong>{{ $payment['transferInfo']['accountName'] ?? '' }}</strong>
                                </div>
                                <div class="transfer-detail">
                                    <span>Số tài khoản</span>
                                    <strong>{{ $payment['transferInfo']['accountNumber'] ?? '' }}</strong>
                                </div>
                                <div class="transfer-detail">
                                    <span>Số tiền</span>
                                    <strong>{{ $payment['transferInfo']['formattedAmount'] ?? '' }}</strong>
                                </div>
                                <div class="transfer-detail">
                                    <span>Nội dung chuyển khoản</span>
                                    <strong id="transferNote">{{ $payment['transferInfo']['note'] ?? '' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-total">
                        <span>Tổng thanh toán</span>
                        <strong id="totalAmount"></strong>
                    </div>

                    <form id="paymentConfirmForm" method="POST" action="{{ route('payment.confirm', $payment['matuyen'] ?? $tuyen->matuyen) }}">
                        @csrf
                        <input type="hidden" name="seat_ids" value="{{ implode(',', $payment['seatIds'] ?? []) }}">
                        <input type="hidden" name="travel_date" value="{{ $payment['rawDate'] ?? '' }}">
                        <button type="submit" class="pay-button" id="paymentSubmitButton">Đặt vé</button>
                    </form>
                    <p class="secure-note">
                        Nếu chọn chuyển khoản, vé sẽ chuyển sang trạng thái chờ admin xác nhận sau khi bạn bấm đã thanh toán.
                    </p>
                </aside>
            </div>
        </div>
    </section>

    <div class="payment-modal" id="transferModal" hidden>
        <div class="payment-modal__backdrop" data-close-transfer-modal></div>
        <div class="payment-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="transferModalTitle">
            <button type="button" class="payment-modal__close" aria-label="Đóng" data-close-transfer-modal>
                <i class="fas fa-times"></i>
            </button>

            <div class="payment-modal__content">
                <span class="payment-modal__kicker">Thanh toán chuyển khoản</span>
                <h2 id="transferModalTitle">Quét QR để thanh toán đơn vé</h2>
                <p class="payment-modal__intro">
                    Vui lòng mở ZaloPay hoặc ứng dụng ngân hàng để quét mã, thanh toán đúng số tiền và nội dung bên dưới.
                    Sau khi bấm đã thanh toán, đơn vé sẽ chuyển sang chờ admin xác nhận.
                </p>

                <div class="payment-modal__grid">
                    <div class="payment-modal__qr">
                        <img src="{{ $payment['transferInfo']['qrUrl'] ?? '' }}" alt="QR chuyển khoản MB">
                        <strong>{{ $payment['transferInfo']['formattedAmount'] ?? '' }}</strong>
                    </div>

                    <div class="payment-modal__details">
                        <div class="payment-modal__detail">
                            <span>Ngân hàng</span>
                            <strong>{{ $payment['transferInfo']['bankName'] ?? '' }}</strong>
                        </div>
                        <div class="payment-modal__detail">
                            <span>Chủ tài khoản</span>
                            <strong>{{ $payment['transferInfo']['accountName'] ?? '' }}</strong>
                        </div>
                        <div class="payment-modal__detail">
                            <span>Số tài khoản</span>
                            <strong>{{ $payment['transferInfo']['accountNumber'] ?? '' }}</strong>
                        </div>
                        <div class="payment-modal__detail">
                            <span>Số tiền</span>
                            <strong>{{ $payment['transferInfo']['formattedAmount'] ?? '' }}</strong>
                        </div>
                        <div class="payment-modal__detail">
                            <span>Nội dung</span>
                            <strong>{{ $payment['transferInfo']['note'] ?? '' }}</strong>
                        </div>
                    </div>
                </div>

                <div class="payment-modal__actions">
                    <button type="button" class="payment-modal__secondary" data-close-transfer-modal>Quay lại</button>
                    <button type="button" class="payment-modal__primary" id="confirmTransferButton">Tôi đã thanh toán</button>
                </div>
            </div>
        </div>
    </div>

    <div class="payment-toast" id="paymentToast" hidden>
        <i class="fas fa-circle-check"></i>
        <div>
            <strong>Đã ghi nhận yêu cầu thanh toán</strong>
            <p>Đơn vé của bạn đang chờ admin xác nhận chuyển khoản.</p>
        </div>
    </div>

    <script>
        const data = @json($payment ?? session('payment'));
        const fromPlace = data?.from || 'Đà Nẵng';
        const toPlace = data?.to || 'Cần Thơ';
        const travelDate = data?.date || '';
        const seatNumber = data?.seats || '';
        const ticketCode = data?.ticketCode || '';
        const totalPrice = data?.total || '';
        const bankingRadio = document.getElementById('banking');
        const cashRadio = document.getElementById('cash');
        const bankTransferPanel = document.getElementById('bankTransferPanel');
        const paymentConfirmForm = document.getElementById('paymentConfirmForm');
        const paymentSubmitButton = document.getElementById('paymentSubmitButton');
        const transferModal = document.getElementById('transferModal');
        const confirmTransferButton = document.getElementById('confirmTransferButton');
        const paymentToast = document.getElementById('paymentToast');
        let isTransferConfirmed = false;

        function syncTransferPanel() {
            if (!bankTransferPanel) {
                return;
            }

            bankTransferPanel.hidden = !bankingRadio?.checked;
            if (paymentSubmitButton) {
                paymentSubmitButton.textContent = bankingRadio?.checked ? 'Đặt vé' : 'Đặt vé';
            }
        }

        function openTransferModal() {
            if (!transferModal) {
                return;
            }

            transferModal.hidden = false;
            document.body.classList.add('payment-modal-open');
        }

        function closeTransferModal() {
            if (!transferModal) {
                return;
            }

            transferModal.hidden = true;
            document.body.classList.remove('payment-modal-open');
        }

        function showPaymentToast() {
            if (!paymentToast) {
                return;
            }

            paymentToast.hidden = false;
            requestAnimationFrame(() => paymentToast.classList.add('is-visible'));
        }

        document.title = `Thanh toán vé xe ${fromPlace} - ${toPlace}`;
        document.getElementById('seatNumber').value = seatNumber;
        document.getElementById('ticketCode').value = ticketCode;
        document.getElementById('travelDate').value = travelDate;
        document.getElementById('destination').value = toPlace;
        document.getElementById('price').value = totalPrice;
        document.getElementById('tripTitle').textContent = `Chuyến xe ${fromPlace} - ${toPlace}`;
        document.getElementById('tripMeta').textContent = `Tuyến: ${fromPlace} → ${toPlace} | Ngày đi ${travelDate}`;
        document.getElementById('summaryTicketCode').textContent = ticketCode;
        document.getElementById('summarySeatNumber').textContent = seatNumber;
        document.getElementById('summaryTravelDate').textContent = travelDate;
        document.getElementById('summaryDestination').textContent = toPlace;
        document.getElementById('summaryPrice').textContent = totalPrice;
        document.getElementById('totalAmount').textContent = totalPrice;

        bankingRadio?.addEventListener('change', syncTransferPanel);
        cashRadio?.addEventListener('change', syncTransferPanel);
        paymentConfirmForm?.addEventListener('submit', function (event) {
            if (!bankingRadio?.checked || isTransferConfirmed) {
                return;
            }

            event.preventDefault();
            openTransferModal();
        });

        document.querySelectorAll('[data-close-transfer-modal]').forEach((element) => {
            element.addEventListener('click', closeTransferModal);
        });

        confirmTransferButton?.addEventListener('click', function () {
            isTransferConfirmed = true;
            closeTransferModal();
            showPaymentToast();
            window.setTimeout(() => paymentConfirmForm?.submit(), 900);
        });

        syncTransferPanel();
    </script>

    @include('pages.footer')
</body>
</html>
