@extends('layouts.backend')
@section('title', 'Chi tiết tài liệu')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-file-earmark-text"></i> {{ $taiLieu->tieu_de ?? 'Tên tài liệu' }}</h5>
        <a href="javascript:history.back()" class="btn btn-sm btn-light text-primary fw-bold"><i class="bi bi-arrow-left"></i> Trở về</a>
    </div>
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-8 border-end pe-4">
                <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-card-text"></i> Nội dung mô tả</h5>
                <div class="p-3 bg-light rounded text-dark" style="min-height: 150px; font-size: 1.05rem;">
                    {!! nl2br(e($taiLieu->mo_ta ?? '')) ?: '<em class="text-muted">Tài liệu này không có mô tả đi kèm.</em>' !!}
                </div>
            </div>
            
            <div class="col-md-4 ps-4">
                <h5 class="fw-bold text-secondary mb-3">Thông tin chi tiết</h5>
                <ul class="list-group list-group-flush mb-4 shadow-sm border rounded">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">Môn học:</span>
                        <span class="fw-bold text-primary">{{ $taiLieu->monHoc->ten_mon_hoc ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">Giáo viên tải lên:</span>
                        <span class="fw-bold text-dark">{{ $taiLieu->giaoVien->ho_ten ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">Ngày đăng:</span>
                        <span>{{ isset($taiLieu->created_at) ? $taiLieu->created_at->format('d/m/Y H:i') : '' }}</span>
                    </li>
                </ul>

                <div class="card border-success shadow-sm">
                    <div class="card-body text-center bg-success-subtle rounded">
                        <i class="bi bi-cloud-arrow-down text-success mb-2" style="font-size: 3.5rem;"></i>
                        <h6 class="mt-2 fw-bold text-success">File tài liệu đính kèm</h6>
                        @if(isset($taiLieu->duong_dan_file))
                            <a href="{{ Storage::url($taiLieu->duong_dan_file) }}" target="_blank" class="btn btn-success mt-3 w-100 fw-bold shadow-sm">
                                <i class="bi bi-download"></i> Nhấn để Tải Về
                            </a>
                        @else
                            <button disabled class="btn btn-secondary mt-3 w-100">Không có file đính kèm</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection