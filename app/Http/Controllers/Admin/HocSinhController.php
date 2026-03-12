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
            'ma_hoc_sinh' => 'required|string|unique:hoc_sinh',
            'ho_ten' => 'required|string|max:255',
            'ngay_sinh' => 'required|date',
            'lop_id' => 'required|exists:lop_hoc,id',
            'ten_dang_nhap' => 'required|string|unique:tai_khoan,ten_dang_nhap',
            'mat_khau' => 'required|string|min:6',
        ]);

        // Tạo tài khoản
        $vaiTroHocSinh = VaiTro::where('ten_vai_tro', 'Học sinh')->first();
        
        $taiKhoan = TaiKhoan::create([
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'mat_khau' => Hash::make($request->mat_khau),
            'vai_tro_id' => $vaiTroHocSinh->id,
            'trang_thai' => true
        ]);

        // Tạo học sinh
        HocSinh::create([
            'tai_khoan_id' => $taiKhoan->id,
            'ma_hoc_sinh' => $request->ma_hoc_sinh,
            'ho_ten' => $request->ho_ten,
            'ngay_sinh' => $request->ngay_sinh,
            'lop_id' => $request->lop_id,
        ]);

        return redirect()->route('admin.hocsinh.index')
            ->with('success', 'Thêm học sinh thành công');
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
            'lop_id' => 'required|exists:lop_hoc,id',
            'trang_thai' => 'boolean'
        ]);

        $hocsinh->update([
            'ma_hoc_sinh' => $request->ma_hoc_sinh,
            'ho_ten' => $request->ho_ten,
            'ngay_sinh' => $request->ngay_sinh,
            'lop_id' => $request->lop_id,
        ]);

        // Cập nhật trạng thái tài khoản
        $hocsinh->taiKhoan->update([
            'trang_thai' => $request->trang_thai ?? true
        ]);

        return redirect()->route('admin.hocsinh.index')
            ->with('success', 'Cập nhật học sinh thành công');
    }

    public function destroy($id)
    {
        $hocsinh = HocSinh::findOrFail($id);
        
        // Xóa tài khoản liên quan
        $hocsinh->taiKhoan->delete();
        
        // Xóa học sinh
        $hocsinh->delete();

        return redirect()->route('admin.hocsinh.index')
            ->with('success', 'Xóa học sinh thành công');
    }
}