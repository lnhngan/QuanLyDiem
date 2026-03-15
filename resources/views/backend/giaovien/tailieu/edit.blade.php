@extends('layouts.backend')
@section('title', 'Sửa tài liệu')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Cập nhật tài liệu: <span class="text-primary">{{ $tailieu->tieu_de }}</span></h5>
    </div>
    <div class="card-body">
        <form action="{{ route('giaovien.tailieu.update', $tailieu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="tieu_de" class="form-control" value="{{ old('tieu_de', $tailieu->tieu_de) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                    <select name="danh_muc_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($danhMucs as $dm)
                            <option value="{{ $dm->id }}" {{ (old('danh_muc_id') ?? $tailieu->danh_muc_id) == $dm->id ? 'selected' : '' }}>
                                {{ $dm->ten_danh_muc }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Môn học <span class="text-danger">*</span></label>
                    <select name="mon_hoc_id" class="form-select" required>
                        <option value="">-- Chọn môn học --</option>
                        @foreach($monHocs as $mh)
                            <option value="{{ $mh->id }}" {{ (old('mon_hoc_id') ?? $tailieu->mon_hoc_id) == $mh->id ? 'selected' : '' }}>
                                {{ $mh->ten_mon_hoc }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Khối lớp <span class="text-danger">*</span></label>
                    <select name="khoi_lop_id" class="form-select" required>
                        <option value="">-- Chọn khối lớp --</option>
                        @foreach($khoiLops as $kl)
                            <option value="{{ $kl->id }}" {{ (old('khoi_lop_id') ?? $tailieu->khoi_lop_id) == $kl->id ? 'selected' : '' }}>
                                {{ $kl->ten_khoi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">File đính kèm (Bỏ trống nếu không muốn thay đổi file cũ)</label>
                    <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                    <small class="text-muted mt-1 d-block">
                        <i class="bi bi-paperclip"></i> File hiện tại: <a href="{{ Storage::url($tailieu->duong_dan_file) }}" target="_blank">Xem file đang có</a>
                    </small>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Mô tả thêm</label>
                    <textarea name="mo_ta" class="form-control" rows="4">{{ old('mo_ta', $tailieu->mo_ta) }}</textarea>
                </div>
            </div>
            
            <hr>
            <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Lưu thay đổi</button>
            <a href="{{ route('giaovien.tailieu.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection