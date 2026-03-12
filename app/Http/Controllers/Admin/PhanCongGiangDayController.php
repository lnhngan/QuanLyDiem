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
    /**
     * Hiển thị danh sách phân công giảng dạy
     */
    public function index()
    {
        $phanCongs = PhanCongGiangDay::with(['giaoVien', 'monHoc', 'lopHoc', 'hocKy'])
            ->orderBy('hoc_ky_id', 'desc')
            ->orderBy('lop_id')
            ->paginate(15);
            
        return view('backend.admin.phan-cong.index', compact('phanCongs'));
    }

    /**
     * Hiển thị form thêm phân công mới
     */
    public function create()
    {
        $giaoviens = GiaoVien::all();
        $monhocs = MonHoc::all();
        $lophocs = LopHoc::with('khoiLop')->get();
        $hockys = HocKy::with('namHoc')->get();
        
        return view('backend.admin.phan-cong.create', compact('giaoviens', 'monhocs', 'lophocs', 'hockys'));
    }

    /**
     * Lưu phân công mới vào database
     */
    public function store(Request $request)
    {
        $request->validate([
            'giao_vien_id' => 'required|exists:giao_vien,id',
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'lop_id' => 'required|exists:lop_hoc,id',
            'hoc_ky_id' => 'required|exists:hoc_ky,id',
        ]);

        // Kiểm tra phân công đã tồn tại chưa
        $exists = PhanCongGiangDay::where([
            'giao_vien_id' => $request->giao_vien_id,
            'mon_hoc_id' => $request->mon_hoc_id,
            'lop_id' => $request->lop_id,
            'hoc_ky_id' => $request->hoc_ky_id,
        ])->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Phân công này đã tồn tại trong hệ thống');
        }

        PhanCongGiangDay::create($request->all());

        return redirect()->route('admin.phan-cong.index')
            ->with('success', 'Thêm phân công giảng dạy thành công');
    }

    /**
     * Hiển thị form chỉnh sửa phân công
     */
    public function edit($id)
    {
        $phanCong = PhanCongGiangDay::findOrFail($id);
        $giaoviens = GiaoVien::all();
        $monhocs = MonHoc::all();
        $lophocs = LopHoc::with('khoiLop')->get();
        $hockys = HocKy::with('namHoc')->get();
        
        return view('backend.admin.phan-cong.edit', compact('phanCong', 'giaoviens', 'monhocs', 'lophocs', 'hockys'));
    }

    /**
     * Cập nhật phân công trong database
     */
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
            'giao_vien_id' => $request->giao_vien_id,
            'mon_hoc_id' => $request->mon_hoc_id,
            'lop_id' => $request->lop_id,
            'hoc_ky_id' => $request->hoc_ky_id,
        ])->where('id', '!=', $id)->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Phân công này đã tồn tại trong hệ thống');
        }

        $phanCong->update($request->all());

        return redirect()->route('admin.phan-cong.index')
            ->with('success', 'Cập nhật phân công giảng dạy thành công');
    }

    /**
     * Xóa phân công
     */
    public function destroy($id)
    {
        $phanCong = PhanCongGiangDay::findOrFail($id);
        
        // Kiểm tra xem đã có điểm số nào chưa
        $hasDiem = $phanCong->giaoVien->bangDiems()
            ->where('mon_hoc_id', $phanCong->mon_hoc_id)
            ->where('hoc_ky_id', $phanCong->hoc_ky_id)
            ->exists();

        if ($hasDiem) {
            return redirect()->route('admin.phan-cong.index')
                ->with('error', 'Không thể xóa phân công đã có điểm số');
        }

        $phanCong->delete();

        return redirect()->route('admin.phan-cong.index')
            ->with('success', 'Xóa phân công giảng dạy thành công');
    }

    /**
     * API lấy danh sách phân công theo giáo viên
     */
    public function getByGiaoVien($giaoVienId)
    {
        $phanCongs = PhanCongGiangDay::with(['monHoc', 'lopHoc', 'hocKy'])
            ->where('giao_vien_id', $giaoVienId)
            ->get();
            
        return response()->json($phanCongs);
    }

    /**
     * API lấy danh sách phân công theo lớp
     */
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