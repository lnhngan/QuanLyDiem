<?php

namespace App\Http\Controllers\HocSinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HocSinh;
use App\Models\LopHoc;
use App\Models\PhanCongGiangDay;
use App\Helpers\AppHelper; 

class ThongTinController extends Controller
{
    // 1. Thông tin lý lịch cá nhân
    public function caNhan()
    {
        $hocSinh = Auth::user()->hocSinh;
        return view('backend.hocsinh.thongtin.ca-nhan', compact('hocSinh'));
    }

    // 2. Danh sách thành viên lớp
    public function lop()
    {
        $hocSinh = Auth::user()->hocSinh;
        $lop = $hocSinh->lop;
        
        // Lấy danh sách bạn bè cùng lớp
        $danhSachLop = HocSinh::where('lop_id', $lop->id)
            ->orderBy('ho_ten', 'asc')
            ->get();
            
        return view('backend.hocsinh.thongtin.lop', compact('lop', 'danhSachLop'));
    }

    // 3. Danh sách giáo viên giảng dạy
    public function giaoVien()
    {
        $hocSinh = Auth::user()->hocSinh;
        $lop = $hocSinh->lop;
        
        // Thêm 'hocKy' vào hàm with() để lấy dữ liệu, đồng thời sắp xếp theo Học kỳ
        $phanCongs = PhanCongGiangDay::with(['monHoc', 'giaoVien', 'hocKy'])
            ->where('lop_id', $lop->id)
            ->orderBy('hoc_ky_id', 'asc') // Sắp xếp Học kỳ 1 lên trước, Học kỳ 2 xuống sau
            ->get();
            
        return view('backend.hocsinh.thongtin.giao-vien', compact('lop', 'phanCongs'));
    }
}