@extends('layouts.backend')
@section('title', 'Nhập điểm cá nhân')

@section('content')
<div class="card border-primary mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Nhập điểm cho từng học sinh</h5>
        <a href="{{ route('giaovien.diem.nhap-nhanh') }}" class="btn btn-warning btn-sm text-dark fw-bold">
            <i class="bi bi-grid-3x3"></i> Chuyển sang Nhập Bảng Lưới
        </a>
    </div>
    <div class="card-body">
        
        <div id="thongBao" class="alert d-none" role="alert"></div>

        <form id="formNhapDiem">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Chọn lớp & Môn <span class="text-danger">*</span></label>
                    <select class="form-select" name="phan_cong_id" id="phan_cong_id" required>
                        <option value="">-- Chọn phân công giảng dạy --</option>
                        @foreach($phanCongs as $pc)
                            <option value="{{ $pc->id }}">Lớp {{ $pc->lopHoc->ten_lop }} - {{ $pc->monHoc->ten_mon_hoc }} - {{ $pc->hocKy->ten_hoc_ky }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Học sinh <span class="text-danger">*</span></label>
                    <select class="form-select" name="hoc_sinh_id" id="hoc_sinh_id" required disabled>
                        <option value="">-- Vui lòng chọn Lớp trước --</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Loại điểm <span class="text-danger">*</span></label>
                    <select class="form-select" name="loai_diem_id" id="loai_diem_id" required>
                        <option value="">-- Chọn loại điểm --</option>
                        @foreach($loaiDiems as $ld)
                            <option value="{{ $ld->id }}">{{ $ld->ten_loai_diem }} (Hệ số {{ $ld->he_so }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Điểm số <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" min="0" max="10" name="diem_so" id="diem_so" class="form-control" placeholder="Ví dụ: 8.5" required>
                </div>
            </div>
            
            <hr>
            <button type="submit" class="btn btn-success px-4" id="btnLuu">
                <i class="bi bi-save"></i> Lưu Điểm
            </button>
            <a href="{{ route('giaovien.diem.danh-sach') }}" class="btn btn-secondary px-4">
                Quay lại danh sách
            </a>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const phanCongSelect = document.getElementById('phan_cong_id');
    const hocSinhSelect = document.getElementById('hoc_sinh_id');
    const form = document.getElementById('formNhapDiem');
    const thongBao = document.getElementById('thongBao');

    // --- SỰ KIỆN 1: KHI GIÁO VIÊN CHỌN LỚP ---
    phanCongSelect.addEventListener('change', function() {
        const pcId = this.value;
        
        // Nếu chọn lại ô trống thì khóa ô Học sinh
        if (!pcId) {
            hocSinhSelect.innerHTML = '<option value="">-- Vui lòng chọn Lớp trước --</option>';
            hocSinhSelect.disabled = true;
            return;
        }

        // Hiện trạng thái đang tải
        hocSinhSelect.innerHTML = '<option value="">Đang tải danh sách học sinh...</option>';
        hocSinhSelect.disabled = true;

        // Gọi AJAX lấy danh sách học sinh của lớp đó
        fetch(`{{ route('giaovien.diem.get-hoc-sinh') }}?phan_cong_id=${pcId}`)
            .then(response => response.json())
            .then(data => {
                hocSinhSelect.innerHTML = '<option value="">-- Chọn học sinh --</option>';
                if(data.length === 0) {
                    hocSinhSelect.innerHTML = '<option value="">Lớp này chưa có học sinh nào</option>';
                } else {
                    data.forEach(hs => {
                        hocSinhSelect.innerHTML += `<option value="${hs.id}">${hs.ma_hs} - ${hs.ho_ten}</option>`;
                    });
                    hocSinhSelect.disabled = false; // Mở khóa ô học sinh
                }
            })
            .catch(error => {
                alert('Lỗi: Không thể tải danh sách học sinh!');
            });
    });

    // --- SỰ KIỆN 2: KHI GIÁO VIÊN BẤM NÚT LƯU ĐIỂM ---
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Ngăn trình duyệt tự động tải lại trang
        
        // Ẩn thông báo cũ (nếu có)
        thongBao.classList.add('d-none');
        
        let formData = new FormData(this);

        fetch(`{{ route('giaovien.diem.luu') }}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(async response => {
            const data = await response.json().catch(() => null); 
            if (!response.ok) {
                let errorMsg = data?.message || 'Có lỗi hệ thống xảy ra, vui lòng thử lại.';
                if (data?.errors) {
                    errorMsg = Object.values(data.errors).flat().join('<br>'); 
                }
                throw new Error(errorMsg);
            }
            return data;
        })
        .then(data => {
            if(data.success) {
                // Hiện thông báo màu xanh
                thongBao.className = 'alert alert-success';
                thongBao.innerHTML = '<i class="bi bi-check-circle-fill"></i> ' + data.message;
                thongBao.classList.remove('d-none');
                
                // Xóa điểm cũ để nhập tiếp cho học sinh khác, tự động focus vào ô chọn học sinh
                document.getElementById('diem_so').value = ''; 
                document.getElementById('hoc_sinh_id').focus(); 
            }
        })
        .catch(error => {
            // Hiện thông báo màu đỏ
            thongBao.className = 'alert alert-danger';
            thongBao.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> ' + error.message;
            thongBao.classList.remove('d-none');
        });
    });
});
</script>
@endsection