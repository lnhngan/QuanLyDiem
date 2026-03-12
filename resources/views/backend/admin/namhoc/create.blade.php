@extends('layouts.backend')
@section('title', 'Thêm Năm học')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Thêm mới Năm học</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.namhoc.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="ten_nam_hoc" class="form-label">Tên năm học (VD: 2025-2026) <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('ten_nam_hoc') is-invalid @enderror" id="ten_nam_hoc" name="ten_nam_hoc" value="{{ old('ten_nam_hoc') }}" required>
                @error('ten_nam_hoc') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Lưu dữ liệu</button>
            <a href="{{ route('admin.namhoc.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection