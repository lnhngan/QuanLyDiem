<?php

namespace App\Http\Controllers\GiaoVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PhanCongGiangDay;
use App\Models\TaiLieu;
use App\Models\LopHoc;

class DashboardController extends Controller
{
    public function index()
    {
        $giaoVien = Auth::user()->giaoVien;
        
        // Thống kê số lớp giảng dạy
        $soLopGiangDay = PhanCongGiangDay::where('giao_vien_id', $giaoVien->id)
            ->distinct('lop_id')
            ->count('lop_id');
            
        // Thống kê tài liệu đã đăng
        $soTaiLieu = TaiLieu::where('giao_vien_id', $giaoVien->id)->count();
        
        // Xem có phải là giáo viên chủ nhiệm không
        $lopChuNhiem = LopHoc::where('gv_chu_nhiem_id', $giaoVien->id)->first();
        
        // Lấy danh sách các lớp đang dạy để hiển thị
        $danhSachLopDay = PhanCongGiangDay::with(['lopHoc', 'monHoc'])
            ->where('giao_vien_id', $giaoVien->id)
            ->get();

        return view('backend.dashboard.giaovien', compact(
            'giaoVien', 
            'soLopGiangDay', 
            'soTaiLieu', 
            'lopChuNhiem', 
            'danhSachLopDay'
        ));
    }
}