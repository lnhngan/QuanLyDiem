@extends('layouts.backend')
@section('title', 'Tạo Phân công')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Phân công giảng dạy</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.phan-cong.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Giáo viên <span class="text-danger">*</span></label>
                    <select class="form-select" name="giao_vien_id" required>
                        <option value="">-- Chọn Giáo viên --</option>
                        @foreach($giaoviens as $gv)
                            <option value="{{ $gv->id }}">{{ $gv->ho_ten }} - {{ $gv->ma_gv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Môn học <span class="text-danger">*</span></label>
                    <select class="form-select" name="mon_hoc_id" required>
                        <option value="">-- Chọn Môn học --</option>
                        @foreach($monhocs as $mon)
                            <option value="{{ $mon->id }}">{{ $mon->ten_mon_hoc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Lớp học <span class="text-danger">*</span></label>
                    <select class="form-select" name="lop_hoc_id" required>
                        <option value="">-- Chọn Lớp học --</option>
                        @foreach($lophocs as $lop)
                            <option value="{{ $lop->id }}">{{ $lop->ten_lop }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Năm học <span class="text-danger">*</span></label>
                    <select class="form-select" name="nam_hoc_id" required>
                        <option value="">-- Chọn Năm học --</option>
                        @foreach($namhocs as $nh)
                            <option value="{{ $nh->id }}">{{ $nh->ten_nam_hoc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Phân công</button>
            <a href="{{ route('admin.phan-cong.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection