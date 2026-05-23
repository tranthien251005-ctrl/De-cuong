<?php

namespace App\Http\Controllers;

use App\Models\Ghe;
use App\Models\TuyenXe;
use App\Models\Ve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function show(Request $request, $matuyen = null)
    {
        $matuyen = $matuyen ?? $request->query('matuyen');
        if (!$matuyen) {
            return redirect()->route('home');
        }

        $tuyen = TuyenXe::findOrFail($matuyen);

        $seatsRaw = (string) $request->query('seats', '');
        $seats = array_values(array_filter(array_map('trim', explode(',', $seatsRaw))));
        $seatLabel = count($seats) ? implode(', ', $seats) : '';

        $seatIdsRaw = (string) $request->query('seat_ids', '');
        $seatIds = array_values(array_filter(array_map('intval', explode(',', $seatIdsRaw))));

        if (empty($seatIds) && !empty($seats)) {
            $seatIds = Ghe::where('maxe', $tuyen->maxe)
                ->whereIn('tenghe', $seats)
                ->pluck('maghe')
                ->map(fn ($id) => (int) $id)
                ->all();
        }

        $date = (string) $request->query('date', '');
        $dateLabel = $date ? date('d/m/Y', strtotime($date)) : '';

        $count = max(1, count($seats));
        $unitPrice = (int) ($tuyen->giatien ?? 0);
        $total = $unitPrice * $count;

        $ticketCode = ((int) Ve::max('mave')) + 1;
        $transferNote = sprintf('VE %s TUYEN %s', $ticketCode, (int) $tuyen->matuyen);
        $transferInfo = [
            'bankName' => 'MB Bank',
            'bankCode' => '970422',
            'accountName' => 'PHAM DINH LUAN',
            'accountNumber' => '0387705640',
            'amount' => $total,
            'formattedAmount' => number_format($total, 0, ',', '.') . ' VND',
            'note' => $transferNote,
            'qrUrl' => 'https://img.vietqr.io/image/970422-0387705640-compact2.png?amount='
                . $total
                . '&addInfo=' . urlencode($transferNote)
                . '&accountName=' . urlencode('PHAM DINH LUAN'),
        ];

        $payment = [
            'from' => $tuyen->diemdi ?? '',
            'to' => $tuyen->diemden ?? '',
            'date' => $dateLabel,
            'rawDate' => $date,
            'seats' => $seatLabel,
            'seatIds' => $seatIds,
            'matuyen' => (int) $tuyen->matuyen,
            'ticketCode' => $ticketCode,
            'unitPrice' => number_format($unitPrice, 0, ',', '.') . ' VND',
            'total' => number_format($total, 0, ',', '.') . ' VND',
            'rawTotal' => $total,
            'transferInfo' => $transferInfo,
        ];

        session(['payment' => $payment]);

        return view('layouts.payment', compact('tuyen', 'payment'));
    }

    public function confirm(Request $request, $matuyen)
    {
        $validated = $request->validate([
            'seat_ids' => 'required|string',
            'travel_date' => 'nullable|date',
            'payment_method' => 'required|in:tien_mat,chuyen_khoan',
        ]);

        $accountId = session('userId');
        if (!$accountId) {
            return redirect()->route('login')->withErrors(['Vui lòng đăng nhập trước khi thanh toán.']);
        }

        $tuyen = TuyenXe::findOrFail($matuyen);
        $seatIds = array_values(array_unique(array_filter(array_map('intval', explode(',', $validated['seat_ids'])))));

        if (empty($seatIds)) {
            return back()->withErrors(['Vui lòng chọn ghế trước khi thanh toán.']);
        }

        try {
            DB::beginTransaction();

            $ngayDat = !empty($validated['travel_date'])
                ? date('Y-m-d H:i:s', strtotime($validated['travel_date']))
                : now()->format('Y-m-d H:i:s');

            $ghes = Ghe::where('maxe', $tuyen->maxe)
                ->whereIn('maghe', $seatIds)
                ->get();

            if ($ghes->count() !== count($seatIds)) {
                throw new \RuntimeException('Ghế không hợp lệ cho tuyến xe này.');
            }

            if ($ghes->contains(fn ($ghe) => $ghe->trangthai === 'da_dat')) {
                throw new \RuntimeException('Một số ghế đã được đặt. Vui lòng chọn ghế khác.');
            }

            foreach ($ghes as $ghe) {
                $this->createTicket(
                    $ghe,
                    (int) $accountId,
                    $ngayDat,
                    (int) ($tuyen->giatien ?? 0),
                    $validated['payment_method']
                );

                $ghe->trangthai = 'da_dat';
                $ghe->save();
            }

            DB::commit();

            session()->forget('payment');

            $message = $validated['payment_method'] === 'chuyen_khoan'
                ? 'Yêu cầu thanh toán đã được ghi nhận. Vé của bạn đang chờ admin xác nhận chuyển khoản.'
                : 'Vé của bạn đã được lưu. Bạn có thể xem lại trong mục Hóa đơn.';

            return redirect()->route('home')->with('success', $message);
        } catch (\RuntimeException $e) {
            DB::rollBack();
            return back()->withErrors([$e->getMessage()]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Payment error: ' . $e->getMessage());
            return back()->withErrors(['Có lỗi xảy ra, vui lòng thử lại sau.']);
        }
    }

    private function createTicket(Ghe $ghe, int $accountId, string $ngayDat, int $total, string $paymentMethod): void
    {
        $trangThai = $paymentMethod === 'chuyen_khoan'
            ? 'cho_xac_nhan'
            : 'cho_don';

        Ve::create([
            'maghe' => $ghe->maghe,
            'mataikhoan' => $accountId,
            'ngaydat' => $ngayDat,
            'hinhthucthanhtoan' => $paymentMethod,
            'tongsotien' => $total,
            'trangthai' => $trangThai,
        ]);
    }
}
