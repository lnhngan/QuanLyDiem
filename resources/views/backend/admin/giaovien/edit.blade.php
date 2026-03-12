@extends('layouts.backend')

@section('title', 'Sửa giáo viên')
@section('page-title', 'Chỉnh sửa thông tin giáo viên')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Thông tin giáo viên</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.giaovien.update', $giaovien->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ho_ten" class="form-label">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('ho_ten') is-invalid @enderror" 
                           id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $giaovien->ho_ten) }}" required>
                    @error('ho_ten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $giaovien->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="so_dien_thoai" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror" 
                           id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai', $giaovien->so_dien_thoai) }}" required>
                    @error('so_dien_thoai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="trang_thai" class="form-label">Trạng thái</label>
                    <select class="form-select" id="trang_thai" name="trang_thai">
                        <option value="1" {{ $giaovien->taiKhoan && $giaovien->taiKhoan->trang_thai ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $giaovien->taiKhoan && !$giaovien->taiKhoan->trang_thai ? 'selected' : '' }}>Khóa</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.giaovien.index') }}" class="btn btn-secondary me-2">Hủy</a>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
@endsection