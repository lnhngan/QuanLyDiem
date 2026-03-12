<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TaiLieu;
use App\Models\DanhMucTaiLieu;
use App\Models\MonHoc;
use App\Models\KhoiLop;
use App\Models\GiaoVien;

class TaiLieuController extends Controller
{
    /**
     * Hiển thị danh sách tài liệu
     */
    public function index(Request $request)
    {
        $query = TaiLieu::with(['danhMuc', 'monHoc', 'khoiLop', 'giaoVien']);

        // Lọc theo danh mục
        if ($request->has('danh_muc_id') && $request->danh_muc_id) {
            $query->where('danh_muc_id', $request->danh_muc_id);
        }

        // Lọc theo môn học
        if ($request->has('mon_hoc_id') && $request->mon_hoc_id) {
            $query->where('mon_hoc_id', $request->mon_hoc_id);
        }

        // Lọc theo khối lớp
        if ($request->has('khoi_lop_id') && $request->khoi_lop_id) {
            $query->where('khoi_lop_id', $request->khoi_lop_id);
        }

        // Tìm kiếm theo tiêu đề
        if ($request->has('search') && $request->search) {
            $query->where('tieu_de', 'like', '%' . $request->search . '%');
        }

        $tailieus = $query->latest()->paginate(15);
        
        $danhMucs = DanhMucTaiLieu::all();
        $monHocs = MonHoc::all();
        $khoiLops = KhoiLop::all();

        return view('backend.admin.tailieu.index', compact('tailieus', 'danhMucs', 'monHocs', 'khoiLops'));
    }

    /**
     * Hiển thị form thêm tài liệu mới
     */
    public function create()
    {
        $danhMucs = DanhMucTaiLieu::all();
        $monHocs = MonHoc::all();
        $khoiLops = KhoiLop::all();
        $giaoviens = GiaoVien::all();
        
        return view('backend.admin.tailieu.create', compact('danhMucs', 'monHocs', 'khoiLops', 'giaoviens'));
    }

    /**
     * Lưu tài liệu mới vào database
     */
    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png|max:20480',
            'danh_muc_id' => 'required|exists:danh_muc_tai_lieu,id',
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'khoi_lop_id' => 'required|exists:khoi_lop,id',
            'giao_vien_id' => 'required|exists:giao_vien,id',
        ]);

        // Upload file
        $path = $request->file('file')->store('tailieu', 'public');

        TaiLieu::create([
            'tieu_de' => $request->tieu_de,
            'mo_ta' => $request->mo_ta,
            'duong_dan_file' => $path,
            'danh_muc_id' => $request->danh_muc_id,
            'mon_hoc_id' => $request->mon_hoc_id,
            'khoi_lop_id' => $request->khoi_lop_id,
            'giao_vien_id' => $request->giao_vien_id,
        ]);

        return redirect()->route('admin.tai-lieu.index')
            ->with('success', 'Thêm tài liệu thành công');
    }

    /**
     * Hiển thị chi tiết tài liệu
     */
    public function show($id)
    {
        $tailieu = TaiLieu::with(['danhMuc', 'monHoc', 'khoiLop', 'giaoVien'])->findOrFail($id);
        
        return view('backend.admin.tailieu.show', compact('tailieu'));
    }

    /**
     * Hiển thị form chỉnh sửa tài liệu
     */
    public function edit($id)
    {
        $tailieu = TaiLieu::findOrFail($id);
        $danhMucs = DanhMucTaiLieu::all();
        $monHocs = MonHoc::all();
        $khoiLops = KhoiLop::all();
        $giaoviens = GiaoVien::all();
        
        return view('backend.admin.tailieu.edit', compact('tailieu', 'danhMucs', 'monHocs', 'khoiLops', 'giaoviens'));
    }

    /**
     * Cập nhật tài liệu trong database
     */
    public function update(Request $request, $id)
    {
        $tailieu = TaiLieu::findOrFail($id);
        
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png|max:20480',
            'danh_muc_id' => 'required|exists:danh_muc_tai_lieu,id',
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'khoi_lop_id' => 'required|exists:khoi_lop,id',
            'giao_vien_id' => 'required|exists:giao_vien,id',
        ]);

        $data = [
            'tieu_de' => $request->tieu_de,
            'mo_ta' => $request->mo_ta,
            'danh_muc_id' => $request->danh_muc_id,
            'mon_hoc_id' => $request->mon_hoc_id,
            'khoi_lop_id' => $request->khoi_lop_id,
            'giao_vien_id' => $request->giao_vien_id,
        ];

        // Xử lý upload file mới nếu có
        if ($request->hasFile('file')) {
            // Xóa file cũ
            Storage::disk('public')->delete($tailieu->duong_dan_file);
            
            // Upload file mới
            $path = $request->file('file')->store('tailieu', 'public');
            $data['duong_dan_file'] = $path;
        }

        $tailieu->update($data);

        return redirect()->route('admin.tai-lieu.index')
            ->with('success', 'Cập nhật tài liệu thành công');
    }

    /**
     * Xóa tài liệu
     */
    public function destroy($id)
    {
        $tailieu = TaiLieu::findOrFail($id);
        
        // Xóa file
        Storage::disk('public')->delete($tailieu->duong_dan_file);
        
        $tailieu->delete();

        return redirect()->route('admin.tai-lieu.index')
            ->with('success', 'Xóa tài liệu thành công');
    }

    /**
     * Download tài liệu
     */
    public function download($id)
    {
        $tailieu = TaiLieu::findOrFail($id);
        
        if (!Storage::disk('public')->exists($tailieu->duong_dan_file)) {
            return redirect()->back()->with('error', 'File không tồn tại');
        }

        return Storage::disk('public')->download($tailieu->duong_dan_file);
    }

    /**
     * Thống kê tài liệu theo danh mục
     */
    public function thongKe()
    {
        $thongKe = [
            'tong_so' => TaiLieu::count(),
            'theo_danh_muc' => DanhMucTaiLieu::withCount('taiLieus')->get(),
            'theo_mon_hoc' => MonHoc::withCount('taiLieus')->get(),
            'theo_khoi_lop' => KhoiLop::withCount('taiLieus')->get(),
            'theo_giao_vien' => GiaoVien::withCount('taiLieus')->orderBy('tai_lieus_count', 'desc')->limit(10)->get(),
        ];
        
        return view('backend.admin.tailieu.thong-ke', compact('thongKe'));
    }
}