@extends('layouts.backend')
@section('title', 'Sửa Loại điểm')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Cập nhật Loại Điểm</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.loai-diem.update', $loaiDiem->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="ten_loai_diem" class="form-label">Tên loại điểm <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_loai_diem" name="ten_loai_diem" value="{{ old('ten_loai_diem', $loaiDiem->ten_loai_diem) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="he_so" class="form-label">Hệ số <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="he_so" name="he_so" value="{{ old('he_so', $loaiDiem->he_so) }}" min="1" required>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
                <a href="{{ route('admin.loai-diem.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection