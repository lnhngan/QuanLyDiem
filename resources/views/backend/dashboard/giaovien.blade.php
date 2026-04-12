@extends('layouts.backend')
@section('title', 'Bảng điều khiển Giáo viên')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h4 class="mb-0">Xin chào Thầy/Cô {{ $giaoVien->ho_ten }}!</h4>
                <p class="mb-0 mt-1">Chào mừng bạn quay trở lại hệ thống quản lý.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Số lớp giảng dạy</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $soLopGiangDay }} lớp</div>
                        <a href="{{ route('giaovien.diem.danh-sach') }}" class="text-sm mt-2 d-inline-block">Xem danh sách →</a>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-easel fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tài liệu đã chia sẻ</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $soTaiLieu }} tài liệu</div>
                        <a href="{{ route('giaovien.tailieu.index') }}" class="text-sm mt-2 d-inline-block">Quản lý tài liệu →</a>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-file-earmark-text fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 {{ $lopChuNhiem ? 'border-left-info' : 'bg-light border-0' }}">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Lớp Chủ Nhiệm</div>
                        @if($lopChuNhiem)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $lopChuNhiem->ten_lop }}</div>
                            <a href="{{ route('giaovien.chunhiem.hocsinh') }}" class="text-sm mt-2 d-inline-block">Xem danh sách lớp →</a>
                        @else
                            <div class="text-muted fst-italic">Không có phân công chủ nhiệm</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-star fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Phân công giảng dạy hiện tại</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Lớp học</th>
                                <th>Môn học</th>
                                <th>Học kỳ</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($danhSachLopDay as $pc)
                            <tr>
                                <td><strong>{{ $pc->lopHoc->ten_lop ?? '' }}</strong></td>
                                <td>{{ $pc->monHoc->ten_mon ?? '' }}</td>
                                <td>{{ $pc->hocKy->ten_hoc_ky ?? '' }}</td>
                                <td>
                                    <a href="{{ route('giaovien.diem.nhap') }}" class="btn btn-sm btn-primary">Vào điểm</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Chưa có phân công giảng dạy</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection