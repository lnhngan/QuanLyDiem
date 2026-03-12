@extends('layouts.backend')
@section('title', 'Sửa Giáo viên')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Cập nhật giáo viên: {{ $giaovien->ho_ten }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.giaovien.update', $giaovien->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mã Giáo viên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ma_gv" value="{{ old('ma_gv', $giaovien->ma_gv) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ho_ten" value="{{ old('ho_ten', $giaovien->ho_ten) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $giaovien->email) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="so_dien_thoai" value="{{ old('so_dien_thoai', $giaovien->so_dien_thoai) }}">
                </div>
            </div>
            <hr><h6 class="mb-3">Tài khoản (Để trống MK nếu không đổi)</h6>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" value="{{ $giaovien->taiKhoan->ten_dang_nhap ?? '' }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="mat_khau">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="trang_thai" class="form-select">
                        <option value="1" {{ ($giaovien->taiKhoan->trang_thai ?? 1) == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ ($giaovien->taiKhoan->trang_thai ?? 1) == 0 ? 'selected' : '' }}>Khóa</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
            <a href="{{ route('admin.giaovien.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection