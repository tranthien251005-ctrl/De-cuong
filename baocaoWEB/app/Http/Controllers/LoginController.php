<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Vì file nằm trong thư mục auth
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $phone = trim($request->phone);
        $password = $request->password;

        // Admin hardcoded (tạm thời cho phát triển)
        if ($phone === 'admin' && $password === '12345678') {
            session([
                'isAdmin' => true,
                'userRole' => 'admin',
                'userPhone' => 'admin',
                'userName' => 'Quản trị viên',
                'isLoggedIn' => true,
            ]);
            return redirect()->intended('/admin');
        }

        try {
            // Tìm user theo số điện thoại
            $user = User::where('phone', $phone)->first();

            if (!$user) {
                return back()->withErrors(['Số điện thoại chưa được đăng ký!'])->withInput();
            }

            // Kiểm tra mật khẩu
            if ($user->password !== $password) {
                return back()->withErrors(['Mật khẩu không chính xác!'])->withInput();
            }

            $role = $user->role ?? 'khach_hang';

            // Lưu session
            session([
                'isAdmin' => $role === 'admin',
                'userRole' => $role,
                'userPhone' => $user->phone,
                'userName' => $user->full_name ?? $user->phone,
                'userFullName' => $user->full_name,
                'userId' => $user->id,
                'isLoggedIn' => true,
            ]);

            // Chuyển hướng theo role
            if ($role === 'admin') {
                return redirect()->intended('/admin');
            }

            // Tài xế và khách hàng đều về trang chủ
            return redirect()->intended('/');
        } catch (\Exception $e) {
            Log::error('Login exception: ' . $e->getMessage());
            return back()->withErrors(['Lỗi hệ thống, vui lòng thử lại sau!'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/login');
    }
}
