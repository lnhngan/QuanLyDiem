@extends('layouts.backend')
@section('title', 'Chi tiết Tài liệu')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.tailieu.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Quay về danh sách</a>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Thông tin Tài liệu</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="200">Tên tài liệu:</th>
                <td class="fw-bold text-primary text-uppercase">{{ $taiLieu->ten_tai_lieu }}</td>
            </tr>
            <tr>
                <th>Danh mục:</th>
                <td>{{ $taiLieu->danhMuc->ten_danh_muc ?? 'Chưa phân loại' }}</td>
            </tr>
            <tr>
                <th>Người đăng (Giáo viên):</th>
                <td>{{ $taiLieu->giaoVien->ho_ten ?? 'Quản trị viên (Admin)' }}</td>
            </tr>
            <tr>
                <th>Mô tả tài liệu:</th>
                <td>{!! nl2br(e($taiLieu->mo_ta ?? 'Không có mô tả chi tiết')) !!}</td>
            </tr>
            <tr>
                <th>File đính kèm:</th>
                <td>
                    @if($taiLieu->file_path)
                        <a href="{{ asset('storage/'.$taiLieu->file_path) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="bi bi-download"></i> Tải tài liệu xuống
                        </a>
                    @else
                        <span class="text-danger">Tài liệu này không đính kèm file.</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ngày tải lên:</th>
                <td>{{ $taiLieu->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection