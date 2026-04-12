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

    public function diem(Request $request)
    {
        $giaoVien = \Illuminate\Support\Facades\Auth::user()->giaoVien;
        
        // Tìm lớp mà giáo viên này đang làm chủ nhiệm
        $lopChuNhiem = \App\Models\LopHoc::where('gv_chu_nhiem_id', $giaoVien->id)->first();
        
        if (!$lopChuNhiem) {
            return redirect()->back()->with('error', 'Bạn không phải là giáo viên chủ nhiệm của lớp nào.');
        }

        // Lấy danh sách học sinh của lớp
        $hocSinhs = \App\Models\HocSinh::where('lop_id', $lopChuNhiem->id)->orderBy('ho_ten', 'asc')->get();

        // Lấy danh sách tất cả môn học và loại điểm
        $monHocs = \App\Models\MonHoc::orderBy('ten_mon_hoc', 'asc')->get();
        $loaiDiems = \App\Models\LoaiDiem::orderBy('he_so', 'asc')->get();

        $monHocActive = null;
        $diemDaNhap = [];

        // Nếu chủ nhiệm chọn 1 môn học từ Dropdown để xem
        if ($request->has('mon_hoc_id') && $request->mon_hoc_id != '') {
            $monHocActive = \App\Models\MonHoc::find($request->mon_hoc_id);

            if ($monHocActive) {
                // Lấy toàn bộ điểm của lớp này, thuộc môn học này
                $bangDiems = \App\Models\BangDiem::where('mon_hoc_id', $monHocActive->id)
                    ->whereIn('hoc_sinh_id', $hocSinhs->pluck('id'))
                    ->get();
                    
                // Gắn vào mảng 2 chiều để xuất ra dạng ma trận
                foreach ($bangDiems as $bd) {
                    $diemDaNhap[$bd->hoc_sinh_id][$bd->loai_diem_id] = $bd;
                }
            }
        }

        return view('backend.giaovien.chunhiem.diem', compact('lopChuNhiem', 'hocSinhs', 'monHocs', 'loaiDiems', 'monHocActive', 'diemDaNhap'));
    }
    // ĐÃ THAY THẾ HÀM THỐNG KÊ BẰNG CODE BẠN CUNG CẤP
    public function thongKe()
    {
        $giaoVienId = Auth::user()->giaoVien->id;
        $lopChuNhiem = \App\Models\LopHoc::where('gv_chu_nhiem_id', $giaoVienId)->first();

        if (!$lopChuNhiem) {
            return redirect()->route('giaovien.dashboard')->with('error', 'Bạn không phải là giáo viên chủ nhiệm.');
        }

        $danhSachHocSinh = \App\Models\HocSinh::where('lop_id', $lopChuNhiem->id)->get();

        // Khởi tạo mảng đếm số lượng học sinh theo từng loại học lực
        $thongKe = [
            'Gioi' => 0,
            'Kha' => 0,
            'TrungBinh' => 0,
            'Yeu' => 0,
            'ChuaXepLoai' => 0
        ];

        $hocSinhCoDiem = [];

        foreach ($danhSachHocSinh as $hocSinh) {
            $bangDiem = \App\Models\BangDiem::where('hoc_sinh_id', $hocSinh->id)->get();

            // Nhóm điểm theo học kỳ và môn học
            $diemTheoHocKy = [];
            foreach ($bangDiem as $diem) {
                $diemTheoHocKy[$diem->hoc_ky_id][$diem->mon_hoc_id][$diem->loai_diem_id][] = $diem->diem_so;
            }

            $dtbMonTheoHocKy = [];
            foreach ($diemTheoHocKy as $hkId => $diemCacMon) {
                foreach ($diemCacMon as $monId => $diemLoai) {
                    $tongDiem = 0; $tongHeSo = 0;
                    
                    // Logic tính điểm: Thường xuyên (id 1, 2) hệ số 1, Giữa kỳ (id 3) hệ số 2, Cuối kỳ (id 4) hệ số 3
                    if(isset($diemLoai[1])) { foreach($diemLoai[1] as $d) { $tongDiem += $d; $tongHeSo += 1; } }
                    if(isset($diemLoai[2])) { foreach($diemLoai[2] as $d) { $tongDiem += $d; $tongHeSo += 1; } }
                    if(isset($diemLoai[3])) { $tongDiem += $diemLoai[3][0] * 2; $tongHeSo += 2; }
                    if(isset($diemLoai[4])) { $tongDiem += $diemLoai[4][0] * 3; $tongHeSo += 3; }

                    if ($tongHeSo > 0) $dtbMonTheoHocKy[$hkId][$monId] = round($tongDiem / $tongHeSo, 1);
                }
            }

            // Tính ĐTB từng học kỳ (Giả định HK1 có id=1, HK2 có id=2)
            $dtbHk1 = 0; $dtbHk2 = 0;
            if (isset($dtbMonTheoHocKy[1]) && count($dtbMonTheoHocKy[1]) > 0) {
                $dtbHk1 = round(array_sum($dtbMonTheoHocKy[1]) / count($dtbMonTheoHocKy[1]), 1);
            }
            if (isset($dtbMonTheoHocKy[2]) && count($dtbMonTheoHocKy[2]) > 0) {
                $dtbHk2 = round(array_sum($dtbMonTheoHocKy[2]) / count($dtbMonTheoHocKy[2]), 1);
            }

            // Tính ĐTB Cả năm: (HK1 + HK2 * 2) / 3
            $dtbCaNam = 0;
            if ($dtbHk1 > 0 && $dtbHk2 > 0) {
                $dtbCaNam = round(($dtbHk1 + ($dtbHk2 * 2)) / 3, 1);
            }

            // Xếp loại học lực dựa trên ĐTB Cả năm
            $xepLoai = 'Chưa xếp loại';
            if ($dtbCaNam > 0) {
                if ($dtbCaNam >= 8.0) { $xepLoai = 'Giỏi'; $thongKe['Gioi']++; }
                elseif ($dtbCaNam >= 6.5) { $xepLoai = 'Khá'; $thongKe['Kha']++; }
                elseif ($dtbCaNam >= 5.0) { $xepLoai = 'Trung Bình'; $thongKe['TrungBinh']++; }
                else { $xepLoai = 'Yếu'; $thongKe['Yeu']++; }
            } else {
                $thongKe['ChuaXepLoai']++;
            }

            // Gắn thông tin tính toán được vào đối tượng học sinh
            $hocSinh->dtbCaNam = $dtbCaNam;
            $hocSinh->xepLoai = $xepLoai;
            $hocSinhCoDiem[] = $hocSinh;
        }

        $tongSoHocSinh = count($danhSachHocSinh);

        // Sắp xếp danh sách học sinh giảm dần theo ĐTB
        usort($hocSinhCoDiem, function($a, $b) {
            return $b->dtbCaNam <=> $a->dtbCaNam;
        });

        return view('backend.giaovien.chunhiem.thongke', compact('lopChuNhiem', 'thongKe', 'tongSoHocSinh', 'hocSinhCoDiem'));
    }
}

    
