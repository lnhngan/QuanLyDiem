@extends('layouts.backend')
@section('title', 'Sửa Tài liệu')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Cập nhật Tài liệu: {{ $taiLieu->ten_tai_lieu }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.tailieu.update', $taiLieu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="ten_tai_lieu" class="form-label">Tên tài liệu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ten_tai_lieu" name="ten_tai_lieu" value="{{ old('ten_tai_lieu', $taiLieu->ten_tai_lieu) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="danh_muc_id" class="form-label">Danh mục</label>
                    <select name="danh_muc_id" id="danh_muc_id" class="form-select">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($danhmucs as $dm)
                            <option value="{{ $dm->id }}" {{ $taiLieu->danh_muc_id == $dm->id ? 'selected' : '' }}>
                                {{ $dm->ten_danh_muc }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label for="mo_ta" class="form-label">Mô tả chi tiết</label>
                    <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3">{{ old('mo_ta', $taiLieu->mo_ta) }}</textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label d-block">File đính kèm hiện tại</label>
                    @if($taiLieu->file_path)
                        <div class="mb-2">
                            <a href="{{ asset('storage/'.$taiLieu->file_path) }}" target="_blank" class="badge bg-success text-decoration-none">
                                <i class="bi bi-file-earmark-check"></i> Xem file hiện hành
                            </a>
                        </div>
                    @else
                        <span class="text-muted mb-2 d-block">Chưa có file nào được tải lên.</span>
                    @endif
                    
                    <label for="file_upload" class="form-label">Tải lên file mới (Nếu muốn thay thế file cũ)</label>
                    <input type="file" class="form-control" id="file_upload" name="file_upload">
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
                <a href="{{ route('admin.tailieu.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection