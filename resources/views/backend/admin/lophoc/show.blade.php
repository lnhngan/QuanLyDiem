@extends('layouts.backend')
@section('title', 'Chi tiết Lớp học')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.lophoc.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Quay lại</a>
    <a href="{{ route('admin.lophoc.edit', $lophoc->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Sửa lớp này</a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="bi bi-info-circle"></i> Thông tin Lớp: {{ $lophoc->ten_lop }}</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Khối:</strong> <span>{{ $lophoc->khoiLop->ten_khoi ?? 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Năm học:</strong> <span>{{ $lophoc->namHoc->ten_nam_hoc ?? 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>GVCN:</strong> <span>{{ $lophoc->giaoVienChuNhiem->ho_ten ?? 'Chưa cập nhật' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Tổng số HS:</strong> 
                    <span class="badge bg-success rounded-pill">{{ $lophoc->hocSinhs->count() ?? 0 }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="bi bi-person-lines-fill"></i> Danh sách Học sinh</h6>
                <a href="{{ route('admin.hocsinh.create') }}" class="btn btn-sm btn-outline-primary">Thêm học sinh</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Mã HS</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lophoc->hocSinhs as $key => $hs)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-secondary">{{ $hs->ma_hs }}</span></td>
                                <td class="fw-bold">{{ $hs->ho_ten }}</td>
                                <td>{{ \Carbon\Carbon::parse($hs->ngay_sinh)->format('d/m/Y') }}</td>
                                <td>{{ $hs->gioi_tinh == 1 ? 'Nam' : 'Nữ' }}</td>
                                <td>
                                    <a href="{{ route('admin.hocsinh.show', $hs->id) }}" class="btn btn-sm btn-info text-white" title="Xem hồ sơ">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection