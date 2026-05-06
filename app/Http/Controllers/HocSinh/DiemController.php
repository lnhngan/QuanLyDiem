<?php

namespace App\Http\Controllers\HocSinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BangDiem;
use App\Models\MonHoc;
use App\Models\HocKy;
use App\Models\LoaiDiem;

class DiemController extends Controller
{
    // Trang xem danh sách điểm dạng dọc
    public function xemDiem(Request $request)
    {
        $hocSinh = Auth::user()->hocSinh;
        $hocKys = HocKy::all();
        
        $query = BangDiem::with(['monHoc', 'hocKy', 'loaiDiem'])
            ->where('hoc_sinh_id', $hocSinh->id);

        if ($request->has('hoc_ky_id') && $request->hoc_ky_id != '') {
            $query->where('hoc_ky_id', $request->hoc_ky_id);
        }

        $bangDiems = $query->orderBy('hoc_ky_id', 'desc')->get();

        return view('backend.hocsinh.diem.xem', compact('hocKys', 'bangDiems'));
    }

    // Trang xem điểm chi tiết của 1 môn dạng ma trận ngang
    public function chiTiet($monHocId)
    {
        $hocSinh = Auth::user()->hocSinh;
        $monHoc = MonHoc::findOrFail($monHocId);
        $loaiDiems = LoaiDiem::orderBy('he_so', 'asc')->get();
        
        $bangDiems = BangDiem::where('hoc_sinh_id', $hocSinh->id)
            ->where('mon_hoc_id', $monHocId)
            ->with('loaiDiem')
            ->get();

        $diemChiTiet = [];
        $tongDiem = 0;
        $tongHeSo = 0;

        // Khởi tạo khung dữ liệu môn học
        $diemChiTiet[$monHoc->id]['ten_mon'] = $monHoc->ten_mon_hoc;
        $diemChiTiet[$monHoc->id]['diem'] = [];

        // Đẩy điểm vào đúng loại điểm tương ứng
        foreach ($bangDiems as $diem) {
            $diemChiTiet[$monHoc->id]['diem'][$diem->loai_diem_id] = $diem->diem_so;
            $tongDiem += ($diem->diem_so * $diem->loaiDiem->he_so);
            $tongHeSo += $diem->loaiDiem->he_so;
        }

        // Tính trung bình môn
        $diemChiTiet[$monHoc->id]['dtb'] = $tongHeSo > 0 ? round($tongDiem / $tongHeSo, 2) : 0;

        return view('backend.hocsinh.diem.chi-tiet', compact('monHoc', 'loaiDiems', 'diemChiTiet'));
    }

    // Trang bảng tổng hợp cả năm
    public function bangTongHop()
    {
        $hocSinh = Auth::user()->hocSinh;
        
        if (!$hocSinh || !$hocSinh->lop_id) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin lớp học của học sinh.');
        }

        $monHocs = MonHoc::whereHas('phanCongGiangDays', function($query) use ($hocSinh) {
            $query->where('lop_id', $hocSinh->lop_id);
        })->get();

        $tongKetMon = [];
        $tongDiemCacMon = 0;
        $soMonCoDiem = 0;

        foreach ($monHocs as $mon) {
            $bangDiems = BangDiem::with('loaiDiem')
                ->where('hoc_sinh_id', $hocSinh->id)
                ->where('mon_hoc_id', $mon->id)
                ->get();

            $tongDiemHK1 = 0; $heSoHK1 = 0;
            $tongDiemHK2 = 0; $heSoHK2 = 0;

            foreach ($bangDiems as $diem) {
                if ($diem->hoc_ky_id == 1) { // Giả định ID HK1 là 1
                    $tongDiemHK1 += ($diem->diem_so * $diem->loaiDiem->he_so);
                    $heSoHK1 += $diem->loaiDiem->he_so;
                } elseif ($diem->hoc_ky_id == 2) { // Giả định ID HK2 là 2
                    $tongDiemHK2 += ($diem->diem_so * $diem->loaiDiem->he_so);
                    $heSoHK2 += $diem->loaiDiem->he_so;
                }
            }

            $dtbHK1 = $heSoHK1 > 0 ? round($tongDiemHK1 / $heSoHK1, 1) : null;
            $dtbHK2 = $heSoHK2 > 0 ? round($tongDiemHK2 / $heSoHK2, 1) : null;

            $dtbCaNam = null;
            if ($dtbHK1 !== null && $dtbHK2 !== null) {
                $dtbCaNam = round(($dtbHK1 + ($dtbHK2 * 2)) / 3, 1);
            } elseif ($dtbHK1 !== null) {
                $dtbCaNam = $dtbHK1;
            }

            if ($dtbCaNam !== null) {
                $tongDiemCacMon += $dtbCaNam;
                $soMonCoDiem++;
            }

            $tongKetMon[] = [
                'ten_mon' => $mon->ten_mon_hoc,
                'hk1' => $dtbHK1 !== null ? number_format($dtbHK1, 1) : '-',
                'hk2' => $dtbHK2 !== null ? number_format($dtbHK2, 1) : '-',
                'ca_nam' => $dtbCaNam !== null ? number_format($dtbCaNam, 1) : '-'
            ];
        }

        // 1. Tạo biến số thực diemTrungBinhNam để gửi cho View tính toán logic giao diện
        $diemTrungBinhNam = $soMonCoDiem > 0 ? round($tongDiemCacMon / $soMonCoDiem, 1) : 0;
        
        $hocLuc = 'Chưa xét';
        if ($diemTrungBinhNam > 0) {
            if ($diemTrungBinhNam >= 8.0) $hocLuc = 'Giỏi';
            elseif ($diemTrungBinhNam >= 6.5) $hocLuc = 'Khá';
            elseif ($diemTrungBinhNam >= 5.0) $hocLuc = 'Trung Bình';
            else $hocLuc = 'Yếu';
        }
        
        // 2. Tạo chuỗi dtbChung để hiển thị đẹp mắt (Có format dạng 8.0 hoặc dấu - nếu chưa có điểm)
        $dtbChung = $diemTrungBinhNam > 0 ? number_format($diemTrungBinhNam, 1) : '-';
        $hanhKiem = 'Tốt';

        // 3. Thêm diemTrungBinhNam vào mảng compact() để gửi sang View
        return view('backend.hocsinh.diem.bang-tong-hop', compact('tongKetMon', 'dtbChung', 'hocLuc', 'hanhKiem', 'diemTrungBinhNam'));
    }
}