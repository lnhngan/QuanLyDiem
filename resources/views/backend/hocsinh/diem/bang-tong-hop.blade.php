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

        <div class="row justify-content-center mb-5">
            <div class="col-md-8 col-lg-6">
                <div class="card bg-gradient-primary border-0 shadow text-white rounded-4 overflow-hidden position-relative" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);">
                    <div class="position-absolute top-0 end-0 opacity-25 p-4">
                        <i class="bi bi-award-fill" style="font-size: 8rem;"></i>
                    </div>
                    
                    <div class="card-body p-4 p-md-5 position-relative z-index-1 text-center">
                        <h4 class="text-white mb-4 fw-bold">TỔNG KẾT NĂM HỌC</h4>
                        
                        @if($diemTrungBinhNam > 0)
                            <div class="display-1 fw-bold mb-2">{{ number_format($diemTrungBinhNam, 1) }}</div>
                            <p class="text-white-50 fs-5 mb-4">Điểm trung bình chung cả năm</p>

                            @php
                                $hocLuc = 'Chưa xếp loại';
                                $badgeClass = 'bg-secondary';
                                
                                if ($diemTrungBinhNam >= 8.0) {
                                    $hocLuc = 'Giỏi';
                                    $badgeClass = 'bg-success';
                                } elseif ($diemTrungBinhNam >= 6.5) {
                                    $hocLuc = 'Khá';
                                    $badgeClass = 'bg-info';
                                } elseif ($diemTrungBinhNam >= 5.0) {
                                    $hocLuc = 'Trung Bình';
                                    $badgeClass = 'bg-warning text-dark';
                                } else {
                                    $hocLuc = 'Yếu';
                                    $badgeClass = 'bg-danger';
                                }
                            @endphp
                            
                            <div class="mt-4 pt-4 border-top border-white-50 border-opacity-25 d-flex justify-content-center align-items-center">
                                <span class="fs-5 me-3">Học lực:</span>
                                <span class="badge {{ $badgeClass }} fs-4 px-4 py-2 rounded-pill shadow-sm">{{ $hocLuc }}</span>
                            </div>
                        @else
                            <div class="py-4">
                                <i class="bi bi-hourglass-split display-1 text-white-50 mb-3 d-block"></i>
                                <h5 class="text-white">Chưa đủ dữ liệu</h5>
                                <p class="text-white-50 mb-0">Cần có đầy đủ điểm của cả 2 học kỳ để xét học lực.</p>
                            </div>
                        @endif
                    </div>
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