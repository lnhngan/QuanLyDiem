<?php

namespace App\Http\Controllers\HocSinh;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TaiLieu;
use App\Helpers\AppHelper;

class DashboardController extends Controller
{
    public function index()
    {
        $hocSinh = Auth::user()->hocSinh;
        
        if (!$hocSinh) {
            return redirect()->route('login')->with('error', 'Không tìm thấy thông tin học sinh');
        }
        
        $hocKyHienTai = AppHelper::getHocKyHienTai();
        
        $data = [
            'hocSinh' => $hocSinh,
            'lop' => $hocSinh->lop()->with(['khoiLop', 'giaoVienChuNhiem'])->first(),
            'diem_trung_binh' => $hocSinh->diemTrungBinhTheoHocKy($hocKyHienTai),
            'so_mon_hoc' => $hocSinh->lop ? $hocSinh->lop->monHocs->count() : 0,
            'tai_lieu_moi' => TaiLieu::where('khoi_lop_id', $hocSinh->lop->khoi_lop_id ?? 0)
                                     ->latest()
                                     ->take(5)
                                     ->get(),
        ];
        
        return view('backend.dashboard.hocsinh', $data);
    }
}