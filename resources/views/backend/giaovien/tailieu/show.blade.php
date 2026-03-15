@extends('layouts.backend')
@section('title', 'Chi tiết tài liệu')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Thông tin chi tiết tài liệu</h5>
        <div>
            <a href="{{ route('giaovien.tailieu.edit', $tailieu->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Sửa</a>
            <a href="{{ route('giaovien.tailieu.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Quay lại</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 30%;" class="bg-light">Tiêu đề:</th>
                            <td class="fw-bold text-primary">{{ $tailieu->tieu_de }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Danh mục:</th>
                            <td><span class="badge bg-info text-dark">{{ $tailieu->danhMuc->ten_danh_muc ?? 'Không có' }}</span></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Môn học áp dụng:</th>
                            <td>{{ $tailieu->monHoc->ten_mon_hoc ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Khối lớp:</th>
                            <td>{{ $tailieu->khoiLop->ten_khoi ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Ngày đăng:</th>
                            <td>{{ $tailieu->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Cập nhật lần cuối:</th>
                            <td>{{ $tailieu->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-4">
                    <h6 class="fw-bold">Mô tả chi tiết:</h6>
                    <div class="p-3 bg-light border rounded">
                        {!! nl2br(e($tailieu->mo_ta)) ?: '<em class="text-muted">Không có mô tả</em>' !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-header bg-info text-white fw-bold">
                        <i class="bi bi-file-earmark-text"></i> File đính kèm
                    </div>
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 4rem;"></i>
                        <p class="mt-3">Nhấn vào nút bên dưới để xem hoặc tải xuống tài liệu gốc.</p>
                        <a href="{{ Storage::url($tailieu->duong_dan_file) }}" target="_blank" class="btn btn-success w-100">
                            <i class="bi bi-cloud-download"></i> Xem / Tải Xuống
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection