@extends('layouts.backend')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-gradient text-white">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-value">{{ $tong_hoc_sinh }}</div>
            <div class="stat-label">Tổng số học sinh</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-gradient text-white">
                <i class="bi bi-person-badge"></i>
            </div>
            <div class="stat-value">{{ $tong_giao_vien }}</div>
            <div class="stat-label">Tổng số giáo viên</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-gradient text-white">
                <i class="bi bi-building"></i>
            </div>
            <div class="stat-value">{{ $tong_lop_hoc }}</div>
            <div class="stat-label">Tổng số lớp học</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-info bg-gradient text-white">
                <i class="bi bi-files"></i>
            </div>
            <div class="stat-value">{{ $tong_tai_lieu }}</div>
            <div class="stat-label">Tổng số tài liệu</div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-plus me-2"></i>Học sinh mới
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã HS</th>
                                <th>Họ tên</th>
                                <th>Lớp</th>
                                <th>Ngày sinh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hoc_sinh_moi as $hs)
                            <tr>
                                <td>{{ $hs->ma_hoc_sinh }}</td>
                                <td>{{ $hs->ho_ten }}</td>
                                <td>{{ $hs->lop->ten_lop ?? 'Chưa xếp lớp' }}</td>
                                <td>{{ $hs->ngay_sinh ? $hs->ngay_sinh->format('d/m/Y') : 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-plus me-2"></i>Giáo viên mới
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($giao_vien_moi as $gv)
                            <tr>
                                <td>{{ $gv->ho_ten }}</td>
                                <td>{{ $gv->email }}</td>
                                <td>{{ $gv->so_dien_thoai }}</td>
                                <td>{{ $gv->created_at ? $gv->created_at->format('d/m/Y') : 'N/A' }}</td>
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