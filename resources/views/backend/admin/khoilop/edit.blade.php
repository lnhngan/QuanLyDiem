@extends('layouts.backend')
@section('title', 'Sửa Khối lớp')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Cập nhật Khối lớp</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.khoilop.update', $khoilop->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên Khối <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ten_khoi" value="{{ old('ten_khoi', $khoilop->ten_khoi) }}" required>
            </div>
            <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
            <a href="{{ route('admin.khoilop.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection