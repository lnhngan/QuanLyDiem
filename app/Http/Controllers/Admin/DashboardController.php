<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HocSinh;
use App\Models\GiaoVien;
use App\Models\LopHoc;
use App\Models\TaiLieu;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'tong_hoc_sinh' => HocSinh::count(),
            'tong_giao_vien' => GiaoVien::count(),
            'tong_lop_hoc' => LopHoc::count(),
            'tong_tai_lieu' => TaiLieu::count(),
            'hoc_sinh_moi' => HocSinh::latest()->take(5)->get(),
            'giao_vien_moi' => GiaoVien::latest()->take(5)->get(),
        ];
        
        return view('backend.dashboard.admin', $data);
    }
}