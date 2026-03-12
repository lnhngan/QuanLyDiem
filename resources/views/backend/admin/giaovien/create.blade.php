@extends('layouts.backend')
@section('title', 'Thêm Giáo viên')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Thêm Giáo viên mới</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.giaovien.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mã Giáo viên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ma_gv" value="{{ old('ma_gv') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ho_ten" value="{{ old('ho_ten') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}">
                </div>
            </div>
            <hr><h6 class="mb-3">Tài khoản đăng nhập</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ten_dang_nhap" value="{{ old('ten_dang_nhap') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="mat_khau" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Lưu thông tin</button>
            <a href="{{ route('admin.giaovien.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection