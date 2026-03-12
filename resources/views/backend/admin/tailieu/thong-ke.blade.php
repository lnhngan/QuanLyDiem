@extends('layouts.backend')
@section('title', 'Thống kê Tài liệu')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.tailieu.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Quay về danh sách</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Thống kê theo Danh mục</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên danh mục</th>
                            <th>Số lượng tài liệu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($thongKeDanhMuc as $tk)
                        <tr>
                            <td class="fw-bold">{{ $tk->ten_danh_muc }}</td>
                            <td><span class="badge bg-primary rounded-pill">{{ $tk->tong_so_tai_lieu }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-primary">
            <div class="card-body text-center mt-4 mb-4">
                <h2 class="text-primary"><i class="bi bi-file-earmark-text" style="font-size: 3rem;"></i></h2>
                <h4 class="mt-3">Tổng số tài liệu hệ thống</h4>
                <h1 class="display-4 fw-bold text-success">{{ $tongSoTaiLieu ?? 0 }}</h1>
                <p class="text-muted">Cập nhật đến ngày hôm nay</p>
            </div>
        </div>
    </div>
</div>
@endsection