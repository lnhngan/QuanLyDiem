<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVien;
use App\Models\TaiKhoan;
use App\Models\VaiTro;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GiaoVienController extends Controller
{
    public function index()
    {
        $giaoviens = GiaoVien::with('taiKhoan')->paginate(10);
        return view('backend.admin.giaovien.index', compact('giaoviens'));
    }

    public function create()
    {
        return view('backend.admin.giaovien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_gv' => 'required|string|unique:giao_vien',
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|unique:giao_vien',
            'so_dien_thoai' => 'required|string|max:15',
            'ten_dang_nhap' => 'required|string|unique:tai_khoan,ten_dang_nhap',
            'mat_khau' => 'required|string|min:6',
        ]);

        // Tạo tài khoản
        $vaiTroGiaoVien = VaiTro::where('ten_vai_tro', 'Giáo viên')->first();
        
        $taiKhoan = TaiKhoan::create([
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'mat_khau' => Hash::make($request->mat_khau),
            'vai_tro_id' => $vaiTroGiaoVien->id,
            'trang_thai' => true
        ]);

        // Tạo giáo viên
        GiaoVien::create([
            'tai_khoan_id' => $taiKhoan->id,
            'ma_gv' => $request->ma_gv,
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
        ]);

        return redirect()->route('admin.giaovien.index')
            ->with('success', 'Thêm giáo viên thành công');
    }

    public function edit($id)
    {
        $giaovien = GiaoVien::with('taiKhoan')->findOrFail($id);
        return view('backend.admin.giaovien.edit', compact('giaovien'));
    }

    public function update(Request $request, $id)
    {
        $giaovien = GiaoVien::findOrFail($id);
        
        $request->validate([
            'ma_gv' => 'required|string|unique:giao_vien,ma_gv,' . $id, 
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|unique:giao_vien,email,' . $id,
            'so_dien_thoai' => 'required|string|max:15',
            'trang_thai' => 'boolean'
        ]);

        $giaovien->update([
            'ma_gv' => $request->ma_gv,
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
        ]);

        // Cập nhật trạng thái tài khoản
        $giaovien->taiKhoan->update([
            'trang_thai' => $request->trang_thai ?? true
        ]);

        return redirect()->route('admin.giaovien.index')
            ->with('success', 'Cập nhật giáo viên thành công');
    }

    public function destroy($id)
    {
        $giaoVien = \App\Models\GiaoVien::findOrFail($id);

        // 1. Kiểm tra: Có đang làm Giáo viên Chủ nhiệm không? (Bắt buộc giữ lại)
        $lopChuNhiem = \App\Models\LopHoc::where('gv_chu_nhiem_id', $giaoVien->id)->first();
        if ($lopChuNhiem) {
            return redirect()->route('admin.giaovien.index')
                ->with('error', 'Không thể thao tác! Giáo viên này đang làm chủ nhiệm lớp ' . $lopChuNhiem->ten_lop . '. Vui lòng đổi GVCN khác trước.');
        }

        // 2. Thu hồi toàn bộ lịch Phân công giảng dạy
        \App\Models\PhanCongGiangDay::where('giao_vien_id', $giaoVien->id)->delete();

        // 3. VÔ HIỆU HÓA TÀI KHOẢN ĐĂNG NHẬP (KHÔNG XÓA)
        $taiKhoan = \App\Models\TaiKhoan::find($giaoVien->tai_khoan_id);
        if ($taiKhoan) {
            // Đổi tên đăng nhập thành chuỗi ngẫu nhiên (ví dụ: disabled_gv001_12345)
            $taiKhoan->ten_dang_nhap = 'disabled_' . $taiKhoan->ten_dang_nhap . '_' . time();
            
            // Xóa sạch mật khẩu bằng một đoạn mã băm rác (Không ai có thể đoán được)
            $taiKhoan->mat_khau = \Illuminate\Support\Facades\Hash::make(Str::random(40));
            $taiKhoan->save();
        }

        // Đánh dấu tên giáo viên để Admin dễ nhận biết trên bảng điểm
        $giaoVien->ho_ten = '[Đã nghỉ] ' . $giaoVien->ho_ten;
        $giaoVien->save();

        return redirect()->route('admin.giaovien.index')
            ->with('success', 'Đã vô hiệu hóa tài khoản và thu hồi phân công của giáo viên. Toàn bộ điểm số giáo viên này từng chấm vẫn được giữ nguyên an toàn!');
    }
   public function show($id)
    {
        // Đổi $giaoVien thành $giaovien (v viết thường)
        $giaovien = \App\Models\GiaoVien::with('taiKhoan')->findOrFail($id);
        
        // Truyền compact('giaovien') để khớp với View
        return view('backend.admin.giaovien.show', compact('giaovien'));
    }
}
