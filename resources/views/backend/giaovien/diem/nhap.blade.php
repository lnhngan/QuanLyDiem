@extends('layouts.backend')
@section('title', 'Nhập điểm')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Nhập điểm cá nhân</h5></div>
    <div class="card-body">
        <form id="formNhapDiem">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Chọn lớp & Môn phân công <span class="text-danger">*</span></label>
                    <select class="form-select" name="phan_cong_id" id="phan_cong_id" required>
                        <option value="">-- Chọn phân công --</option>
                        @foreach($phanCongs as $pc)
                            <option value="{{ $pc->id }}">Lớp {{ $pc->lopHoc->ten_lop }} - {{ $pc->monHoc->ten_mon_hoc }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Vui lòng viết thêm mã JavaScript để tải danh sách học sinh thuộc phân công giảng dạy tương ứng.
            </div>
        </form>
    </div>
</div>
@endsection