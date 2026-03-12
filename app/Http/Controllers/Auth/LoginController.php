<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'ten_dang_nhap' => 'required|string',
            'mat_khau' => 'required|string'
        ]);

        // Thử đăng nhập với trạng thái active
        if (Auth::attempt([
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'password' => $request->mat_khau,
            'trang_thai' => 1
        ], $request->filled('remember'))) {
            
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Chuyển hướng dựa trên vai trò
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->isGiaoVien()) {
                return redirect()->intended(route('giaovien.dashboard'));
            } elseif ($user->isHocSinh()) {
                return redirect()->intended(route('hocsinh.dashboard'));
            }
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'ten_dang_nhap' => 'Thông tin đăng nhập không chính xác hoặc tài khoản đã bị khóa.',
        ])->onlyInput('ten_dang_nhap');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}