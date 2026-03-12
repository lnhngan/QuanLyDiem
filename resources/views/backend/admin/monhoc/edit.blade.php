@extends('layouts.backend')
@section('title', 'Sửa Môn học')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Cập nhật Môn học</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.monhoc.update', $monhoc->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Mã Môn <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ma_mon" value="{{ $monhoc->ma_mon }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tên Môn học <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ten_mon_hoc" value="{{ $monhoc->ten_mon_hoc }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Số tiết</label>
                    <input type="number" class="form-control" name="so_tiet" value="{{ $monhoc->so_tiet }}" min="1">
                </div>
            </div>
            <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
            <a href="{{ route('admin.monhoc.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection