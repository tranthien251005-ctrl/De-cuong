<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'full_name' => 'required|string|min:3|max:255',
            'phone' => 'required|string|regex:/^0[0-9]{9}$/|unique:users,phone',
            'email' => 'nullable|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên',
            'full_name.min' => 'Họ và tên phải có ít nhất 3 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ (phải bắt đầu bằng 03, 05, 07, 08, 09 và có 10 số)',
            'phone.unique' => 'Số điện thoại đã được đăng ký',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ]);

        try {
            // Tạo user mới trong bảng users
            $user = User::create([
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'khach_hang',
            ]);

            if ($user) {
                return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
            }

            return back()->withErrors(['Đăng ký thất bại. Vui lòng thử lại!'])->withInput();
        } catch (\Exception $e) {
            Log::error('Register exception: ' . $e->getMessage());
            return back()->withErrors(['Lỗi hệ thống: ' . $e->getMessage()])->withInput();
        }
    }
}
