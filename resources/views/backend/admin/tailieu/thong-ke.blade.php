@extends('layouts.backend')
@section('title', 'Thống kê Tài liệu')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.tailieu.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Quay về danh sách</a>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-primary shadow-sm text-center">
            <div class="card-body">
                <h2 class="text-primary"><i class="bi bi-file-earmark-text" style="font-size: 3rem;"></i></h2>
                <h4 class="mt-2">Tổng số tài liệu trên hệ thống</h4>
                <h1 class="display-4 fw-bold text-success">{{ $thongKe['tong_so'] }}</h1>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Thống kê theo Danh mục</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead><tr><th>Tên danh mục</th><th>Số lượng</th></tr></thead>
                    <tbody>
                        @foreach($thongKe['theo_danh_muc'] as $dm)
                        <tr>
                            <td class="fw-bold">{{ $dm->ten_danh_muc }}</td>
                            <td><span class="badge bg-primary rounded-pill">{{ $dm->tai_lieus_count }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-book"></i> Thống kê theo Môn học</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead><tr><th>Tên Môn học</th><th>Số lượng</th></tr></thead>
                    <tbody>
                        @foreach($thongKe['theo_mon_hoc'] as $mh)
                        <tr>
                            <td class="fw-bold">{{ $mh->ten_mon_hoc }}</td>
                            <td><span class="badge bg-success rounded-pill">{{ $mh->tai_lieus_count }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection