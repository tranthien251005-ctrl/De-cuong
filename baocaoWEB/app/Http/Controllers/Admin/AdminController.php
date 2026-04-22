<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use App\Models\Xe;
use App\Models\TuyenXe;
use App\Models\ChuyenXe;
use App\Models\Ve;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalUsers = TaiKhoan::count();
        $totalAdmins = TaiKhoan::where('role', 'admin')->count();
        $totalDrivers = TaiKhoan::where('role', 'tai_xe')->count();
        $totalCustomers = TaiKhoan::where('role', 'khach_hang')->count();
        $totalBuses = Xe::count();
        $totalRoutes = TuyenXe::count();
        $totalTickets = Ve::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalDrivers',
            'totalCustomers',
            'totalBuses',
            'totalRoutes',
            'totalTickets'
        ));
    }


    // ========== QUẢN LÝ NGƯỜI DÙNG ==========


    // Hiển thị danh sách người dùng
    public function users()
    {
        try {
            // Lấy tất cả người dùng, sắp xếp theo ID (asc: tăng dần, desc: giảm dần)
            $users = TaiKhoan::orderBy('id', 'asc')->get();
            return view('admin.users', compact('users'));
        } catch (\Exception $e) {
            Log::error('Admin users error: ' . $e->getMessage());
            $users = [];
            return view('admin.users', compact('users'));
        }
    }

    // Hiển thị form thêm người dùng
    public function createUser()
    {
        return view('admin.users-create');
    }

    // Lưu người dùng mới
    public function storeUser(Request $request)
    {
        $request->validate([
            'hoten' => 'required|string|max:255',
            'phone' => 'required|string|unique:taikhoan,phone',
            'email' => 'nullable|email|unique:taikhoan,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,tai_xe,khach_hang',
        ], [
            'hoten.required' => 'Vui lòng nhập họ tên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        try {
            TaiKhoan::create([
                'hoten' => $request->hoten,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);

            return redirect()->route('admin.users')->with('success', 'Thêm người dùng thành công!');
        } catch (\Exception $e) {
            Log::error('Store user error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()])->withInput();
        }
    }

    // Cập nhật người dùng
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'hoten' => 'required|string|max:255',
            'phone' => 'required|string|unique:taikhoan,phone,' . $id,
            'email' => 'nullable|email|unique:taikhoan,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,tai_xe,khach_hang',
        ]);
        try {
            $user = TaiKhoan::findOrFail($id);
            $user->update([
                'hoten' => $request->hoten,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => $request->password ? $request->password : $user->password,
                'role' => $request->role,
            ]);

            return redirect()->route('admin.users')->with('success', 'Cập nhật người dùng thành công!');
        } catch (\Exception $e) {
            Log::error('Update user error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()])->withInput();
        }
    }
    // Xóa người dùng
    public function deleteUser($id)
    {
        try {
            $user = TaiKhoan::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.users')->with('success', 'Xóa người dùng thành công!');
        } catch (\Exception $e) {
            Log::error('Delete user error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()]);
        }
    }

    // Lấy thông tin theo ID
    public function getUser($id)
    {
        try {
            $user = TaiKhoan::findOrFail($id);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không tìm thấy người dùng'], 404);
        }
    }


    // ========== QUẢN LÝ XE ==========


    // Hiển thị danh sách xe
    public function buses()
    {
        try {
            $buses = Xe::orderBy('maxe', 'asc')->get();
            return view('admin.buses', compact('buses'));
        } catch (\Exception $e) {
            Log::error('Admin buses error: ' . $e->getMessage());
            $buses = [];
            return view('admin.buses', compact('buses'));
        }
    }

    // Thêm xe mới
    public function storeBus(Request $request)
    {
        $request->validate([
            'biensoxe' => 'required|string|unique:xe,biensoxe',
            'loaixe' => 'required|string',
            'soghe' => 'required|integer|min:1',
            'nhaxe' => 'required|string',
            'trangthai' => 'required|in:Đang hoạt động,Bảo trì,Ngừng hoạt động',
        ], [
            'biensoxe.required' => 'Vui lòng nhập biển số xe',
            'biensoxe.unique' => 'Biển số xe đã tồn tại',
            'loaixe.required' => 'Vui lòng chọn loại xe',
            'soghe.required' => 'Vui lòng nhập số ghế',
            'soghe.min' => 'Số ghế phải lớn hơn 0',
            'nhaxe.required' => 'Vui lòng nhập tên nhà xe',
        ]);

        try {
            Xe::create([
                'biensoxe' => $request->biensoxe,
                'loaixe' => $request->loaixe,
                'soghe' => $request->soghe,
                'nhaxe' => $request->nhaxe,
                'trangthai' => $request->trangthai,
            ]);

            return redirect()->route('admin.buses')->with('success', 'Thêm xe thành công!');
        } catch (\Exception $e) {
            Log::error('Store bus error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()])->withInput();
        }
    }

    // Cập nhật xe
    public function updateBus(Request $request, $id)
    {
        $request->validate([
            'biensoxe' => 'required|string|unique:xe,biensoxe,' . $id . ',maxe',
            'loaixe' => 'required|string',
            'soghe' => 'required|integer|min:1',
            'nhaxe' => 'required|string',
            'trangthai' => 'required|in:Đang hoạt động,Bảo trì,Ngừng hoạt động',
        ]);

        try {
            $bus = Xe::findOrFail($id);
            $bus->update([
                'biensoxe' => $request->biensoxe,
                'loaixe' => $request->loaixe,
                'soghe' => $request->soghe,
                'nhaxe' => $request->nhaxe,
                'trangthai' => $request->trangthai,
            ]);

            return redirect()->route('admin.buses')->with('success', 'Cập nhật xe thành công!');
        } catch (\Exception $e) {
            Log::error('Update bus error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()])->withInput();
        }
    }

    // Xóa xe
    public function deleteBus($id)
    {
        try {
            // Xóa tất cả liên quan trước
            ChuyenXe::where('maxe', $id)->delete();
            TuyenXe::where('maxe', $id)->update(['maxe' => null]);

            // Cuối cùng xóa xe
            Xe::destroy($id);

            return redirect()->route('admin.buses')->with('success', 'Xóa xe thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['Lỗi: ' . $e->getMessage()]);
        }
    }

    // Lấy thông tin xe theo ID (cho modal sửa)
    public function getBus($id)
    {
        try {
            $bus = Xe::findOrFail($id);
            return response()->json($bus);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không tìm thấy xe'], 404);
        }
    }


    // ========== QUẢN LÝ TUYẾN XE ==========


    // Quản lý tuyến - Hiển thị danh sách
    public function routes()
    {
        try {
            $routes = TuyenXe::with('xe')
                ->orderBy('matuyen', 'asc')
                ->get();
            $buses = Xe::where('trangthai', 'Đang hoạt động')->get();
            return view('admin.routes', compact('routes', 'buses'));
        } catch (\Exception $e) {
            Log::error('Admin routes error: ' . $e->getMessage());
            $routes = [];
            $buses = [];
            return view('admin.routes', compact('routes', 'buses'));
        }
    }

    // Thêm tuyến mới
    public function storeRoute(Request $request)
    {
        $request->validate([
            'diemdi' => 'required|string|max:255',
            'diemden' => 'required|string|max:255',
            'khoangcach' => 'required|numeric|min:0',
            'thoigian' => 'required|string|max:50',
            'giatien' => 'required|numeric|min:0',
            'trangthai' => 'required|in:Đang hoạt động,Ngừng hoạt động',
            'maxe' => 'nullable|exists:xe,maxe',
        ], [
            'diemdi.required' => 'Vui lòng nhập điểm đi',
            'diemden.required' => 'Vui lòng nhập điểm đến',
            'khoangcach.required' => 'Vui lòng nhập khoảng cách',
            'thoigian.required' => 'Vui lòng nhập thời gian',
            'giatien.required' => 'Vui lòng nhập giá tiền',
            'maxe.exists' => 'Xe không tồn tại',
        ]);

        try {
            $tenTuyen = trim($request->diemdi . ' - ' . $request->diemden);

            $route = TuyenXe::create([
                'tentuyen' => $tenTuyen,
                'diemdi' => $request->diemdi,
                'diemden' => $request->diemden,
                'khoangcach' => $request->khoangcach,
                'thoigiandukien' => $request->thoigian,
                'giatien' => $request->giatien,
                'trangthai' => $request->trangthai,
                'maxe' => $request->maxe,
            ]);

            return redirect()->route('admin.routes')->with('success', 'Thêm tuyến thành công!');
        } catch (\Exception $e) {
            Log::error('Store route error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()])->withInput();
        }
    }

    // Cập nhật tuyến
    public function updateRoute(Request $request, $id)
    {
        $request->validate([
            'diemdi' => 'required|string|max:255',
            'diemden' => 'required|string|max:255',
            'khoangcach' => 'required|numeric|min:0',
            'thoigian' => 'required|string|max:50',
            'giatien' => 'required|numeric|min:0',
            'trangthai' => 'required|in:Đang hoạt động,Ngừng hoạt động',
            'maxe' => 'nullable|exists:xe,maxe',
        ]);

        try {
            $route = TuyenXe::findOrFail($id);
            $tenTuyen = trim($request->diemdi . ' - ' . $request->diemden);

            $route->update([
                'tentuyen' => $tenTuyen,
                'diemdi' => $request->diemdi,
                'diemden' => $request->diemden,
                'khoangcach' => $request->khoangcach,
                'thoigiandukien' => $request->thoigian,
                'giatien' => $request->giatien,
                'trangthai' => $request->trangthai,
                'maxe' => $request->maxe,
            ]);

            return redirect()->route('admin.routes')->with('success', 'Cập nhật tuyến thành công!');
        } catch (\Exception $e) {
            Log::error('Update route error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()])->withInput();
        }
    }

    // Xóa tuyến
    public function deleteRoute($id)
    {
        try {
            $route = TuyenXe::findOrFail($id);

            // Kiểm tra nếu tuyến đang có chuyến xe thì không cho xóa
            if ($route->chuyenXes && $route->chuyenXes->count() > 0) {
                return back()->withErrors(['Không thể xóa tuyến này vì đang có chuyến xe liên quan!']);
            }

            $route->delete();
            return redirect()->route('admin.routes')->with('success', 'Xóa tuyến thành công!');
        } catch (\Exception $e) {
            Log::error('Delete route error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()]);
        }
    }

    // Lấy thông tin tuyến theo ID
    public function getRoute($id)
    {
        try {
            $route = TuyenXe::with('xe')->findOrFail($id);
            return response()->json($route);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không tìm thấy tuyến'], 404);
        }
    }


    // ========== QUẢN LÝ CHUYẾN XE ==========


    public function trips()
    {
        try {
            $trips = ChuyenXe::with(['tuyenXe', 'xe'])
                ->orderBy('machuyen', 'asc')
                ->get();
            $routes = TuyenXe::where('trangthai', 'Đang hoạt động')->get();
            $buses = Xe::where('trangthai', 'Đang hoạt động')->get();
            return view('admin.trips', compact('trips', 'routes', 'buses'));
        } catch (\Exception $e) {
            Log::error('Admin trips error: ' . $e->getMessage());
            $trips = [];
            $routes = [];
            $buses = [];
            return view('admin.trips', compact('trips', 'routes', 'buses'));
        }
    }

    // Thêm chuyến mới
    public function storeTrip(Request $request)
    {
        $request->validate([
            'matuyen' => 'required|exists:tuyenxe,matuyen',
            'maxe' => 'required|exists:xe,maxe',
            'ngaydi' => 'required|date',
            'giodi' => 'required',
            'giave' => 'required|numeric|min:0',
            'ghe_trong' => 'required|numeric|min:0',
        ]);

        try {
            ChuyenXe::create($request->all());
            return redirect()->route('admin.trips')->with('success', 'Thêm chuyến thành công!');
        } catch (\Exception $e) {
            Log::error('Store trip error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()])->withInput();
        }
    }

    // Cập nhật chuyến
    public function updateTrip(Request $request, $id)
    {
        $request->validate([
            'matuyen' => 'required|exists:tuyenxe,matuyen',
            'maxe' => 'required|exists:xe,maxe',
            'ngaydi' => 'required|date',
            'giodi' => 'required',
            'giave' => 'required|numeric|min:0',
            'ghe_trong' => 'required|numeric|min:0',
        ]);

        try {
            $trip = ChuyenXe::findOrFail($id);
            $trip->update($request->all());
            return redirect()->route('admin.trips')->with('success', 'Cập nhật chuyến thành công!');
        } catch (\Exception $e) {
            Log::error('Update trip error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()])->withInput();
        }
    }

    // Xóa chuyến
    public function deleteTrip($id)
    {
        try {
            $trip = ChuyenXe::findOrFail($id);
            $trip->delete();
            return redirect()->route('admin.trips')->with('success', 'Xóa chuyến thành công!');
        } catch (\Exception $e) {
            Log::error('Delete trip error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()]);
        }
    }

    // Lấy thông tin chuyến theo ID
    public function getTrip($id)
    {
        try {
            $trip = ChuyenXe::with(['tuyenXe', 'xe'])->findOrFail($id);
            return response()->json($trip);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không tìm thấy chuyến'], 404);
        }
    }


    // ========== QUẢN LÝ VÉ ==========


    // Hiển thị danh sách vé
    public function tickets()
    {
        try {
            $tickets = Ve::with(['ghe', 'taiKhoan'])
                ->orderBy('mave', 'asc')
                ->get();

            // Thống kê
            $totalTickets = $tickets->count();
            $totalRevenue = $tickets->sum('tongsotien');
            $daThanhToan = $tickets->where('trangthai', 'da_thanh_toan')->count();
            $choThanhToan = $tickets->where('trangthai', 'cho_thanh_toan')->count();

            return view('admin.tickets', compact('tickets', 'totalTickets', 'totalRevenue', 'daThanhToan', 'choThanhToan'));
        } catch (\Exception $e) {
            Log::error('Admin tickets error: ' . $e->getMessage());
            $tickets = [];
            $totalTickets = 0;
            $totalRevenue = 0;
            $daThanhToan = 0;
            $choThanhToan = 0;
            return view('admin.tickets', compact('tickets', 'totalTickets', 'totalRevenue', 'daThanhToan', 'choThanhToan'));
        }
    }

    // Cập nhật trạng thái vé
    public function updateTicketStatus(Request $request, $id)
    {
        $request->validate([
            'trangthai' => 'required|in:cho_thanh_toan,da_thanh_toan,da_huy',
        ]);

        try {
            $ticket = Ve::findOrFail($id);
            $ticket->update([
                'trangthai' => $request->trangthai,
            ]);

            return redirect()->route('admin.tickets')->with('success', 'Cập nhật trạng thái vé thành công!');
        } catch (\Exception $e) {
            Log::error('Update ticket status error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()]);
        }
    }

    // Xóa vé
    public function deleteTicket($id)
    {
        try {
            $ticket = Ve::findOrFail($id);
            $ticket->delete();
            return redirect()->route('admin.tickets')->with('success', 'Xóa vé thành công!');
        } catch (\Exception $e) {
            Log::error('Delete ticket error: ' . $e->getMessage());
            return back()->withErrors(['Lỗi: ' . $e->getMessage()]);
        }
    }

    // Lấy thông tin vé theo ID
    public function getTicket($id)
    {
        try {
            $ticket = Ve::with(['ghe', 'taiKhoan'])->findOrFail($id);
            return response()->json($ticket);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không tìm thấy vé'], 404);
        }
    }

    // Xuất báo cáo vé (Excel)
    public function exportTickets()
    {
        // TODO: Implement export to Excel
        return redirect()->back()->with('success', 'Chức năng đang phát triển!');
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
        // Lấy dữ liệu thống kê
        $totalRevenue = Ve::sum('tongsotien');
        $totalTickets = Ve::count();
        $totalUsers = TaiKhoan::count();
        $recentTickets = Ve::orderBy('ngaydat', 'asc')->limit(10)->get();

        return view('admin.reports', compact('totalRevenue', 'totalTickets', 'totalUsers', 'recentTickets'));
    }

    // Cài đặt hệ thống
    public function settings()
    {
        return view('admin.settings');
    }
}
