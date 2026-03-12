@extends('layouts.backend')
@section('title', 'Thêm Loại điểm')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Thêm Loại Điểm Mới</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.loai-diem.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="ten_loai_diem" class="form-label">Tên loại điểm (VD: Điểm 15 phút, Điểm 1 tiết) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_loai_diem" name="ten_loai_diem" value="{{ old('ten_loai_diem') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="he_so" class="form-label">Hệ số (VD: 1, 2, 3) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="he_so" name="he_so" value="1" min="1" required>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Lưu thông tin</button>
                <a href="{{ route('admin.loai-diem.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection