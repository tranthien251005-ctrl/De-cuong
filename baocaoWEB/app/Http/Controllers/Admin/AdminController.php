<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Quản lý người dùng
    public function users()
    {
        try {
            $supabaseUrl = env('SUPABASE_URL');
            $supabaseKey = env('SUPABASE_ANON_KEY');

            $response = Http::withHeaders([
                'apikey' => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
            ])->get($supabaseUrl . '/rest/v1/taiKhoan', [
                'select' => '*',
                'order' => 'created_at.desc',
            ]);

            $users = $response->successful() ? $response->json() : [];

            return view('admin.users', compact('users'));
        } catch (\Exception $e) {
            Log::error('Admin users error: ' . $e->getMessage());
            $users = [];
            return view('admin.users', compact('users'));
        }
    }

    public function createUser()
    {
        return view('admin.users-create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
            'fullName' => 'required|string',
            'email' => 'nullable|email',
            'role' => 'required|in:user,admin',
        ]);

        try {
            $supabaseUrl = env('SUPABASE_URL');
            $supabaseKey = env('SUPABASE_ANON_KEY');

            $response = Http::withHeaders([
                'apikey' => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
                'Content-Type' => 'application/json',
            ])->post($supabaseUrl . '/rest/v1/taiKhoan', [
                'username' => $request->username,
                'password' => $request->password,
                'fullName' => $request->fullName,
                'email' => $request->email,
                'role' => $request->role,
                'created_at' => now()->toDateTimeString(),
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.users')->with('success', 'Thêm người dùng thành công!');
            }

            return back()->withErrors(['Thêm người dùng thất bại!'])->withInput();
        } catch (\Exception $e) {
            Log::error('Store user error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi hệ thống!'])->withInput();
        }
    }

    public function deleteUser($id)
    {
        try {
            $supabaseUrl = env('SUPABASE_URL');
            $supabaseKey = env('SUPABASE_ANON_KEY');

            $response = Http::withHeaders([
                'apikey' => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
            ])->delete($supabaseUrl . '/rest/v1/taiKhoan', [
                'id' => 'eq.' . $id,
            ]);

            if ($response->successful()) {
                return redirect()->route('admin.users')->with('success', 'Xóa người dùng thành công!');
            }

            return back()->withErrors(['Xóa người dùng thất bại!']);
        } catch (\Exception $e) {
            Log::error('Delete user error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi hệ thống!']);
        }
    }

    // Quản lý xe
    public function buses()
    {
        return view('admin.buses');
    }

    // Quản lý tuyến
    public function routes()
    {
        return view('admin.routes');
    }

    // Quản lý chuyến
    public function trips()
    {
        return view('admin.trips');
    }

    // Quản lý vé
    public function tickets()
    {
        return view('admin.tickets');
    }

    // Quản lý thanh toán
    public function payments()
    {
        return view('admin.payments');
    }

    // Khuyến mãi
    public function promotions()
    {
        return view('admin.promotions');
    }

    // Báo cáo thống kê
    public function reports()
    {
        return view('admin.reports');
    }

    // Cài đặt hệ thống
    public function settings()
    {
        return view('admin.settings');
    }
}
