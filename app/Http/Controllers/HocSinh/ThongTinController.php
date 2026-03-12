<?php

namespace App\Http\Controllers\HocSinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GiaoVien;
use App\Models\PhanCongGiangDay;

class ThongTinController extends Controller
{
    public function caNhan()
    {
        $hocSinh = Auth::user()->hocSinh;
        
        return view('backend.hocsinh.thongtin.ca-nhan', compact('hocSinh'));
    }

    public function lop()
    {
        $hocSinh = Auth::user()->hocSinh;
        $lop = $hocSinh->lop()->with(['khoiLop', 'namHoc', 'giaoVienChuNhiem'])->first();
        
        $danhSachLop = $hocSinh->lop->hocSinhs()
            ->orderBy('ho_ten')
            ->paginate(20);

        return view('backend.hocsinh.thongtin.lop', compact('lop', 'danhSachLop'));
    }

    public function giaoVien()
    {
        $hocSinh = Auth::user()->hocSinh;
        $hocKyHienTai = AppHelper::getHocKyHienTai();
        
        // Lấy danh sách giáo viên dạy lớp của học sinh
        $giaoViens = PhanCongGiangDay::with(['giaoVien', 'monHoc'])
            ->where('lop_id', $hocSinh->lop_id)
            ->where('hoc_ky_id', $hocKyHienTai)
            ->get()
            ->groupBy('mon_hoc.ten_mon_hoc');

        return view('backend.hocsinh.thongtin.giao-vien', compact('giaoViens'));
    }
}