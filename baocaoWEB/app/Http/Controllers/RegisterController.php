<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        // Kiểm tra xem file có tồn tại không
        if (!view()->exists('register')) {
            // Nếu không tìm thấy, thử với đường dẫn auth.login
            return view('auth.register');
        }
    }
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'fullName' => 'required|string|min:3|max:255',
            'phone' => 'required|string|regex:/^(0[3|5|7|8|9])+([0-9]{8})$/',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'fullName.required' => 'Vui lòng nhập họ và tên',
            'fullName.min' => 'Họ và tên phải có ít nhất 3 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ]);

        try {
            $supabaseUrl = env('SUPABASE_URL');
            $supabaseKey = env('SUPABASE_ANON_KEY');

            if (!$supabaseUrl || !$supabaseKey) {
                Log::error('Supabase configuration missing');
                return back()->withErrors(['Lỗi cấu hình hệ thống. Vui lòng liên hệ quản trị viên!'])->withInput();
            }

            // Kiểm tra số điện thoại đã tồn tại chưa
            $checkResponse = Http::withHeaders([
                'apikey' => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
            ])->get($supabaseUrl . '/rest/v1/taiKhoan', [
                'username' => 'eq.' . $request->phone,
                'select' => 'username',
            ]);

            if ($checkResponse->successful() && !empty($checkResponse->json())) {
                return back()->withErrors(['Số điện thoại này đã được đăng ký!'])->withInput();
            }

            // Tạo user mới
            $response = Http::withHeaders([
                'apikey' => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
                'Content-Type' => 'application/json',
                'Prefer' => 'return=minimal',
            ])->post($supabaseUrl . '/rest/v1/taiKhoan', [
                'username' => $request->phone,
                'password' => $request->password,
                'fullName' => $request->fullName,
                'email' => $request->email,
                'role' => 'user',
                'created_at' => now()->toDateTimeString(),
            ]);

            if ($response->successful()) {
                return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
            }

            $errorBody = $response->body();
            Log::error('Register error: ' . $errorBody);

            if ($response->status() === 409) {
                return back()->withErrors(['Số điện thoại đã tồn tại trong hệ thống!'])->withInput();
            }

            return back()->withErrors(['Đăng ký thất bại. Vui lòng thử lại sau!'])->withInput();
        } catch (\Exception $e) {
            Log::error('Register exception: ' . $e->getMessage());
            return back()->withErrors(['Lỗi kết nối hệ thống. Vui lòng thử lại sau!'])->withInput();
        }
    }
}
