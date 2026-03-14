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
                    <label class="form-label">Tiêu đề tài liệu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="tieu_de" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                    <select name="danh_muc_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($danhMucs as $dm)
                            <option value="{{ $dm->id }}">{{ $dm->ten_danh_muc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Môn học <span class="text-danger">*</span></label>
                    <select name="mon_hoc_id" class="form-select" required>
                        <option value="">-- Chọn môn học --</option>
                        @foreach($monHocs as $mh)
                            <option value="{{ $mh->id }}">{{ $mh->ten_mon_hoc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Khối lớp <span class="text-danger">*</span></label>
                    <select name="khoi_lop_id" class="form-select" required>
                        <option value="">-- Chọn khối lớp --</option>
                        @foreach($khoiLops as $kl)
                            <option value="{{ $kl->id }}">{{ $kl->ten_khoi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giáo viên đăng <span class="text-danger">*</span></label>
                    <select name="giao_vien_id" class="form-select" required>
                        <option value="">-- Chọn giáo viên --</option>
                        @foreach($giaoviens as $gv)
                            <option value="{{ $gv->id }}">{{ $gv->ho_ten }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Mô tả chi tiết</label>
                    <textarea class="form-control" name="mo_ta" rows="3"></textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">File đính kèm (PDF, DOCX, ZIP...) <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="file" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-arrow-up"></i> Upload Tài liệu</button>
            <a href="{{ route('admin.tailieu.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection