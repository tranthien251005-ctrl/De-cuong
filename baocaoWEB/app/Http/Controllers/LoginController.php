<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Kiểm tra xem file có tồn tại không
        if (!view()->exists('login')) {
            // Nếu không tìm thấy, thử với đường dẫn auth.login
            return view('auth.login');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $phone = trim($request->phone);
        $password = $request->password;

        // Admin hardcoded
        if ($phone === 'admin' && $password === '12345678') {
            session([
                'isAdmin' => true,
                'userPhone' => 'admin',
                'userName' => 'Quản trị viên',
                'isLoggedIn' => true,
            ]);
            return redirect()->intended('/admin');
        }

        // Kiểm tra với Supabase
        try {
            $response = Http::withHeaders([
                'apikey' => env('SUPABASE_ANON_KEY'),
                'Authorization' => 'Bearer ' . env('SUPABASE_ANON_KEY'),
            ])->get(env('SUPABASE_URL') . '/rest/v1/taiKhoan', [
                'username' => 'eq.' . $phone,
                'select' => '*',
            ]);

            if ($response->successful()) {
                $users = $response->json();

                if (empty($users)) {
                    return back()->withErrors(['Số điện thoại chưa được đăng ký!'])->withInput();
                }

                $user = $users[0];

                if ($user['password'] === $password) {
                    session([
                        'isAdmin' => ($user['role'] ?? 'user') === 'admin',
                        'userPhone' => $phone,
                        'userName' => $user['fullName'] ?? 'Khách hàng',
                        'userId' => $user['id'] ?? null,
                        'isLoggedIn' => true,
                    ]);

                    return redirect()->intended('/');
                }

                return back()->withErrors(['Mật khẩu không chính xác!'])->withInput();
            }

            Log::error('Supabase error: ' . $response->body());
            return back()->withErrors(['Lỗi kết nối hệ thống. Vui lòng thử lại!'])->withInput();
        } catch (\Exception $e) {
            Log::error('Login exception: ' . $e->getMessage());
            return back()->withErrors(['Lỗi kết nối hệ thống. Vui lòng thử lại!'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/login');
    }
}
