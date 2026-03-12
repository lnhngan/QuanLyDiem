<?php

namespace App\Http\Controllers\GiaoVien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $giaoVien = Auth::user()->giaoVien;
        
        if (!$giaoVien) {
            return redirect()->route('login')->with('error', 'Không tìm thấy thông tin giáo viên');
        }
        
        $data = [
            'giaoVien' => $giaoVien,
            'lop_days' => $giaoVien->lopDays()->with(['khoiLop', 'namHoc'])->get(),
            'mon_days' => $giaoVien->monDays,
            'lop_chu_nhiem' => $giaoVien->lopChuNhiems()->with(['hocSinhs'])->first(),
            'so_luong_hoc_sinh' => $giaoVien->lopDays->sum(function($lop) {
                return $lop->hocSinhs->count();
            }),
        ];
        
        return view('backend.dashboard.giaovien', $data);
    }
}