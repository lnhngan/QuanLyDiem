<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Kiểm tra quyền dựa vào tham số
        switch ($role) {
            case 'admin':
                if (!$user->isAdmin()) {
                    abort(403, 'Bạn không có quyền truy cập trang này.');
                }
                break;
            case 'giaovien':
                if (!$user->isGiaoVien()) {
                    abort(403, 'Bạn không có quyền truy cập trang này.');
                }
                break;
            case 'hocsinh':
                if (!$user->isHocSinh()) {
                    abort(403, 'Bạn không có quyền truy cập trang này.');
                }
                break;
            default:
                abort(403, 'Quyền không hợp lệ.');
        }

        return $next($request);
    }
}