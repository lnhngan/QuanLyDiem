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
}