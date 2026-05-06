<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YeuCauSuaDiem;

class DuyetSuaDiemController extends Controller
{
    // Hiển thị danh sách đang chờ duyệt
    public function index()
    {
        $yeuCaus = YeuCauSuaDiem::with(['bangDiem.hocSinh', 'bangDiem.monHoc', 'giaoVien'])
            ->where('trang_thai', 0) // 0 là chờ duyệt
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.admin.duyet-sua-diem.index', compact('yeuCaus'));
    }

    // Xử lý khi Admin bấm Duyệt
    public function duyet($id)
    {
        $yeuCau = YeuCauSuaDiem::findOrFail($id);

        // 1. Ghi đè "Điểm mới" vào bảng điểm chính
        $yeuCau->bangDiem->update([
            'diem_so' => $yeuCau->diem_moi
        ]);

        // 2. Chuyển trạng thái yêu cầu thành Đã duyệt (1)
        $yeuCau->update(['trang_thai' => 1]);

        return redirect()->back()->with('success', 'Đã duyệt yêu cầu và cập nhật điểm thành công!');
    }

    // Xử lý khi Admin bấm Từ chối
    public function tuChoi($id)
    {
        $yeuCau = YeuCauSuaDiem::findOrFail($id);
        // Chuyển trạng thái yêu cầu thành Từ chối (2), bảng điểm giữ nguyên
        $yeuCau->update(['trang_thai' => 2]);

        return redirect()->back()->with('success', 'Đã từ chối yêu cầu sửa điểm.');
    }
}
