@extends('layouts.backend')
@section('title', 'Thêm Học sinh')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Thêm Học sinh mới</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.hocsinh.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Mã Học sinh <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ma_hoc_sinh" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ho_ten" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="ngay_sinh" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Giới tính</label>
                    <select name="gioi_tinh" class="form-select">
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Lớp học</label>
                    <select name="lop_id" class="form-select">
                        <option value="">-- Chọn Lớp --</option>
                        @foreach($lophocs as $lop)
                            <option value="{{ $lop->id }}">{{ $lop->ten_lop }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="dia_chi">
                </div>
            </div>
            <hr><h6 class="mb-3">Tài khoản đăng nhập</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ten_dang_nhap" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="mat_khau" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Lưu thông tin</button>
            <a href="{{ route('admin.hocsinh.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection