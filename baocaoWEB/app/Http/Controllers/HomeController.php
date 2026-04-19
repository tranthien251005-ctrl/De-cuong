<?php
namespace App\Http\Controllers;
use App\Models\TuyenXe;

class HomeController extends Controller
{
    public function index()
    {
        $tuyenXes = TuyenXe::all();
        return view('layouts.home', compact('tuyenXes'));
    }
}