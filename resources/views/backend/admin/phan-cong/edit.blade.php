@extends('layouts.backend')
@section('title', 'Sửa Phân công')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Sửa Phân công giảng dạy</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.phan-cong.update', $phancong->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Giáo viên <span class="text-danger">*</span></label>
                    <select class="form-select" name="giao_vien_id" required>
                        @foreach($giaoviens as $gv)
                            <option value="{{ $gv->id }}" {{ $phancong->giao_vien_id == $gv->id ? 'selected' : '' }}>{{ $gv->ho_ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Môn học <span class="text-danger">*</span></label>
                    <select class="form-select" name="mon_hoc_id" required>
                        @foreach($monhocs as $mon)
                            <option value="{{ $mon->id }}" {{ $phancong->mon_hoc_id == $mon->id ? 'selected' : '' }}>{{ $mon->ten_mon_hoc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Lớp học <span class="text-danger">*</span></label>
                    <select class="form-select" name="lop_hoc_id" required>
                        @foreach($lophocs as $lop)
                            <option value="{{ $lop->id }}" {{ $phancong->lop_hoc_id == $lop->id ? 'selected' : '' }}>{{ $lop->ten_lop }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Năm học <span class="text-danger">*</span></label>
                    <select class="form-select" name="nam_hoc_id" required>
                        @foreach($namhocs as $nh)
                            <option value="{{ $nh->id }}" {{ $phancong->nam_hoc_id == $nh->id ? 'selected' : '' }}>{{ $nh->ten_nam_hoc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
            <a href="{{ route('admin.phan-cong.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection