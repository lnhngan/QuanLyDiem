<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NamHoc;

class NamHocController extends Controller
{
    public function index()
    {
        $namhocs = NamHoc::withCount('hocKys')->paginate(10);
        return view('backend.admin.namhoc.index', compact('namhocs'));
    }

    public function create()
    {
        return view('backend.admin.namhoc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_nam_hoc' => 'required|string|unique:nam_hoc|max:20',
        ]);

        NamHoc::create($request->all());

        return redirect()->route('admin.namhoc.index')
            ->with('success', 'Thêm năm học thành công');
    }

    public function edit($id)
    {
        $namhoc = NamHoc::findOrFail($id);
        return view('backend.admin.namhoc.edit', compact('namhoc'));
    }

    public function update(Request $request, $id)
    {
        $namhoc = NamHoc::findOrFail($id);
        
        $request->validate([
            'ten_nam_hoc' => 'required|string|unique:nam_hoc,ten_nam_hoc,' . $id . '|max:20',
        ]);

        $namhoc->update($request->all());

        return redirect()->route('admin.namhoc.index')
            ->with('success', 'Cập nhật năm học thành công');
    }

    public function destroy($id)
    {
        $namhoc = NamHoc::findOrFail($id);
        
        // Kiểm tra xem có học kỳ nào không
        if ($namhoc->hocKys()->count() > 0) {
            return redirect()->route('admin.namhoc.index')
                ->with('error', 'Không thể xóa năm học đã có học kỳ');
        }

        $namhoc->delete();

        return redirect()->route('admin.namhoc.index')
            ->with('success', 'Xóa năm học thành công');
    }
}