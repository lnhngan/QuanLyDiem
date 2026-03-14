<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\KhoiLop;
use App\Models\NamHoc;
use App\Models\GiaoVien;

class LopHocController extends Controller
{
    public function index()
    {
        // SỬA CHỮ 'giaoVien' THÀNH 'giaoVienChuNhiem' cho khớp với Model
        $lophocs = \App\Models\LopHoc::with(['khoiLop', 'namHoc', 'giaoVienChuNhiem'])
                    ->withCount('hocSinhs') // Đếm số học sinh trong lớp
                    ->paginate(10); // Có thể dùng all() nếu bên ngoài view có DataTables
                    
        return view('backend.admin.lophoc.index', compact('lophocs'));
    }

    public function create()
    {
        $khoilops = KhoiLop::all();
        $namhocs = NamHoc::all();
        $giaoviens = GiaoVien::all();
        
        return view('backend.admin.lophoc.create', compact('khoilops', 'namhocs', 'giaoviens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_lop' => 'required|string|max:10',
            'khoi_lop_id' => 'required|exists:khoi_lop,id',
            'nam_hoc_id' => 'required|exists:nam_hoc,id',
            'gv_chu_nhiem_id' => 'nullable|exists:giao_vien,id',
        ]);

        LopHoc::create($request->all());

        return redirect()->route('admin.lophoc.index')
            ->with('success', 'Thêm lớp học thành công');
    }

    public function edit($id)
    {
        $lophoc = LopHoc::findOrFail($id);
        $khoilops = KhoiLop::all();
        $namhocs = NamHoc::all();
        $giaoviens = GiaoVien::all();
        
        return view('backend.admin.lophoc.edit', compact('lophoc', 'khoilops', 'namhocs', 'giaoviens'));
    }

    public function update(Request $request, $id)
    {
        $lophoc = LopHoc::findOrFail($id);
        
        $request->validate([
            'ten_lop' => 'required|string|max:10',
            'khoi_lop_id' => 'required|exists:khoi_lop,id',
            'nam_hoc_id' => 'required|exists:nam_hoc,id',
            'gv_chu_nhiem_id' => 'nullable|exists:giao_vien,id',
        ]);

        $lophoc->update($request->all());

        return redirect()->route('admin.lophoc.index')
            ->with('success', 'Cập nhật lớp học thành công');
    }

    public function destroy($id)
    {
        $lophoc = LopHoc::findOrFail($id);
        
        if ($lophoc->hocSinhs()->count() > 0) {
            return redirect()->route('admin.lophoc.index')
                ->with('error', 'Không thể xóa lớp đã có học sinh');
        }

        $lophoc->delete();

        return redirect()->route('admin.lophoc.index')
            ->with('success', 'Xóa lớp học thành công');
    }
    public function show($id)
    {
        // Lấy thông tin lớp học cùng với các bảng liên kết để hiển thị ra View
        $lophoc = \App\Models\LopHoc::with(['khoiLop', 'namHoc', 'giaoVienChuNhiem', 'hocSinhs'])
                    ->findOrFail($id);
                    
        return view('backend.admin.lophoc.show', compact('lophoc'));
    }
}