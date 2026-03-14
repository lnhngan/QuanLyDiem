<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiDiem;

class LoaiDiemController extends Controller
{
   public function index()
    {
        // Lấy toàn bộ dữ liệu loại điểm
        $loaiDiems = \App\Models\LoaiDiem::all(); 
        
        return view('backend.admin.loai-diem.index', compact('loaiDiems'));
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
        // Đổi $loaidiem thành $loaiDiem (chữ D viết hoa)
        $loaiDiem = LoaiDiem::findOrFail($id);
        
        // Sửa trong compact() thành 'loaiDiem'
        return view('backend.admin.loai-diem.edit', compact('loaiDiem'));
    }

    public function update(Request $request, $id)
    {
        $loaiDiem = LoaiDiem::findOrFail($id);
        
        $request->validate([
            'ten_loai_diem' => 'required|string|max:50',
            'he_so' => 'required|integer|min:1|max:10',
        ]);

        $loaiDiem->update($request->all());

        return redirect()->route('admin.loai-diem.index')
            ->with('success', 'Cập nhật loại điểm thành công');
    }

    public function destroy($id)
    {
        $loaiDiem = LoaiDiem::findOrFail($id);
        
        if ($loaiDiem->bangDiems()->count() > 0) {
            return redirect()->route('admin.loai-diem.index')
                ->with('error', 'Không thể xóa loại điểm đã được sử dụng');
        }

        $loaiDiem->delete();

        return redirect()->route('admin.loai-diem.index')
            ->with('success', 'Xóa loại điểm thành công');
    }
}