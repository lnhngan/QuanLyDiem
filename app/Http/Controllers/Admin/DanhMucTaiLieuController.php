<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMucTaiLieu;

class DanhMucTaiLieuController extends Controller
{
    public function index()
    {
        $danhmucs = DanhMucTaiLieu::withCount('taiLieus')->paginate(10);
        return view('backend.admin.danh-muc-tai-lieu.index', compact('danhmucs'));
    }

    public function create()
    {
        return view('backend.admin.danh-muc-tai-lieu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|unique:danh_muc_tai_lieu|max:50',
        ]);

        DanhMucTaiLieu::create($request->all());

        return redirect()->route('admin.danh-muc-tai-lieu.index')
            ->with('success', 'Thêm danh mục tài liệu thành công');
    }

    public function edit($id)
    {
        $danhmuc = DanhMucTaiLieu::findOrFail($id);
        return view('backend.admin.danh-muc-tai-lieu.edit', compact('danhmuc'));
    }

    public function update(Request $request, $id)
    {
        $danhmuc = DanhMucTaiLieu::findOrFail($id);
        
        $request->validate([
            'ten_danh_muc' => 'required|string|unique:danh_muc_tai_lieu,ten_danh_muc,' . $id . '|max:50',
        ]);

        $danhmuc->update($request->all());

        return redirect()->route('admin.danh-muc-tai-lieu.index')
            ->with('success', 'Cập nhật danh mục tài liệu thành công');
    }

    public function destroy($id)
    {
        $danhmuc = DanhMucTaiLieu::findOrFail($id);
        
        if ($danhmuc->taiLieus()->count() > 0) {
            return redirect()->route('admin.danh-muc-tai-lieu.index')
                ->with('error', 'Không thể xóa danh mục đã có tài liệu');
        }

        $danhmuc->delete();

        return redirect()->route('admin.danh-muc-tai-lieu.index')
            ->with('success', 'Xóa danh mục tài liệu thành công');
    }
}