@extends('layouts.backend')
@section('title', 'Sửa Danh mục tài liệu')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Cập nhật Danh mục tài liệu</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.danh-muc-tai-lieu.update', $danhMuc->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="ten_danh_muc" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_danh_muc" name="ten_danh_muc" value="{{ old('ten_danh_muc', $danhMuc->ten_danh_muc) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="mo_ta" class="form-label">Mô tả thêm</label>
                <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3">{{ old('mo_ta', $danhMuc->mo_ta) }}</textarea>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
                <a href="{{ route('admin.danh-muc-tai-lieu.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection