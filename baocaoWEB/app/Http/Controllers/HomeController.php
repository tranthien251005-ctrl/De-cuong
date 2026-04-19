<?php

namespace App\Http\Controllers;

use App\Models\TuyenXe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = TuyenXe::query();

        // Lọc theo điểm đi
        if ($request->filled('from')) {
            $query->where('diemdi', $request->from);
        }

        // Lọc theo điểm đến
        if ($request->filled('to')) {
            $query->where('diemden', $request->to);
        }

        // Lọc theo giờ đi
        if ($request->filled('time')) {
            $query->where('giodi', $request->time);
        }

        $tuyenXes = $query->get();

        return view('layouts.home', compact('tuyenXes'));
    }
}
