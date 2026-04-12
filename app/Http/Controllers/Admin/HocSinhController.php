<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HocSinh;
use App\Models\TaiKhoan;
use App\Models\VaiTro;
use App\Models\LopHoc;
use Illuminate\Support\Facades\Hash;

class HocSinhController extends Controller
{
    public function index()
    {
        $hocsinhs = HocSinh::with(['taiKhoan', 'lop'])->paginate(10);
        return view('backend.admin.hocsinh.index', compact('hocsinhs'));
    }

    public function create()
    {
        $lophocs = LopHoc::all();
        return view('backend.admin.hocsinh.create', compact('lophocs'));
    }

   public function store(Request $request)
    {
        $request->validate([
            'ma_hoc_sinh' => 'required|unique:hoc_sinh,ma_hoc_sinh',
            'ho_ten' => 'required|string|max:255',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|in:0,1',
            'lop_id' => 'required|exists:lop_hoc,id',
            'dia_chi' => 'nullable|string|max:255',
            'sdt_phu_huynh' => 'nullable|string|max:20',
        ]);

        // 1. Tạo tài khoản trước
        $taiKhoan = \App\Models\TaiKhoan::create([
            'ten_dang_nhap' => $request->ma_hoc_sinh,
            'mat_khau' => \Illuminate\Support\Facades\Hash::make('123456'), // Pass mặc định
            'vai_tro_id' => 3, // 3 là Role Học Sinh
        ]);

        // 2. Tạo Học sinh
        \App\Models\HocSinh::create([
            'ma_hoc_sinh' => $request->ma_hoc_sinh,
            'ho_ten' => $request->ho_ten,
            'ngay_sinh' => $request->ngay_sinh,
            'gioi_tinh' => $request->gioi_tinh,
            'dia_chi' => $request->dia_chi,
            'sdt_phu_huynh' => $request->sdt_phu_huynh,
            'lop_id' => $request->lop_id,
            'tai_khoan_id' => $taiKhoan->id,
        ]);

        return redirect()->route('admin.hocsinh.index')->with('success', 'Thêm học sinh thành công!');
    }

    public function edit($id)
    {
        $hocsinh = HocSinh::with('taiKhoan')->findOrFail($id);
        $lophocs = LopHoc::all();
        return view('backend.admin.hocsinh.edit', compact('hocsinh', 'lophocs'));
    }

    public function update(Request $request, $id)
    {
        $hocsinh = HocSinh::findOrFail($id);
        
        $request->validate([
            'ma_hoc_sinh' => 'required|string|unique:hoc_sinh,ma_hoc_sinh,' . $id,
            'ho_ten' => 'required|string|max:255',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|in:0,1',
            'lop_id' => 'required|exists:lop_hoc,id',
            'dia_chi' => 'nullable|string|max:255',
            'sdt_phu_huynh' => 'nullable|string|max:20',
            'trang_thai' => 'boolean'
        ]);

        $hocsinh->update([
            'ma_hoc_sinh' => $request->ma_hoc_sinh,
            'ho_ten' => $request->ho_ten,
            'ngay_sinh' => $request->ngay_sinh,
            'gioi_tinh' => $request->gioi_tinh,
            'dia_chi' => $request->dia_chi,
            'sdt_phu_huynh' => $request->sdt_phu_huynh,
            'lop_id' => $request->lop_id,
        ]);

        // Cập nhật trạng thái tài khoản và đổi tên đăng nhập nếu mã HS thay đổi
        if ($hocsinh->taiKhoan) {
            $hocsinh->taiKhoan->update([
                'ten_dang_nhap' => $request->ma_hoc_sinh,
                'trang_thai' => $request->trang_thai ?? true
            ]);
            
            // Nếu có nhập mật khẩu mới thì đổi mật khẩu
            if ($request->filled('mat_khau')) {
                $hocsinh->taiKhoan->update([
                    'mat_khau' => \Illuminate\Support\Facades\Hash::make($request->mat_khau)
                ]);
            }
        }

        return redirect()->route('admin.hocsinh.index')
            ->with('success', 'Cập nhật học sinh thành công');
    }

    public function destroy($id)
    {
        $hocSinh = \App\Models\HocSinh::findOrFail($id);
        
        $diemDaNhap = \App\Models\BangDiem::where('hoc_sinh_id', $hocSinh->id)->first();
        if ($diemDaNhap) {
            return redirect()->route('admin.hocsinh.index')
                ->with('error', 'Không thể xóa! Học sinh này đã có điểm trên hệ thống. Bạn cần phải xóa hết điểm của học sinh này trước.');
        }

        // 2. Lưu lại ID tài khoản trước khi xóa học sinh
        $taiKhoanId = $hocSinh->tai_khoan_id;
        
        // 3. Xóa học sinh trước (từ ngọn)
        $hocSinh->delete();

        // 4. Xóa tài khoản đăng nhập sau (tới gốc)
        if ($taiKhoanId) {
            $taiKhoan = \App\Models\TaiKhoan::find($taiKhoanId);
            if ($taiKhoan) {
                $taiKhoan->delete();
            }
        }

        return redirect()->route('admin.hocsinh.index')->with('success', 'Đã xóa thành công học sinh và tài khoản liên kết.');
    }

    public function show($id)
    {
        $hocsinh = \App\Models\HocSinh::with([
            'taiKhoan', 
            'lop', 
            'bangDiems.hocKy', 
            'bangDiems.monHoc', 
            'bangDiems.loaiDiem'
        ])->findOrFail($id);
        
        return view('backend.admin.hocsinh.show', compact('hocsinh'));
    }
}