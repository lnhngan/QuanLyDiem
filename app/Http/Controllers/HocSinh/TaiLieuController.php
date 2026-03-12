<?php

namespace App\Http\Controllers\HocSinh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\TaiLieu;
use App\Models\DanhMucTaiLieu;
use App\Models\MonHoc;

class TaiLieuController extends Controller
{
    public function index(Request $request)
    {
        $hocSinh = Auth::user()->hocSinh;
        $khoiLopId = $hocSinh->lop->khoi_lop_id;
        
        $query = TaiLieu::with(['danhMuc', 'monHoc', 'giaoVien'])
            ->where('khoi_lop_id', $khoiLopId);

        // Lọc theo môn học
        if ($request->has('mon_hoc_id') && $request->mon_hoc_id) {
            $query->where('mon_hoc_id', $request->mon_hoc_id);
        }

        // Lọc theo danh mục
        if ($request->has('danh_muc_id') && $request->danh_muc_id) {
            $query->where('danh_muc_id', $request->danh_muc_id);
        }

        // Tìm kiếm
        if ($request->has('search') && $request->search) {
            $query->where('tieu_de', 'like', '%' . $request->search . '%');
        }

        $tailieus = $query->latest()->paginate(12);
        
        $danhMucs = DanhMucTaiLieu::all();
        $monHocs = MonHoc::all();

        return view('backend.hocsinh.tailieu.index', compact('tailieus', 'danhMucs', 'monHocs'));
    }

    public function xem($id)
    {
        $tailieu = TaiLieu::with(['danhMuc', 'monHoc', 'giaoVien'])->findOrFail($id);
        
        return view('backend.hocsinh.tailieu.xem', compact('tailieu'));
    }

    public function download($id)
    {
        $tailieu = TaiLieu::findOrFail($id);
        
        if (!Storage::disk('public')->exists($tailieu->duong_dan_file)) {
            return redirect()->back()->with('error', 'File không tồn tại');
        }

        return Storage::disk('public')->download($tailieu->duong_dan_file);
    }
}