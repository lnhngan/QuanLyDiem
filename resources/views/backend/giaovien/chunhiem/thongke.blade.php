@extends('layouts.backend')
@section('title', 'Thống kê xếp loại lớp ' . $lopChuNhiem->ten_lop)

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h3 class="fw-bold text-dark mb-1"><i class="bi bi-pie-chart text-primary me-2"></i>Thống Kê Xếp Loại Lớp {{ $lopChuNhiem->ten_lop }}</h3>
        <p class="text-muted mb-0">Sĩ số: {{ $tongSoHocSinh }} học sinh</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-success border-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Học lực Giỏi</p>
                        <h4 class="font-weight-bolder text-success mb-0">{{ $thongKe['Gioi'] }} <span class="text-sm fw-normal">HS</span></h4>
                        <span class="text-xs text-muted">{{ $tongSoHocSinh > 0 ? round(($thongKe['Gioi'] / $tongSoHocSinh) * 100, 1) : 0 }}%</span>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-success bg-opacity-10 text-success text-center rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-star-fill text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-info border-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Học lực Khá</p>
                        <h4 class="font-weight-bolder text-info mb-0">{{ $thongKe['Kha'] }} <span class="text-sm fw-normal">HS</span></h4>
                        <span class="text-xs text-muted">{{ $tongSoHocSinh > 0 ? round(($thongKe['Kha'] / $tongSoHocSinh) * 100, 1) : 0 }}%</span>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-info bg-opacity-10 text-info text-center rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-hand-thumbs-up-fill text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-warning border-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Trung Bình</p>
                        <h4 class="font-weight-bolder text-warning mb-0">{{ $thongKe['TrungBinh'] }} <span class="text-sm fw-normal text-dark">HS</span></h4>
                        <span class="text-xs text-muted">{{ $tongSoHocSinh > 0 ? round(($thongKe['TrungBinh'] / $tongSoHocSinh) * 100, 1) : 0 }}%</span>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-warning bg-opacity-10 text-warning text-center rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-dash-circle-fill text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-danger border-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Học lực Yếu</p>
                        <h4 class="font-weight-bolder text-danger mb-0">{{ $thongKe['Yeu'] }} <span class="text-sm fw-normal">HS</span></h4>
                        <span class="text-xs text-muted">{{ $tongSoHocSinh > 0 ? round(($thongKe['Yeu'] / $tongSoHocSinh) * 100, 1) : 0 }}%</span>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-danger bg-opacity-10 text-danger text-center rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-exclamation-triangle-fill text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom p-4">
        <h5 class="fw-bold mb-0 text-dark">Danh sách xếp loại học sinh</h5>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 table-hover">
                <thead class="bg-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4">Học sinh</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ĐTB Cả Năm</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Xếp loại</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hocSinhCoDiem as $hs)
                    <tr>
                        <td class="px-4">
                            <div class="d-flex py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm fw-bold text-primary">{{ $hs->ho_ten }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $hs->ma_hoc_sinh ?? $hs->ma_hs }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-dark text-md font-weight-bold">
                                {{ $hs->dtbCaNam > 0 ? number_format($hs->dtbCaNam, 1) : '--' }}
                            </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            @php
                                $badge = 'bg-secondary';
                                if($hs->xepLoai == 'Giỏi') $badge = 'bg-success';
                                if($hs->xepLoai == 'Khá') $badge = 'bg-info';
                                if($hs->xepLoai == 'Trung Bình') $badge = 'bg-warning text-dark';
                                if($hs->xepLoai == 'Yếu') $badge = 'bg-danger';
                            @endphp
                            <span class="badge {{ $badge }} px-3 py-2 rounded-pill">{{ $hs->xepLoai }}</span>
                        </td>
                        <td class="align-middle text-center">
                            <a href="{{ route('giaovien.chunhiem.diem') }}?id={{ $hs->id }}" class="btn btn-sm btn-outline-primary mb-0 rounded-pill px-3">Xem bảng điểm</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Chưa có dữ liệu học sinh</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection