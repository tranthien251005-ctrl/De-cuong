<?php

namespace App\Http\Controllers;

use App\Models\TuyenXe;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $filterOptions = collect();
        $tuyenXes = collect();
        $dbError = null;

        try {
            $filterOptions = TuyenXe::query()
                ->orderBy('diemdi')
                ->orderBy('diemden')
                ->get();

            $query = TuyenXe::query();

            if ($request->filled('from')) {
                $query->where('diemdi', $request->from);
            }

            if ($request->filled('to')) {
                $query->where('diemden', $request->to);
            }

            if ($request->filled('duration')) {
                $query->where('thoigiandukien', $request->duration);
            }

            $tuyenXes = $query->get();
        } catch (QueryException $exception) {
            $dbError = 'Hiện chưa thể kết nối cơ sở dữ liệu để tải danh sách tuyến xe. Vui lòng kiểm tra lại cấu hình mạng hoặc kết nối Supabase.';
        }

        return view('layouts.home', compact('tuyenXes', 'filterOptions', 'dbError'));
    }
}
