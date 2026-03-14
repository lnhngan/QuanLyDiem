@extends('layouts.backend')
@section('title', 'Sửa Lớp học')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Cập nhật Lớp học: {{ $lophoc->ten_lop }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.lophoc.update', $lophoc->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="ten_lop" class="form-label">Tên lớp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ten_lop" name="ten_lop" value="{{ old('ten_lop', $lophoc->ten_lop) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="khoi_lop_id" class="form-label">Khối lớp <span class="text-danger">*</span></label>
                    <select class="form-select" id="khoi_lop_id" name="khoi_lop_id" required>
                        <option value="">-- Chọn Khối lớp --</option>
                        @foreach($khoilops as $khoi)
                            <option value="{{ $khoi->id }}" {{ (old('khoi_lop_id') ?? $lophoc->khoi_lop_id) == $khoi->id ? 'selected' : '' }}>
                                {{ $khoi->ten_khoi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nam_hoc_id" class="form-label">Năm học <span class="text-danger">*</span></label>
                    <select class="form-select" id="nam_hoc_id" name="nam_hoc_id" required>
                        <option value="">-- Chọn Năm học --</option>
                        @foreach($namhocs as $nam)
                            <option value="{{ $nam->id }}" {{ (old('nam_hoc_id') ?? $lophoc->nam_hoc_id) == $nam->id ? 'selected' : '' }}>
                                {{ $nam->ten_nam_hoc }}
                            </option>
                        @endforeach
                    </select>
                </div>

               <div class="col-md-6 mb-3">
                    <label for="gv_chu_nhiem_id" class="form-label">Giáo viên chủ nhiệm</label>
                    <select class="form-select" id="gv_chu_nhiem_id" name="gv_chu_nhiem_id">
                        <option value="">-- Chưa phân công --</option>
                        @foreach($giaoviens as $gv)
                            <option value="{{ $gv->id }}" {{ (old('gv_chu_nhiem_id') ?? $lophoc->gv_chu_nhiem_id) == $gv->id ? 'selected' : '' }}>
                                {{ $gv->ho_ten }} ({{ $gv->ma_gv }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Cập nhật</button>
                <a href="{{ route('admin.lophoc.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection