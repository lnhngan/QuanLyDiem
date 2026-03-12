@extends('layouts.backend')
@section('title', 'Hồ sơ Giáo viên')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.giaovien.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Quay lại</a>
    <a href="{{ route('admin.giaovien.edit', $giaovien->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Sửa thông tin</a>
</div>
<div class="card">
    <div class="card-header bg-primary text-white"><h5 class="mb-0">Hồ sơ Giáo viên: {{ $giaovien->ho_ten }}</h5></div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th width="200">Mã GV</th><td><span class="badge bg-secondary">{{ $giaovien->ma_gv }}</span></td></tr>
            <tr><th>Họ tên</th><td class="fw-bold">{{ $giaovien->ho_ten }}</td></tr>
            <tr><th>Email</th><td>{{ $giaovien->email ?? 'Chưa cập nhật' }}</td></tr>
            <tr><th>Số điện thoại</th><td>{{ $giaovien->so_dien_thoai ?? 'Chưa cập nhật' }}</td></tr>
            <tr><th>Tài khoản hệ thống</th><td>{{ $giaovien->taiKhoan->ten_dang_nhap ?? 'N/A' }} 
                @if($giaovien->taiKhoan && $giaovien->taiKhoan->trang_thai) <span class="badge bg-success ms-2">Hoạt động</span>
                @else <span class="badge bg-danger ms-2">Khóa</span> @endif
            </td></tr>
        </table>
    </div>
</div>
@endsection