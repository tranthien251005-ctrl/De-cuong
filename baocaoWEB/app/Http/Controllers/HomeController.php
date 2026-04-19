<?php

namespace App\Http\Controllers;

use App\Models\TuyenXe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = TuyenXe::query();

        if ($request->filled('from')) {
            $query->where('diemdi', $request->from);
        }

        if ($request->filled('to')) {
            $query->where('diemden', $request->to);
        }

        if ($request->filled('time')) {
            $query->where('giodi', $request->time);
        }

        $tuyenXes = $query->get();

        return view('layouts.home', compact('tuyenXes'));
    }
}

