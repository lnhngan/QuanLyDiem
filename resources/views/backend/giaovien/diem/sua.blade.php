@extends('layouts.backend')
@section('title', 'Yêu cầu sửa điểm')

@section('content')
    <div class="card border-warning">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Yêu cầu sửa điểm cho: <span
                    class="fw-bold">{{ $bangDiem->hocSinh->ho_ten }}</span></h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info shadow-sm">
                <i class="bi bi-info-circle"></i> Việc sửa điểm cần được Quản trị viên (Admin) xét duyệt. Vui lòng nhập điểm
                mới và lý do chính đáng để Admin xem xét.
            </div>

            <form action="{{ route('giaovien.diem.gui-yeu-cau', $bangDiem->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Môn học</label>
                        <input type="text" class="form-control bg-light" value="{{ $bangDiem->monHoc->ten_mon_hoc }}"
                            readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Loại điểm</label>
                        <input type="text" class="form-control bg-light" value="{{ $bangDiem->loaiDiem->ten_loai_diem }}"
                            readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Điểm hiện tại (Cũ)</label>
                        <input type="text" class="form-control bg-secondary text-white fw-bold"
                            value="{{ $bangDiem->diem_so }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label text-danger fw-bold">Điểm mới muốn đổi <span
                                class="text-danger">*</span></label>
                        <input type="number" step="0.1" min="0" max="10" class="form-control border-danger" name="diem_moi"
                            placeholder="Ví dụ: 8.5" required autofocus>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Lý do xin sửa điểm <span class="text-danger">*</span></label>
                        <textarea name="ly_do" rows="3" class="form-control"
                            placeholder="Ví dụ: Chấm sót điểm thành phần, Nhập nhầm điểm trên giấy..." required></textarea>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i> Gửi yêu cầu duyệt</button>
                <a href="{{ route('giaovien.diem.danh-sach') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
@endsection