<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Kiểm tra đã đăng nhập chưa
        if (!session()->has('isLoggedIn')) {
            return redirect('/login')->withErrors(['Vui lòng đăng nhập!']);
        }

        // Kiểm tra role có được phép không
        $userRole = session('userRole', 'user');

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Không có quyền truy cập
        abort(403, 'Bạn không có quyền truy cập trang này!');
    }
}
