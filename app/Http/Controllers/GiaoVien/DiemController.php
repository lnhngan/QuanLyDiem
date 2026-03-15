<?php

namespace App\Http\Controllers\GiaoVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PhanCongGiangDay;
use App\Models\BangDiem;
use App\Models\HocSinh;
use App\Models\LoaiDiem;

class DiemController extends Controller
{
    public function nhapDiem()
    {
        $giaoVien = Auth::user()->giaoVien;
        
        $phanCongs = PhanCongGiangDay::with(['lopHoc', 'monHoc', 'hocKy'])
            ->where('giao_vien_id', $giaoVien->id)
            ->get();
            
        // Thêm dòng này để truyền $loaiDiems ra giao diện
        $loaiDiems = LoaiDiem::orderBy('he_so', 'asc')->get(); 
        
        return view('backend.giaovien.diem.nhap', compact('phanCongs', 'loaiDiems'));
    }
    public function getHocSinhTheoPhanCong(Request $request)
    {
        $phanCong = PhanCongGiangDay::findOrFail($request->phan_cong_id);
        // Lấy danh sách học sinh thuộc lớp của phân công đó
        $hocSinhs = HocSinh::where('lop_id', $phanCong->lop_id)->orderBy('ho_ten', 'asc')->get();
        
        return response()->json($hocSinhs);
    }

    public function luuDiem(Request $request)
    {
        $request->validate([
            'phan_cong_id' => 'required|exists:phan_cong_giang_day,id',
            'hoc_sinh_id' => 'required|exists:hoc_sinh,id',
            'loai_diem_id' => 'required|exists:loai_diem,id',
            'diem_so' => 'required|numeric|min:0|max:10',
        ]);

        $phanCong = PhanCongGiangDay::findOrFail($request->phan_cong_id);
        $giaoVien = Auth::user()->giaoVien;

        BangDiem::updateOrCreate(
            [
                'hoc_sinh_id' => $request->hoc_sinh_id,
                'mon_hoc_id' => $phanCong->mon_hoc_id,
                'hoc_ky_id' => $phanCong->hoc_ky_id,
                'loai_diem_id' => $request->loai_diem_id,
            ],
            [
                'diem_so' => $request->diem_so,
                'giao_vien_id' => $giaoVien->id,
            ]
        );

        return response()->json(['success' => true, 'message' => 'Nhập điểm thành công']);
    }

    public function danhSach(Request $request)
    {
        $giaoVien = Auth::user()->giaoVien;
        
        // 1. Lấy danh sách lớp và môn mà giáo viên này dạy để tạo Dropdown chọn
        $phanCongs = PhanCongGiangDay::with(['lopHoc', 'monHoc', 'hocKy'])
            ->where('giao_vien_id', $giaoVien->id)
            ->get();
            
        // 2. Lấy tất cả loại điểm trong hệ thống làm cột (Sắp xếp theo hệ số)
        $loaiDiems = LoaiDiem::orderBy('he_so', 'asc')->get();

        $phanCongActive = null;
        $hocSinhs = collect();
        $diemDaNhap = [];

        // 3. Xử lý khi giáo viên chọn 1 môn/lớp cụ thể để xem danh sách
        if ($request->has('phan_cong_id') && $request->phan_cong_id != '') {
            $phanCongActive = PhanCongGiangDay::with(['lopHoc', 'monHoc', 'hocKy'])->findOrFail($request->phan_cong_id);
            
            // Bảo mật: Đảm bảo chỉ xem được lớp mình dạy
            if ($phanCongActive->giao_vien_id == $giaoVien->id) {
                // Lấy danh sách học sinh của lớp đó
                $hocSinhs = HocSinh::where('lop_id', $phanCongActive->lop_id)->orderBy('ho_ten', 'asc')->get();
                
                // Lấy toàn bộ điểm của lớp đó, môn đó, học kỳ đó
                $bangDiems = BangDiem::where('mon_hoc_id', $phanCongActive->mon_hoc_id)
                    ->where('hoc_ky_id', $phanCongActive->hoc_ky_id)
                    ->whereIn('hoc_sinh_id', $hocSinhs->pluck('id'))
                    ->get();
                    
                // Đổ dữ liệu vào mảng 2 chiều để dễ hiển thị ra bảng: $diemDaNhap[hoc_sinh_id][loai_diem_id]
                foreach ($bangDiems as $bd) {
                    $diemDaNhap[$bd->hoc_sinh_id][$bd->loai_diem_id] = $bd;
                }
            }
        }

        return view('backend.giaovien.diem.danh-sach', compact('phanCongs', 'phanCongActive', 'loaiDiems', 'hocSinhs', 'diemDaNhap'));
    }

    public function sua($id)
    {
        $bangDiem = BangDiem::findOrFail($id);
        $loaiDiems = LoaiDiem::all();
        
        return view('backend.giaovien.diem.sua', compact('bangDiem', 'loaiDiems'));
    }

    public function capNhat(Request $request, $id)
    {
        $request->validate([
            'diem_so' => 'required|numeric|min:0|max:10',
            'loai_diem_id' => 'required|exists:loai_diem,id',
        ]);

        $bangDiem = BangDiem::findOrFail($id);
        $bangDiem->update([
            'diem_so' => $request->diem_so,
            'loai_diem_id' => $request->loai_diem_id,
        ]);

        return redirect()->route('giaovien.diem.danh-sach')
            ->with('success', 'Cập nhật điểm thành công');
    }

    public function nhapNhanh(Request $request)
    {
        $giaoVien = Auth::user()->giaoVien;
        // Lấy danh sách phân công
        $phanCongs = PhanCongGiangDay::with(['lopHoc', 'monHoc', 'hocKy'])
            ->where('giao_vien_id', $giaoVien->id)
            ->get();

        $phanCongActive = null;
        $hocSinhs = collect();
        // Lấy tất cả loại điểm (sắp xếp theo hệ số: Thường xuyên -> Giữa kỳ -> Cuối kỳ)
        $loaiDiems = LoaiDiem::orderBy('he_so', 'asc')->get();
        $diemDaNhap = [];

        // Nếu giáo viên đã chọn 1 lớp từ Dropdown
        if ($request->has('phan_cong_id') && $request->phan_cong_id != '') {
            $phanCongActive = PhanCongGiangDay::with('lopHoc')->findOrFail($request->phan_cong_id);
            
            // Bảo mật: Đảm bảo phân công này đúng là của giáo viên đang đăng nhập
            if ($phanCongActive->giao_vien_id == $giaoVien->id) {
                // Lấy danh sách học sinh của lớp đó
                $hocSinhs = HocSinh::where('lop_id', $phanCongActive->lop_id)->orderBy('ten', 'asc')->get();
                
                // Lấy toàn bộ điểm đã nhập của lớp này, môn này, học kỳ này
                $bangDiems = BangDiem::where('mon_hoc_id', $phanCongActive->mon_hoc_id)
                    ->where('hoc_ky_id', $phanCongActive->hoc_ky_id)
                    ->whereIn('hoc_sinh_id', $hocSinhs->pluck('id'))
                    ->get();
                    
                // Đưa vào mảng 2 chiều để dễ hiển thị ra View lưới: $diemDaNhap[hoc_sinh_id][loai_diem_id]
                foreach ($bangDiems as $bd) {
                    $diemDaNhap[$bd->hoc_sinh_id][$bd->loai_diem_id] = $bd->diem_so;
                }
            }
        }

        return view('backend.giaovien.diem.nhap-nhanh', compact('phanCongs', 'phanCongActive', 'hocSinhs', 'loaiDiems', 'diemDaNhap'));
    }

    public function luuNhapNhanh(Request $request)
    {
        $request->validate([
            'phan_cong_id' => 'required|exists:phan_cong_giang_day,id',
            'diem' => 'array', // Nhận mảng ma trận điểm
        ]);

        $phanCong = PhanCongGiangDay::findOrFail($request->phan_cong_id);
        $giaoVien = Auth::user()->giaoVien;

        if ($request->has('diem')) {
            // Duyệt ma trận dữ liệu gửi lên: $request->diem[hoc_sinh_id][loai_diem_id]
            foreach ($request->diem as $hoc_sinh_id => $diems) {
                foreach ($diems as $loai_diem_id => $diem_so) {
                    // Chỉ lưu nếu giáo viên có nhập số
                    if (!is_null($diem_so) && $diem_so !== '') {
                        BangDiem::updateOrCreate(
                            [
                                'hoc_sinh_id' => $hoc_sinh_id,
                                'mon_hoc_id' => $phanCong->mon_hoc_id,
                                'hoc_ky_id' => $phanCong->hoc_ky_id,
                                'loai_diem_id' => $loai_diem_id,
                            ],
                            [
                                'diem_so' => $diem_so,
                                'giao_vien_id' => $giaoVien->id,
                            ]
                        );
                    }
                }
            }
        }

        return redirect()->route('giaovien.diem.nhap-nhanh', ['phan_cong_id' => $request->phan_cong_id])
            ->with('success', 'Lưu bảng điểm lớp ' . $phanCong->lopHoc->ten_lop . ' thành công!');
    }
}