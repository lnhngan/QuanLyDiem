@extends('layouts.backend')
@section('title', 'Sửa Năm học')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Cập nhật Năm học</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.namhoc.update', $namhoc->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="ten_nam_hoc" class="form-label">Tên năm học <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('ten_nam_hoc') is-invalid @enderror" id="ten_nam_hoc" name="ten_nam_hoc" value="{{ old('ten_nam_hoc', $namhoc->ten_nam_hoc) }}" required>
                @error('ten_nam_hoc') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
            <a href="{{ route('admin.namhoc.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection