<?php

namespace App\Http\Controllers;

use App\Models\Ghe;
use App\Models\TuyenXe;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index($matuyen)
    {
        $tuyen = TuyenXe::findOrFail($matuyen);

        $ghes = Ghe::where('maxe', $tuyen->maxe)->get();
        $ghes = $ghes->sortBy(function ($ghe) {
            preg_match('/(\d+)/', (string) $ghe->tenghe, $matches);
            return (int) ($matches[0] ?? 0);
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

