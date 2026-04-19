<?php

namespace App\Http\Controllers;

use App\Models\TuyenXe;
use Illuminate\Http\Request;

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

        $date = (string) $request->query('date', '');
        $dateLabel = $date ? date('d/m/Y', strtotime($date)) : '';

        $count = max(1, count($seats));
        $unitPrice = (int) ($tuyen->giatien ?? 0);
        $total = $unitPrice * $count;

        $ticketCode = 'VE-' . date('Ymd') . '-' . substr((string) mt_rand(100000, 999999), 0, 6);

        $payment = [
            'from' => $tuyen->diemdi ?? '',
            'to' => $tuyen->diemden ?? '',
            'date' => $dateLabel,
            'seats' => $seatLabel,
            'ticketCode' => $ticketCode,
            'unitPrice' => number_format($unitPrice, 0, ',', '.') . ' VND',
            'total' => number_format($total, 0, ',', '.') . ' VND',
        ];

        // Lưu để view hiện thị và có thể dùng cho bước sau
        session(['payment' => $payment]);

        return view('layouts.payment', compact('tuyen', 'payment'));
    }
}

