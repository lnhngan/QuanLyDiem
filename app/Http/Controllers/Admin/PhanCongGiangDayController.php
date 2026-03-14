<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhanCongGiangDay;
use App\Models\GiaoVien;
use App\Models\MonHoc;
use App\Models\LopHoc;
use App\Models\HocKy;

class PhanCongGiangDayController extends Controller
{
    public function index()
    {
        // Chỉnh lại eager loading 'hocKy' thay vì 'namHoc'
        $phancongs = PhanCongGiangDay::with(['giaoVien', 'monHoc', 'lopHoc', 'hocKy'])->get();
        return view('backend.admin.phan-cong.index', compact('phancongs'));
    }

    public function create()
    {
        $giaoviens = GiaoVien::all();
        $monhocs = MonHoc::all();
        $lophocs = LopHoc::all();
        // Lấy danh sách Học Kỳ thay vì Năm Học
        $hockys = HocKy::all(); 
        
        return view('backend.admin.phan-cong.create', compact('giaoviens', 'monhocs', 'lophocs', 'hockys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'giao_vien_id' => 'required|exists:giao_vien,id',
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'lop_id' => 'required|exists:lop_hoc,id',
            'hoc_ky_id' => 'required|exists:hoc_ky,id',
        ], [
            'required' => 'Vui lòng chọn đầy đủ thông tin phân công.',
        ]);

        // Kiểm tra phân công đã tồn tại chưa (1 môn của 1 lớp trong 1 học kỳ chỉ có 1 người dạy)
        $exists = PhanCongGiangDay::where([
            'mon_hoc_id' => $request->mon_hoc_id,
            'lop_id' => $request->lop_id,
            'hoc_ky_id' => $request->hoc_ky_id,
        ])->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Lớp này đã được phân công giáo viên dạy môn này trong học kỳ này!');
        }

        PhanCongGiangDay::create($request->all());

        return redirect()->route('admin.phan-cong.index')
            ->with('success', 'Thêm phân công giảng dạy thành công!');
    }

    public function edit($id)
    {
        $phancong = PhanCongGiangDay::findOrFail($id);
        $giaoviens = GiaoVien::all();
        $monhocs = MonHoc::all();
        $lophocs = LopHoc::all();
        $hockys = HocKy::all();
        
        return view('backend.admin.phan-cong.edit', compact('phancong', 'giaoviens', 'monhocs', 'lophocs', 'hockys'));
    }

    public function update(Request $request, $id)
    {
        $phanCong = PhanCongGiangDay::findOrFail($id);
        
        $request->validate([
            'giao_vien_id' => 'required|exists:giao_vien,id',
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'lop_id' => 'required|exists:lop_hoc,id',
            'hoc_ky_id' => 'required|exists:hoc_ky,id',
        ]);

        // Kiểm tra trùng lặp (trừ bản thân nó)
        $exists = PhanCongGiangDay::where([
            'mon_hoc_id' => $request->mon_hoc_id,
            'lop_id' => $request->lop_id,
            'hoc_ky_id' => $request->hoc_ky_id,
        ])->where('id', '!=', $id)->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Lớp này đã được phân công giáo viên khác dạy môn này trong học kỳ này!');
        }

        $phanCong->update($request->all());

        return redirect()->route('admin.phan-cong.index')
            ->with('success', 'Cập nhật phân công giảng dạy thành công!');
    }

    public function destroy($id)
    {
        $phanCong = PhanCongGiangDay::findOrFail($id);
        
        $hasDiem = $phanCong->giaoVien->bangDiems()
            ->where('mon_hoc_id', $phanCong->mon_hoc_id)
            ->where('hoc_ky_id', $phanCong->hoc_ky_id)
            ->exists();

        if ($hasDiem) {
            return redirect()->route('admin.phan-cong.index')
                ->with('error', 'Không thể xóa phân công do giáo viên này đã vào điểm.');
        }

        $phanCong->delete();

        return redirect()->route('admin.phan-cong.index')
            ->with('success', 'Xóa phân công giảng dạy thành công!');
    }

    public function getByGiaoVien($giaoVienId)
    {
        $phanCongs = PhanCongGiangDay::with(['monHoc', 'lopHoc', 'hocKy'])
            ->where('giao_vien_id', $giaoVienId)
            ->get();
            
        return response()->json($phanCongs);
    }

    public function getByLop($lopId, $hocKyId = null)
    {
        $query = PhanCongGiangDay::with(['giaoVien', 'monHoc'])
            ->where('lop_id', $lopId);
            
        if ($hocKyId) {
            $query->where('hoc_ky_id', $hocKyId);
        }
        
        $phanCongs = $query->get();
        return response()->json($phanCongs);
    }
}