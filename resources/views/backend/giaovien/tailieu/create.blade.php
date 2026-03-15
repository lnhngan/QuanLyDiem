@extends('layouts.backend')
@section('title', 'Đăng tài liệu')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Đăng tải tài liệu mới</h5></div>
    <div class="card-body">
        <form action="{{ route('giaovien.tailieu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="tieu_de" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Danh mục <span class="text-danger">*</span></label>
                    <select name="danh_muc_id" class="form-select" required>
                        @foreach($danhMucs as $dm)<option value="{{ $dm->id }}">{{ $dm->ten_danh_muc }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Môn học <span class="text-danger">*</span></label>
                    <select name="mon_hoc_id" class="form-select" required>
                        @foreach($monHocs as $mh)<option value="{{ $mh->id }}">{{ $mh->ten_mon_hoc }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Khối lớp <span class="text-danger">*</span></label>
                    <select name="khoi_lop_id" class="form-select" required>
                        @foreach($khoiLops as $kl)<option value="{{ $kl->id }}">{{ $kl->ten_khoi }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label>File đính kèm (PDF, DOCX, PPTX... Tối đa 10MB) <span class="text-danger">*</span></label>
                    <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Mô tả thêm</label>
                    <textarea name="mo_ta" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Tải lên</button>
            <a href="{{ route('giaovien.tailieu.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection