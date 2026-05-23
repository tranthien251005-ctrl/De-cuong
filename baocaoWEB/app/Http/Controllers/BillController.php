<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use App\Models\Ve;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $userId = (int) session('userId', 0);
        $phone = trim((string) $request->query('phone', session('userPhone', '')));
        $account = null;
        $bills = collect();
        $summary = [
            'total' => 0,
            'waiting' => 0,
            'done' => 0,
            'amount' => 0,
        ];

        if ($userId > 0) {
            $account = TaiKhoan::find($userId);
            if ($account) {
                $phone = (string) $account->phone;
            }
        } elseif ($phone !== '') {
            $account = TaiKhoan::where('phone', $phone)->first();
        }

        if ($account) {
            $bills = Ve::query()
                ->from('ve')
                ->leftJoin('vitrighe', 've.maghe', '=', 'vitrighe.maghe')
                ->leftJoin('tuyenxe', 'vitrighe.maxe', '=', 'tuyenxe.maxe')
                ->where('ve.mataikhoan', $account->id)
                ->select([
                    've.mave',
                    've.ngaydat',
                    've.hinhthucthanhtoan',
                    've.tongsotien',
                    've.trangthai',
                    'vitrighe.tenghe',
                    'tuyenxe.diemdi',
                    'tuyenxe.diemden',
                ])
                ->orderByDesc('ve.ngaydat')
                ->orderByDesc('ve.mave')
                ->get()
                ->map(function ($bill) {
                    $travelDate = $bill->ngaydat ? Carbon::parse($bill->ngaydat) : null;

                    if ($bill->trangthai === 'chua_thanh_toan') {
                        $bill->status_key = 'cancelled';
                        $bill->status_label = 'Đã hủy';
                    } elseif ($bill->trangthai === 'cho_xac_nhan') {
                        $bill->status_key = 'pending';
                        $bill->status_label = 'Chờ xác nhận thanh toán';
                    } elseif ($bill->trangthai === 'cho_don') {
                        $bill->status_key = 'waiting';
                        $bill->status_label = 'Đã thanh toán';
                    } else {
                        $bill->status_key = 'done';
                        $bill->status_label = 'Đã đi';
                    }

                    $bill->date_label = $travelDate ? $travelDate->format('d/m/Y') : 'Chưa cập nhật';
                    $bill->time_label = $travelDate ? $travelDate->format('H:i') : '--:--';
                    $bill->route_label = trim(($bill->diemdi ?? '') . ' - ' . ($bill->diemden ?? ''), ' -');
                    $bill->route_label = $bill->route_label !== '' ? $bill->route_label : 'Chưa cập nhật tuyến xe';
                    $bill->money_label = number_format((int) ($bill->tongsotien ?? 0), 0, ',', '.') . ' VND';
                    $bill->seat_label = $bill->tenghe ?: 'Chưa cập nhật';

                    return $bill;
                });

            $summary = [
                'total' => $bills->count(),
                'waiting' => $bills->whereIn('status_key', ['waiting', 'pending'])->count(),
                'done' => $bills->where('status_key', 'done')->count(),
                'amount' => (int) $bills->sum('tongsotien'),
            ];
        }

        return view('layouts.bill', compact('phone', 'account', 'bills', 'summary'));
    }
}
