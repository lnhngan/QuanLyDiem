<?php

namespace App\Http\Controllers\HocSinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BangDiem;
use App\Models\MonHoc;
use App\Helpers\AppHelper;

class DiemController extends Controller
{
    public function xemDiem()
    {
        $hocSinh = Auth::user()->hocSinh;
        $hocKyHienTai = AppHelper::getHocKyHienTai();
        
        // Lấy điểm theo học kỳ
        $diemTheoKy = BangDiem::where('hoc_sinh_id', $hocSinh->id)
            ->with(['monHoc', 'hocKy', 'loaiDiem'])
            ->get()
            ->groupBy('hoc_ky_id');

        // Tính điểm trung bình từng môn
        $diemTrungBinh = [];
        foreach ($diemTheoKy as $hocKyId => $diemList) {
            $diemTheoMon = $diemList->groupBy('mon_hoc_id');
            
            foreach ($diemTheoMon as $monHocId => $diems) {
                $tongDiem = 0;
                $tongHeSo = 0;
                
                foreach ($diems as $diem) {
                    $tongDiem += $diem->diem_so * $diem->loaiDiem->he_so;
                    $tongHeSo += $diem->loaiDiem->he_so;
                }
                
                $diemTrungBinh[$hocKyId][$monHocId] = $tongHeSo > 0 ? round($tongDiem / $tongHeSo, 2) : 0;
            }
        }

        return view('backend.hocsinh.diem.xem', compact('diemTheoKy', 'diemTrungBinh', 'hocKyHienTai'));
    }

    public function chiTiet($monHocId)
    {
        $hocSinh = Auth::user()->hocSinh;
        $monHoc = MonHoc::findOrFail($monHocId);
        
        $diemChiTiet = BangDiem::where('hoc_sinh_id', $hocSinh->id)
            ->where('mon_hoc_id', $monHocId)
            ->with(['hocKy', 'loaiDiem'])
            ->orderBy('hoc_ky_id')
            ->orderBy('loai_diem_id')
            ->get();

        return view('backend.hocsinh.diem.chi-tiet', compact('monHoc', 'diemChiTiet'));
    }
}