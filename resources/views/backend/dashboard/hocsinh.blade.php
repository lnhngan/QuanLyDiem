@extends('layouts.backend')

@section('title', 'Dashboard Học sinh')
@section('page-title', 'Trang chủ')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle" style="font-size: 5rem; color: #667eea;"></i>
                </div>
                <h5>{{ $hocSinh->ho_ten }}</h5>
                <p class="text-muted">Mã HS: {{ $hocSinh->ma_hoc_sinh }}</p>
                @if($lop)
                <p><i class="bi bi-building me-1"></i>Lớp: {{ $lop->ten_lop }} ({{ $lop->khoiLop->ten_khoi }})</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon bg-primary bg-gradient text-white">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <div class="stat-value">{{ $diem_trung_binh }}</div>
                    <div class="stat-label">Điểm TB học kỳ</div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon bg-success bg-gradient text-white">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="stat-value">{{ $so_mon_hoc }}</div>
                    <div class="stat-label">Môn học</div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon bg-warning bg-gradient text-white">
                        <i class="bi bi-files"></i>
                    </div>
                    <div class="stat-value">{{ $tai_lieu_moi->count() }}</div>
                    <div class="stat-label">Tài liệu mới</div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon bg-info bg-gradient text-white">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="stat-value">{{ $hocSinh->ngay_sinh->age }}</div>
                    <div class="stat-label">Tuổi</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-star me-2"></i>Thông tin lớp
            </div>
            <div class="card-body">
                @if($lop)
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Lớp:</th>
                        <td>{{ $lop->ten_lop }}</td>
                    </tr>
                    <tr>
                        <th>Khối:</th>
                        <td>{{ $lop->khoiLop->ten_khoi }}</td>
                    </tr>
                    <tr>
                        <th>Năm học:</th>
                        <td>{{ $lop->namHoc->ten_nam_hoc }}</td>
                    </tr>
                    <tr>
                        <th>GVCN:</th>
                        <td>
                            @if($lop->giaoVienChuNhiem)
                                {{ $lop->giaoVienChuNhiem->ho_ten }}
                            @else
                                <span class="text-muted">Chưa có</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Sĩ số:</th>
                        <td>{{ $lop->hocSinhs->count() }}</td>
                    </tr>
                </table>
                @else
                <p class="text-muted">Chưa có thông tin lớp</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-file-text me-2"></i>Tài liệu mới nhất
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse($tai_lieu_moi as $tl)
                    <a href="{{ route('hocsinh.tailieu.xem', $tl->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $tl->tieu_de }}</strong>
                                <br>
                                <small class="text-muted">{{ $tl->monHoc->ten_mon_hoc }} - {{ $tl->created_at->diffForHumans() }}</small>
                            </div>
                            <i class="bi bi-download"></i>
                        </div>
                    </a>
                    @empty
                    <p class="text-muted">Chưa có tài liệu</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection