<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Hiển thị trang Hồ sơ (Profile)
     */
    public function index()
    {
        $user = Auth::user();
        $thongTin = null;
        $role = '';

        if ($user->isAdmin()) {
            $role = 'Admin';
            // Thêm thông tin riêng cho admin nếu cần
        } elseif ($user->isGiaoVien()) {
            $role = 'Giáo viên';
            $thongTin = $user->giaoVien;
        } elseif ($user->isHocSinh()) {
            $role = 'Học sinh';
            $thongTin = $user->hocSinh;
        }

        return view('profile.index', compact('user', 'thongTin', 'role'));
    }

    /**
     * Hiển thị trang Cài đặt (Đổi mật khẩu)
     */
    public function settings()
    {
        return view('profile.settings');
    }

    /**
     * Xử lý cập nhật mật khẩu
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại có đúng không
        if (!Hash::check($request->current_password, $user->mat_khau)) {
            throw ValidationException::withMessages([
                'current_password' => 'Mật khẩu hiện tại không đúng.',
            ]);
        }

        // Cập nhật mật khẩu mới
        $user->mat_khau = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.settings')->with('success', 'Mật khẩu đã được cập nhật thành công!');
    }
}