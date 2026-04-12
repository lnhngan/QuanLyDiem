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
                    <input type="text" class="form-control" name="ma_hoc_sinh" value="{{ old('ma_hoc_sinh') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ho_ten" value="{{ old('ho_ten') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="ngay_sinh" value="{{ old('ngay_sinh') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Giới tính</label>
                    <select name="gioi_tinh" class="form-select">
                        <option value="1" {{ old('gioi_tinh') == '1' ? 'selected' : '' }}>Nam</option>
                        <option value="0" {{ old('gioi_tinh') == '0' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Lớp học <span class="text-danger">*</span></label>
                    <select name="lop_id" class="form-select" required>
                        <option value="">-- Chọn Lớp --</option>
                        @foreach($lophocs as $lop)
                            <option value="{{ $lop->id }}" {{ old('lop_id') == $lop->id ? 'selected' : '' }}>{{ $lop->ten_lop }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">SĐT Phụ huynh</label>
                    <input type="text" class="form-control" name="sdt_phu_huynh" value="{{ old('sdt_phu_huynh') }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="dia_chi" value="{{ old('dia_chi') }}">
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
                    <input type="password" class="form-control" name="mat_khau" value="123456" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Lưu thông tin</button>
            <a href="{{ route('admin.hocsinh.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection