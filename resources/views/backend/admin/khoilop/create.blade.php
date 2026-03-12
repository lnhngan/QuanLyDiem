@extends('layouts.backend')
@section('title', 'Thêm Khối lớp')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Thêm mới Khối lớp</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.khoilop.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên Khối (VD: Khối 10) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ten_khoi" value="{{ old('ten_khoi') }}" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Lưu</button>
            <a href="{{ route('admin.khoilop.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection