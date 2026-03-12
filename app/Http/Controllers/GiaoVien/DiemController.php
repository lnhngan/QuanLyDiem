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
        
        // Lấy danh sách phân công giảng dạy của giáo viên
        $phanCongs = PhanCongGiangDay::with(['lopHoc', 'monHoc', 'hocKy'])
            ->where('giao_vien_id', $giaoVien->id)
            ->get();
        
        return view('backend.giaovien.diem.nhap', compact('phanCongs'));
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

    public function danhSach()
    {
        $giaoVien = Auth::user()->giaoVien;
        
        $bangDiems = BangDiem::with(['hocSinh', 'monHoc', 'hocKy', 'loaiDiem'])
            ->where('giao_vien_id', $giaoVien->id)
            ->paginate(20);
        
        return view('backend.giaovien.diem.danh-sach', compact('bangDiems'));
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
}