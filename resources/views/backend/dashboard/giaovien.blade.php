@extends('layouts.backend')

@section('title', 'Dashboard Giáo viên')
@section('page-title', 'Trang chủ')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-gradient text-white">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-value">{{ $so_luong_hoc_sinh ?? 0 }}</div>
            <div class="stat-label">Học sinh đang dạy</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-gradient text-white">
                <i class="bi bi-journal-bookmark-fill"></i>
            </div>
            <div class="stat-value">{{ count($lop_days) }}</div>
            <div class="stat-label">Lớp đang dạy</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-gradient text-white">
                <i class="bi bi-book"></i>
            </div>
            <div class="stat-value">{{ count($mon_days) }}</div>
            <div class="stat-label">Môn đang dạy</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-info bg-gradient text-white">
                <i class="bi bi-files"></i>
            </div>
            <div class="stat-value">{{ $giaoVien->taiLieus->count() }}</div>
            <div class="stat-label">Tài liệu đã đăng</div>
        </div>
    </div>
</div>

@if($lop_chu_nhiem)
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-star-fill text-warning me-2"></i>Lớp chủ nhiệm: {{ $lop_chu_nhiem->ten_lop }}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã HS</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lop_chu_nhiem->hocSinhs as $hs)
                            <tr>
                                <td>{{ $hs->ma_hoc_sinh }}</td>
                                <td>{{ $hs->ho_ten }}</td>
                                <td>{{ $hs->ngay_sinh->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-table me-2"></i>Lớp đang dạy
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Lớp</th>
                                <th>Môn</th>
                                <th>Học kỳ</th>
                                <th>Sĩ số</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($giaoVien->phanCongGiangDays as $pc)
                            <tr>
                                <td>{{ $pc->lopHoc->ten_lop }}</td>
                                <td>{{ $pc->monHoc->ten_mon_hoc }}</td>
                                <td>{{ $pc->hocKy->ten_hoc_ky }}</td>
                                <td>{{ $pc->lopHoc->hocSinhs->count() }}</td>
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
                <i class="bi bi-clock-history me-2"></i>Hoạt động gần đây
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($giaoVien->bangDiems()->latest()->take(5)->get() as $diem)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $diem->hocSinh->ho_ten }}</strong> - {{ $diem->monHoc->ten_mon_hoc }}
                                <br>
                                <small class="text-muted">{{ $diem->created_at->diffForHumans() }}</small>
                            </div>
                            <span class="badge bg-primary">{{ $diem->diem_so }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection