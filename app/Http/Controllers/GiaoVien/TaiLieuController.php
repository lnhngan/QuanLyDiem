<?php

namespace App\Http\Controllers\GiaoVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\TaiLieu;
use App\Models\DanhMucTaiLieu;
use App\Models\MonHoc;
use App\Models\KhoiLop;

class TaiLieuController extends Controller
{
    public function index()
    {
        $giaoVien = Auth::user()->giaoVien;
        $tailieus = TaiLieu::with(['danhMuc', 'monHoc', 'khoiLop'])
            ->where('giao_vien_id', $giaoVien->id)
            ->paginate(10);
        
        return view('backend.giaovien.tailieu.index', compact('tailieus'));
    }

    public function create()
    {
        $danhMucs = DanhMucTaiLieu::all();
        $monHocs = MonHoc::all();
        $khoiLops = KhoiLop::all();
        
        return view('backend.giaovien.tailieu.create', compact('danhMucs', 'monHocs', 'khoiLops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'danh_muc_id' => 'required|exists:danh_muc_tai_lieu,id',
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'khoi_lop_id' => 'required|exists:khoi_lop,id',
        ]);

        $giaoVien = Auth::user()->giaoVien;

        // Upload file
        $path = $request->file('file')->store('tailieu', 'public');

        TaiLieu::create([
            'tieu_de' => $request->tieu_de,
            'mo_ta' => $request->mo_ta,
            'duong_dan_file' => $path,
            'danh_muc_id' => $request->danh_muc_id,
            'mon_hoc_id' => $request->mon_hoc_id,
            'khoi_lop_id' => $request->khoi_lop_id,
            'giao_vien_id' => $giaoVien->id,
        ]);

        return redirect()->route('giaovien.tailieu.index')
            ->with('success', 'Đăng tài liệu thành công');
    }

    public function edit($id)
    {
        $tailieu = TaiLieu::findOrFail($id);
        $danhMucs = DanhMucTaiLieu::all();
        $monHocs = MonHoc::all();
        $khoiLops = KhoiLop::all();
        
        return view('backend.giaovien.tailieu.edit', compact('tailieu', 'danhMucs', 'monHocs', 'khoiLops'));
    }

    public function update(Request $request, $id)
    {
        $tailieu = TaiLieu::findOrFail($id);
        
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'danh_muc_id' => 'required|exists:danh_muc_tai_lieu,id',
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'khoi_lop_id' => 'required|exists:khoi_lop,id',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            ]);
            
            // Xóa file cũ
            Storage::disk('public')->delete($tailieu->duong_dan_file);
            
            // Upload file mới
            $path = $request->file('file')->store('tailieu', 'public');
            $data['duong_dan_file'] = $path;
        }

        $tailieu->update($data);

        return redirect()->route('giaovien.tailieu.index')
            ->with('success', 'Cập nhật tài liệu thành công');
    }

    public function destroy($id)
    {
        $tailieu = TaiLieu::findOrFail($id);
        
        // Xóa file
        Storage::disk('public')->delete($tailieu->duong_dan_file);
        
        $tailieu->delete();

        return redirect()->route('giaovien.tailieu.index')
            ->with('success', 'Xóa tài liệu thành công');
    }

    public function show($id)
    {
        $giaoVien = Auth::user()->giaoVien;
        
        // Dùng where để đảm bảo GV chỉ xem được tài liệu của chính mình
        $tailieu = TaiLieu::with(['danhMuc', 'monHoc', 'khoiLop'])
            ->where('giao_vien_id', $giaoVien->id)
            ->findOrFail($id);
            
        return view('backend.giaovien.tailieu.show', compact('tailieu'));
    }
}