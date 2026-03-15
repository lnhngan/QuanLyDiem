@extends('layouts.backend')
@section('title', 'Sửa điểm học sinh')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Cập nhật điểm cho: <span class="text-primary">{{ $bangDiem->hocSinh->ho_ten }}</span></h5>
    </div>
    <div class="card-body">
        <form action="{{ route('giaovien.diem.cap-nhat', $bangDiem->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Môn học</label>
                    <input type="text" class="form-control" value="{{ $bangDiem->monHoc->ten_mon_hoc }}" readonly disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Loại điểm <span class="text-danger">*</span></label>
                    <select name="loai_diem_id" class="form-select" required>
                        @foreach($loaiDiems as $ld)
                            <option value="{{ $ld->id }}" {{ $bangDiem->loai_diem_id == $ld->id ? 'selected' : '' }}>
                                {{ $ld->ten_loai_diem }} (Hệ số {{ $ld->he_so }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Điểm số <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" min="0" max="10" class="form-control" name="diem_so" value="{{ old('diem_so', $bangDiem->diem_so) }}" required>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Cập nhật điểm</button>
            <a href="{{ route('giaovien.diem.danh-sach') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection