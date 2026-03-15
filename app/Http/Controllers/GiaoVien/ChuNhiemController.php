<?php

namespace App\Http\Controllers\GiaoVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HocSinh;
use App\Models\BangDiem;
use App\Helpers\AppHelper;

class ChuNhiemController extends Controller
{
    public function hocSinh()
    {
        $giaoVien = Auth::user()->giaoVien;
        $lopChuNhiem = $giaoVien->lopChuNhiems()->with(['khoiLop', 'namHoc'])->first();
        
        if (!$lopChuNhiem) {
            return redirect()->back()->with('error', 'Bạn không phải giáo viên chủ nhiệm lớp nào');
        }

        $hocSinhs = HocSinh::where('lop_id', $lopChuNhiem->id)
            ->with('taiKhoan')
            ->paginate(20);

        return view('backend.giaovien.chunhiem.hocsinh', compact('lopChuNhiem', 'hocSinhs'));
    }

    public function diem()
    {
        $giaoVien = Auth::user()->giaoVien;
        $lopChuNhiem = $giaoVien->lopChuNhiems()->first();
        
        if (!$lopChuNhiem) {
            return redirect()->back()->with('error', 'Bạn không phải giáo viên chủ nhiệm lớp nào');
        }

        $hocKyHienTai = AppHelper::getHocKyHienTai();
        
        $hocSinhs = HocSinh::where('lop_id', $lopChuNhiem->id)
            ->with(['bangDiems' => function($query) use ($hocKyHienTai) {
                $query->where('hoc_ky_id', $hocKyHienTai)
                    ->with(['monHoc', 'loaiDiem']);
            }])
            ->get();

        return view('backend.giaovien.chunhiem.diem', compact('lopChuNhiem', 'hocSinhs', 'hocKyHienTai'));
    }
    public function thongke()
    {
        $giaoVien = Auth::user()->giaoVien;
        $lopChuNhiem = $giaoVien->lopChuNhiems()->first();
        
        if (!$lopChuNhiem) {
            return redirect()->back()->with('error', 'Bạn không phải giáo viên chủ nhiệm lớp nào');
        }

        $hocKyHienTai = AppHelper::getHocKyHienTai();
        // Xử lý an toàn nếu hàm getHocKyHienTai chưa hoàn thiện
        if(!$hocKyHienTai) {
            $hocKyHienTai = \App\Models\HocKy::latest('id')->first()->id ?? 1;
        }

        $hocSinhs = HocSinh::where('lop_id', $lopChuNhiem->id)->get();
        
        $thongKe = ['gioi' => 0, 'kha' => 0, 'tb' => 0, 'yeu' => 0];

        foreach ($hocSinhs as $hs) {
            // Lấy tất cả điểm của học sinh này trong học kỳ
            $diems = BangDiem::with('loaiDiem')
                ->where('hoc_sinh_id', $hs->id)
                ->where('hoc_ky_id', $hocKyHienTai)
                ->get();
            
            $tongDiem = 0;
            $tongHeSo = 0;
            
            // Áp dụng công thức tính ĐTB: Tổng (Điểm * Hệ số) / Tổng hệ số
            foreach ($diems as $diem) {
                $heSo = $diem->loaiDiem->he_so;
                $tongDiem += ($diem->diem_so * $heSo);
                $tongHeSo += $heSo;
            }
            
            $hs->dtb = $tongHeSo > 0 ? round($tongDiem / $tongHeSo, 2) : null;

            // Xếp loại cơ bản theo chuẩn
            if ($hs->dtb !== null) {
                if ($hs->dtb >= 8.0) $thongKe['gioi']++;
                elseif ($hs->dtb >= 6.5) $thongKe['kha']++;
                elseif ($hs->dtb >= 5.0) $thongKe['tb']++;
                else $thongKe['yeu']++;
            }
        }

        return view('backend.giaovien.chunhiem.thongke', compact('lopChuNhiem', 'hocSinhs', 'thongKe', 'hocKyHienTai'));
    }
}