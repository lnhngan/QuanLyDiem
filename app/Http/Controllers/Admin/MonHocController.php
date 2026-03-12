<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonHoc;

class MonHocController extends Controller
{
    public function index()
    {
        $monhocs = MonHoc::withCount('phanCongGiangDays')->paginate(10);
        return view('backend.admin.monhoc.index', compact('monhocs'));
    }

    public function create()
    {
        return view('backend.admin.monhoc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_mon_hoc' => 'required|string|unique:mon_hoc|max:50',
        ]);

        MonHoc::create($request->all());

        return redirect()->route('admin.monhoc.index')
            ->with('success', 'Thêm môn học thành công');
    }

    public function edit($id)
    {
        $monhoc = MonHoc::findOrFail($id);
        return view('backend.admin.monhoc.edit', compact('monhoc'));
    }

    public function update(Request $request, $id)
    {
        $monhoc = MonHoc::findOrFail($id);
        
        $request->validate([
            'ten_mon_hoc' => 'required|string|unique:mon_hoc,ten_mon_hoc,' . $id . '|max:50',
        ]);

        $monhoc->update($request->all());

        return redirect()->route('admin.monhoc.index')
            ->with('success', 'Cập nhật môn học thành công');
    }

    public function destroy($id)
    {
        $monhoc = MonHoc::findOrFail($id);
        
        if ($monhoc->phanCongGiangDays()->count() > 0) {
            return redirect()->route('admin.monhoc.index')
                ->with('error', 'Không thể xóa môn học đã được phân công');
        }

        $monhoc->delete();

        return redirect()->route('admin.monhoc.index')
            ->with('success', 'Xóa môn học thành công');
    }
}