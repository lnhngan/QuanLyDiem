<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiDiem;

class LoaiDiemController extends Controller
{
    public function index()
    {
        // Lấy danh sách lớp học, kèm theo thông tin Khóa ngoại (Khối, Năm học, Giáo viên)
        // để không bị lỗi khi ra ngoài View
        $lophocs = \App\Models\LopHoc::with(['khoiLop', 'namHoc', 'giaoVien'])
                    ->withCount('hocSinhs') // Đếm số học sinh trong lớp
                    ->paginate(10);
                    
        // Phải gọi đúng tên thư mục: lophoc và tên file: index
        return view('backend.admin.lophoc.index', compact('lophocs'));
    }

    public function create()
    {
        return view('backend.admin.loai-diem.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_loai_diem' => 'required|string|max:50',
            'he_so' => 'required|integer|min:1|max:10',
        ]);

        LoaiDiem::create($request->all());

        return redirect()->route('admin.loai-diem.index')
            ->with('success', 'Thêm loại điểm thành công');
    }

    public function edit($id)
    {
        $loaidiem = LoaiDiem::findOrFail($id);
        return view('backend.admin.loai-diem.edit', compact('loaidiem'));
    }

    public function update(Request $request, $id)
    {
        $loaidiem = LoaiDiem::findOrFail($id);
        
        $request->validate([
            'ten_loai_diem' => 'required|string|max:50',
            'he_so' => 'required|integer|min:1|max:10',
        ]);

        $loaidiem->update($request->all());

        return redirect()->route('admin.loai-diem.index')
            ->with('success', 'Cập nhật loại điểm thành công');
    }

    public function destroy($id)
    {
        $loaidiem = LoaiDiem::findOrFail($id);
        
        if ($loaidiem->bangDiems()->count() > 0) {
            return redirect()->route('admin.loai-diem.index')
                ->with('error', 'Không thể xóa loại điểm đã được sử dụng');
        }

        $loaidiem->delete();

        return redirect()->route('admin.loai-diem.index')
            ->with('success', 'Xóa loại điểm thành công');
    }
}