<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhoiLop;

class KhoiLopController extends Controller
{
    public function index()
    {
        $khoilops = KhoiLop::withCount('lopHocs')->paginate(10);
        return view('backend.admin.khoilop.index', compact('khoilops'));
    }

    public function create()
    {
        return view('backend.admin.khoilop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_khoi' => 'required|string|unique:khoi_lop|max:20',
        ]);

        KhoiLop::create($request->all());

        return redirect()->route('admin.khoilop.index')
            ->with('success', 'Thêm khối lớp thành công');
    }

    public function edit($id)
    {
        $khoilop = KhoiLop::findOrFail($id);
        return view('backend.admin.khoilop.edit', compact('khoilop'));
    }

    public function update(Request $request, $id)
    {
        $khoilop = KhoiLop::findOrFail($id);
        
        $request->validate([
            'ten_khoi' => 'required|string|unique:khoi_lop,ten_khoi,' . $id . '|max:20',
        ]);

        $khoilop->update($request->all());

        return redirect()->route('admin.khoilop.index')
            ->with('success', 'Cập nhật khối lớp thành công');
    }

    public function destroy($id)
    {
        $khoilop = KhoiLop::findOrFail($id);
        
        if ($khoilop->lopHocs()->count() > 0) {
            return redirect()->route('admin.khoilop.index')
                ->with('error', 'Không thể xóa khối lớp đã có lớp học');
        }

        $khoilop->delete();

        return redirect()->route('admin.khoilop.index')
            ->with('success', 'Xóa khối lớp thành công');
    }
}