@extends('layouts.backend')
@section('title', 'Hồ sơ Học sinh')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.hocsinh.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Quay lại</a>
</div>
<div class="card">
    <div class="card-header bg-primary text-white"><h5 class="mb-0">Hồ sơ Học sinh: {{ $hocsinh->ho_ten }}</h5></div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th width="200">Mã HS</th><td><span class="badge bg-secondary">{{ $hocsinh->ma_hoc_sinh }}</span></td></tr>
            <tr><th>Họ tên</th><td class="fw-bold">{{ $hocsinh->ho_ten }}</td></tr>
            <tr><th>Ngày sinh</th><td>{{ \Carbon\Carbon::parse($hocsinh->ngay_sinh)->format('d/m/Y') }}</td></tr>
            <tr><th>Giới tính</th><td>{{ $hocsinh->gioi_tinh ? 'Nam' : 'Nữ' }}</td></tr>
            <tr><th>Lớp học</th><td>{{ $hocsinh->lopHoc->ten_lop ?? 'Chưa cập nhật' }}</td></tr>
            <tr><th>Tài khoản</th><td>{{ $hocsinh->taiKhoan->ten_dang_nhap ?? 'N/A' }}</td></tr>
        </table>
    </div>
</div>
@endsection