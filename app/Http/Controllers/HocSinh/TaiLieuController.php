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

        // Tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $query->where('tieu_de', 'like', '%' . $request->search . '%');
        }

        // Chú ý biến $taiLieus (chữ L viết hoa để View nhận diện được)
        $taiLieus = $query->latest()->paginate(12);
        
        return view('backend.hocsinh.tailieu.index', compact('taiLieus'));
    }

    // Hàm lọc tài liệu theo từng môn (dùng cho sidebar lọc)
    public function theoMon(Request $request)
    {
        $hocSinh = Auth::user()->hocSinh;
        $khoiLopId = $hocSinh->lop->khoi_lop_id;

        // Lấy danh sách các môn học kèm theo số lượng tài liệu
        $monHocs = MonHoc::withCount(['taiLieus' => function ($q) use ($khoiLopId) {
            $q->where('khoi_lop_id', $khoiLopId);
        }])->get();

        $monHocActive = null;
        $query = TaiLieu::with(['danhMuc', 'monHoc', 'giaoVien'])
            ->where('khoi_lop_id', $khoiLopId);

        // Nếu bấm chọn 1 môn học cụ thể
        if ($request->has('mon_hoc_id') && $request->mon_hoc_id != '') {
            $monHocActive = MonHoc::find($request->mon_hoc_id);
            $query->where('mon_hoc_id', $request->mon_hoc_id);
        }

        $taiLieus = $query->latest()->paginate(12);

        return view('backend.hocsinh.tailieu.theo-mon', compact('taiLieus', 'monHocs', 'monHocActive'));
    }

    public function xem($id)
    {
        // Chú ý biến $taiLieu (chữ L viết hoa)
        $taiLieu = TaiLieu::with(['danhMuc', 'monHoc', 'giaoVien'])->findOrFail($id);
        
        return view('backend.hocsinh.tailieu.xem', compact('taiLieu'));
    }

    public function download($id)
    {
        $taiLieu = TaiLieu::findOrFail($id);
        
        if (!Storage::disk('public')->exists($taiLieu->duong_dan_file)) {
            return redirect()->back()->with('error', 'File không tồn tại hoặc đã bị xóa.');
        }

        return Storage::disk('public')->download($taiLieu->duong_dan_file);
    }
}