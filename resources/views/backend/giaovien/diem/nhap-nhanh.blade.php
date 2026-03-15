@extends('layouts.backend')
@section('title', 'Nhập điểm cá nhân')

@section('content')
<div class="card border-primary">
    <div class="card-header bg-primary text-white"><h5 class="mb-0">Nhập điểm cho từng học sinh</h5></div>
    <div class="card-body">
        
        <div id="thongBao" class="alert d-none"></div>

        <form id="formNhapDiem">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Chọn lớp & Môn <span class="text-danger">*</span></label>
                    <select class="form-select" name="phan_cong_id" id="phan_cong_id" required>
                        <option value="">-- Chọn phân công --</option>
                        @foreach($phanCongs as $pc)
                            <option value="{{ $pc->id }}">Lớp {{ $pc->lopHoc->ten_lop }} - {{ $pc->monHoc->ten_mon_hoc }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Học sinh <span class="text-danger">*</span></label>
                    <select class="form-select" name="hoc_sinh_id" id="hoc_sinh_id" required disabled>
                        <option value="">-- Vui lòng chọn Lớp trước --</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Loại điểm <span class="text-danger">*</span></label>
                    <select class="form-select" name="loai_diem_id" id="loai_diem_id" required>
                        <option value="">-- Chọn loại điểm --</option>
                        @foreach($loaiDiems as $ld)
                            <option value="{{ $ld->id }}">{{ $ld->ten_loai_diem }} (Hệ số {{ $ld->he_so }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Điểm số <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" min="0" max="10" name="diem_so" id="diem_so" class="form-control" placeholder="Ví dụ: 8.5" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-success" id="btnLuu"><i class="bi bi-save"></i> Lưu Điểm</button>
            <a href="{{ route('giaovien.diem.nhap-nhanh') }}" class="btn btn-secondary">Chuyển sang Nhập Bảng Lưới</a>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const phanCongSelect = document.getElementById('phan_cong_id');
    const hocSinhSelect = document.getElementById('hoc_sinh_id');
    const form = document.getElementById('formNhapDiem');
    const thongBao = document.getElementById('thongBao');

    // 1. Lắng nghe sự kiện khi chọn Lớp
    phanCongSelect.addEventListener('change', function() {
        const pcId = this.value;
        if (!pcId) {
            hocSinhSelect.innerHTML = '<option value="">-- Vui lòng chọn Lớp trước --</option>';
            hocSinhSelect.disabled = true;
            return;
        }

        // Hiện loading
        hocSinhSelect.innerHTML = '<option value="">Đang tải danh sách...</option>';
        hocSinhSelect.disabled = true;

        // Gọi AJAX lấy danh sách học sinh
        fetch(`{{ route('giaovien.diem.get-hoc-sinh') }}?phan_cong_id=${pcId}`)
            .then(response => response.json())
            .then(data => {
                hocSinhSelect.innerHTML = '<option value="">-- Chọn học sinh --</option>';
                if(data.length === 0) {
                    hocSinhSelect.innerHTML = '<option value="">Lớp chưa có học sinh</option>';
                } else {
                    data.forEach(hs => {
                        hocSinhSelect.innerHTML += `<option value="${hs.id}">${hs.ma_hs} - ${hs.ho_ten}</option>`;
                    });
                    hocSinhSelect.disabled = false;
                }
            });
    });

    // 2. Lắng nghe sự kiện Submit Form (Lưu điểm)
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Chặn tải lại trang
        
        let formData = new FormData(this);

        fetch(`{{ route('giaovien.diem.luu') }}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                thongBao.className = 'alert alert-success';
                thongBao.innerHTML = '<i class="bi bi-check-circle"></i> ' + data.message;
                thongBao.classList.remove('d-none');
                
                // Xóa số điểm vừa nhập để nhập người tiếp theo, giữ nguyên chọn lớp/học sinh
                document.getElementById('diem_so').value = ''; 
                document.getElementById('hoc_sinh_id').focus();
            }
        })
        .catch(error => {
            thongBao.className = 'alert alert-danger';
            thongBao.innerHTML = '<i class="bi bi-exclamation-triangle"></i> Có lỗi xảy ra, vui lòng kiểm tra lại!';
            thongBao.classList.remove('d-none');
        });
    });
});
</script>
@endsection