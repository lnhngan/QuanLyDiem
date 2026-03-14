@extends('layouts.backend')
@section('title', 'Sửa Tài liệu')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Cập nhật Tài liệu: {{ $tailieu->tieu_de }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.tailieu.update', $tailieu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tiêu đề tài liệu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="tieu_de" value="{{ old('tieu_de', $tailieu->tieu_de) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                    <select name="danh_muc_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($danhMucs as $dm)
                            <option value="{{ $dm->id }}" {{ $tailieu->danh_muc_id == $dm->id ? 'selected' : '' }}>{{ $dm->ten_danh_muc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Môn học <span class="text-danger">*</span></label>
                    <select name="mon_hoc_id" class="form-select" required>
                        <option value="">-- Chọn môn học --</option>
                        @foreach($monHocs as $mh)
                            <option value="{{ $mh->id }}" {{ $tailieu->mon_hoc_id == $mh->id ? 'selected' : '' }}>{{ $mh->ten_mon_hoc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Khối lớp <span class="text-danger">*</span></label>
                    <select name="khoi_lop_id" class="form-select" required>
                        <option value="">-- Chọn khối lớp --</option>
                        @foreach($khoiLops as $kl)
                            <option value="{{ $kl->id }}" {{ $tailieu->khoi_lop_id == $kl->id ? 'selected' : '' }}>{{ $kl->ten_khoi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giáo viên đăng <span class="text-danger">*</span></label>
                    <select name="giao_vien_id" class="form-select" required>
                        <option value="">-- Chọn giáo viên --</option>
                        @foreach($giaoviens as $gv)
                            <option value="{{ $gv->id }}" {{ $tailieu->giao_vien_id == $gv->id ? 'selected' : '' }}>{{ $gv->ho_ten }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Mô tả chi tiết</label>
                    <textarea class="form-control" name="mo_ta" rows="3">{{ old('mo_ta', $tailieu->mo_ta) }}</textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label d-block">File đính kèm hiện tại</label>
                    @if($tailieu->duong_dan_file)
                        <div class="mb-2">
                            <a href="{{ asset('storage/'.$tailieu->duong_dan_file) }}" target="_blank" class="badge bg-success text-decoration-none">
                                <i class="bi bi-download"></i> Xem file hiện hành
                            </a>
                        </div>
                    @else
                        <span class="text-muted mb-2 d-block">Chưa có file</span>
                    @endif
                    <label class="form-label">Tải lên file mới (Nếu muốn thay file cũ)</label>
                    <input type="file" class="form-control" name="file">
                </div>
            </div>
            <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
            <a href="{{ route('admin.tailieu.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection