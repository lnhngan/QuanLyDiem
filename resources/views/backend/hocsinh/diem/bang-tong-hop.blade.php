@extends('layouts.backend')
@section('title', 'Bảng tổng hợp kết quả học tập')

@section('content')
<div class="card shadow-sm border-success">
    <div class="card-header bg-success text-white text-center py-3">
        <h4 class="mb-0 text-uppercase"><i class="bi bi-award"></i> Bảng Tổng Hợp Kết Quả Học Tập</h4>
        <p class="mb-0 mt-2 fs-5">Học sinh: <strong>{{ Auth::user()->hocSinh->ho_ten ?? 'N/A' }}</strong> | Lớp: {{ Auth::user()->hocSinh->lop->ten_lop ?? 'N/A' }}</p>
    </div>
    <div class="card-body p-4">
        <div class="row text-center mb-4">
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded border border-primary h-100">
                    <h6 class="text-muted text-uppercase mb-3">Học lực (Tạm tính)</h6>
                    <h2 class="text-primary fw-bold">{{ $hocLuc ?? 'Chưa xét' }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded border border-danger h-100">
                    <h6 class="text-muted text-uppercase mb-3">Điểm Trung Bình Năm</h6>
                    <h2 class="text-danger fw-bold">{{ $dtbChung ?? '-' }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-light rounded border border-success h-100">
                    <h6 class="text-muted text-uppercase mb-3">Hạnh kiểm</h6>
                    <h2 class="text-success fw-bold">{{ $hanhKiem ?? 'Tốt' }}</h2>
                </div>
            </div>
        </div>

        <h5 class="fw-bold text-secondary border-bottom pb-2"><i class="bi bi-list-check"></i> Chi tiết điểm trung bình các môn</h5>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">STT</th>
                        <th class="text-start">Môn học</th>
                        <th>ĐTB Học kỳ 1</th>
                        <th>ĐTB Học kỳ 2</th>
                        <th class="bg-warning-subtle text-danger">ĐTB Cả năm</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tongKetMon ?? [] as $key => $tk)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="text-start fw-bold text-primary">{{ $tk['ten_mon'] }}</td>
                        <td>{{ $tk['hk1'] ?? '-' }}</td>
                        <td>{{ $tk['hk2'] ?? '-' }}</td>
                        <td class="fw-bold bg-warning-subtle text-danger fs-5">{{ $tk['ca_nam'] ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 fst-italic">Hệ thống đang cập nhật dữ liệu tổng hợp môn học.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection