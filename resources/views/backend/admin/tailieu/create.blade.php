@extends('layouts.backend')
@section('title', 'Thêm Tài liệu')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Upload Tài liệu mới</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.tailieu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên tài liệu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ten_tai_lieu" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="danh_muc_id" class="form-select">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($danhmucs as $dm)
                            <option value="{{ $dm->id }}">{{ $dm->ten_danh_muc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Mô tả chi tiết</label>
                    <textarea class="form-control" name="mo_ta" rows="3"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">File đính kèm (PDF, DOCX, ZIP...)</label>
                    <input type="file" class="form-control" name="file_upload">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-arrow-up"></i> Upload</button>
            <a href="{{ route('admin.tailieu.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection