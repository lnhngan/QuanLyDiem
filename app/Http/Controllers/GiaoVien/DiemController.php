<?php

namespace App\Http\Controllers\GiaoVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PhanCongGiangDay;
use App\Models\BangDiem;
use App\Models\HocSinh;
use App\Models\LoaiDiem;
use App\Models\YeuCauSuaDiem;


class DiemController extends Controller
{


    public function danhSach(Request $request)
    {
        $giaoVien = Auth::user()->giaoVien;

        // 1. Lấy danh sách lớp và môn mà giáo viên này dạy để tạo Dropdown chọn
        $phanCongs = PhanCongGiangDay::with(['lopHoc', 'monHoc', 'hocKy'])
            ->where('giao_vien_id', $giaoVien->id)
            ->get();

        // 2. Lấy tất cả loại điểm trong hệ thống làm cột (Sắp xếp theo hệ số)
        $loaiDiems = LoaiDiem::orderBy('he_so', 'asc')->get();

        $phanCongActive = null;
        $hocSinhs = collect();
        $diemDaNhap = [];

        // 3. Xử lý khi giáo viên chọn 1 môn/lớp cụ thể để xem danh sách
        if ($request->has('phan_cong_id') && $request->phan_cong_id != '') {
            $phanCongActive = PhanCongGiangDay::with(['lopHoc', 'monHoc', 'hocKy'])->findOrFail($request->phan_cong_id);

            // Bảo mật: Đảm bảo chỉ xem được lớp mình dạy
            if ($phanCongActive->giao_vien_id == $giaoVien->id) {
                // Lấy danh sách học sinh của lớp đó
                $hocSinhs = HocSinh::where('lop_id', $phanCongActive->lop_id)->orderBy('ho_ten', 'asc')->get();

                // Lấy toàn bộ điểm của lớp đó, môn đó, học kỳ đó
                $bangDiems = BangDiem::where('mon_hoc_id', $phanCongActive->mon_hoc_id)
                    ->where('hoc_ky_id', $phanCongActive->hoc_ky_id)
                    ->whereIn('hoc_sinh_id', $hocSinhs->pluck('id'))
                    ->get();

                // Đổ dữ liệu vào mảng 2 chiều để dễ hiển thị ra bảng: $diemDaNhap[hoc_sinh_id][loai_diem_id]
                foreach ($bangDiems as $bd) {
                    $diemDaNhap[$bd->hoc_sinh_id][$bd->loai_diem_id] = $bd;
                }
            }
        }

        return view('backend.giaovien.diem.danh-sach', compact('phanCongs', 'phanCongActive', 'loaiDiems', 'hocSinhs', 'diemDaNhap'));
    }

    public function sua($id)
    {
        $bangDiem = BangDiem::findOrFail($id);
        $loaiDiems = LoaiDiem::all();

        return view('backend.giaovien.diem.sua', compact('bangDiem', 'loaiDiems'));
    }

    public function guiYeuCau(Request $request, $id)
    {
        // 1. Kiểm tra dữ liệu đầu vào
        $request->validate([
            'diem_moi' => 'required|numeric|min:0|max:10',
            'ly_do' => 'required|string|max:500',
        ]);

        $bangDiem = BangDiem::findOrFail($id);
        $giaoVien = Auth::user()->giaoVien;

        // 2. Chặn nếu giáo viên spam (đã có yêu cầu đang chờ rồi thì không cho gửi thêm)
        $daCoYeuCau = YeuCauSuaDiem::where('bang_diem_id', $id)
            ->where('trang_thai', 0) // 0 là chờ duyệt
            ->exists();

        if ($daCoYeuCau) {
            return redirect()->route('giaovien.diem.danh-sach')
                ->with('error', 'Điểm này đang có yêu cầu chờ duyệt, không thể gửi thêm!');
        }

        // 3. Tạo mới 1 dòng vào bảng yeu_cau_sua_diem
        YeuCauSuaDiem::create([
            'bang_diem_id' => $id,
            'giao_vien_id' => $giaoVien->id,
            'diem_cu' => $bangDiem->diem_so,
            'diem_moi' => $request->diem_moi,
            'ly_do' => $request->ly_do,
            'trang_thai' => 0 // Chờ duyệt
        ]);

        // 4. Quay lại trang danh sách và báo thành công
        return redirect()->route('giaovien.diem.danh-sach')
            ->with('success', 'Đã gửi yêu cầu sửa điểm thành công. Vui lòng chờ Admin duyệt!');
    }


    public function nhapNhanh(Request $request)
    {
        $giaoVien = Auth::user()->giaoVien;
        // Lấy danh sách phân công
        $phanCongs = PhanCongGiangDay::with(['lopHoc', 'monHoc', 'hocKy'])
            ->where('giao_vien_id', $giaoVien->id)
            ->get();

        $phanCongActive = null;
        $hocSinhs = collect();
        // Lấy tất cả loại điểm (sắp xếp theo hệ số: Thường xuyên -> Giữa kỳ -> Cuối kỳ)
        $loaiDiems = LoaiDiem::orderBy('he_so', 'asc')->get();
        $diemDaNhap = [];

        // Nếu giáo viên đã chọn 1 lớp từ Dropdown
        if ($request->has('phan_cong_id') && $request->phan_cong_id != '') {
            $phanCongActive = PhanCongGiangDay::with('lopHoc')->findOrFail($request->phan_cong_id);

            // Bảo mật: Đảm bảo phân công này đúng là của giáo viên đang đăng nhập
            if ($phanCongActive->giao_vien_id == $giaoVien->id) {
                // Lấy danh sách học sinh của lớp đó
                $hocSinhs = HocSinh::where('lop_id', $phanCongActive->lop_id)->orderBy('ho_ten', 'asc')->get();

                // Lấy toàn bộ điểm đã nhập của lớp này, môn này, học kỳ này
                $bangDiems = BangDiem::where('mon_hoc_id', $phanCongActive->mon_hoc_id)
                    ->where('hoc_ky_id', $phanCongActive->hoc_ky_id)
                    ->whereIn('hoc_sinh_id', $hocSinhs->pluck('id'))
                    ->get();

                // Đưa vào mảng 2 chiều để dễ hiển thị ra View lưới: $diemDaNhap[hoc_sinh_id][loai_diem_id]
                foreach ($bangDiems as $bd) {
                    $diemDaNhap[$bd->hoc_sinh_id][$bd->loai_diem_id] = $bd->diem_so;
                }
            }
        }

        return view('backend.giaovien.diem.nhap-nhanh', compact('phanCongs', 'phanCongActive', 'hocSinhs', 'loaiDiems', 'diemDaNhap'));
    }

    public function luuNhapNhanh(Request $request)
    {
        $request->validate([
            'phan_cong_id' => 'required|exists:phan_cong_giang_day,id',
            'diem' => 'array', // Nhận mảng ma trận điểm
        ]);

        $phanCong = PhanCongGiangDay::findOrFail($request->phan_cong_id);
        $giaoVien = Auth::user()->giaoVien;

        if ($request->has('diem')) {
            // Duyệt ma trận dữ liệu gửi lên: $request->diem[hoc_sinh_id][loai_diem_id]
            foreach ($request->diem as $hoc_sinh_id => $diems) {
                foreach ($diems as $loai_diem_id => $diem_so) {
                    // Chỉ lưu nếu giáo viên có nhập số
                    if (!is_null($diem_so) && $diem_so !== '') {
                        // 1. Kiểm tra xem ô điểm này đã tồn tại trong CSDL chưa
                        $diemTonTai = BangDiem::where('hoc_sinh_id', $hoc_sinh_id)
                            ->where('mon_hoc_id', $phanCong->mon_hoc_id)
                            ->where('hoc_ky_id', $phanCong->hoc_ky_id)
                            ->where('loai_diem_id', $loai_diem_id)
                            ->first();

                        // 2. NẾU CHƯA CÓ ĐIỂM -> Cho phép thêm mới bình thường
                        if (!$diemTonTai) {
                            BangDiem::create([
                                'hoc_sinh_id' => $hoc_sinh_id,
                                'mon_hoc_id' => $phanCong->mon_hoc_id,
                                'hoc_ky_id' => $phanCong->hoc_ky_id,
                                'loai_diem_id' => $loai_diem_id,
                                'diem_so' => $diem_so,
                                'giao_vien_id' => $giaoVien->id,
                            ]);
                        }

                    }

                }
            }
        }

        return redirect()->route('giaovien.diem.nhap-nhanh', ['phan_cong_id' => $request->phan_cong_id])
            ->with('success', 'Đã lưu điểm thành công! (Lưu ý: Các điểm đã có sẵn không bị ghi đè. Nếu muốn sửa điểm cũ, vui lòng bấm vào biểu tượng cây bút ở trang Tra cứu).');

    }
}