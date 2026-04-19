<?php

namespace App\Http\Controllers;

use App\Models\TuyenXe;
use App\Models\Ghe;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index($matuyen)
    {
        // Lấy thông tin tuyến xe
        $tuyen = TuyenXe::findOrFail($matuyen);
        
        // Lấy danh sách ghế
        $ghes = Ghe::where('maxe', $tuyen->maxe)->get();
        
        // Sắp xếp ghế theo số thứ tự trong tên (A1, A2, A3...)
        $ghes = $ghes->sortBy(function($ghe) {
            preg_match('/(\d+)/', $ghe->tenghe, $matches);
            return (int)($matches[0] ?? 0);
        });
        
        return view('layouts.byticket', compact('tuyen', 'ghes'));
    }

    public function byticket(Request $request, $matuyen = null)
    {
        $matuyen = $matuyen ?? $request->query('matuyen');
        if (!$matuyen) {
            return redirect()->route('home');
        }

        return $this->index($matuyen);
    }
}
