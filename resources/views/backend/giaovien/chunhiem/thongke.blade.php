@extends('layouts.backend')
@section('title', 'Thống kê lớp Chủ nhiệm')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-info text-white fw-bold">
                Tỉ lệ Học lực Lớp {{ $lopChuNhiem->ten_lop }}
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tốt / Giỏi ( >= 8.0 )
                        <span class="badge bg-success rounded-pill px-3">{{ $thongKe['gioi'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Khá ( 6.5 - 7.9 )
                        <span class="badge bg-primary rounded-pill px-3">{{ $thongKe['kha'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Đạt / TB ( 5.0 - 6.4 )
                        <span class="badge bg-warning text-dark rounded-pill px-3">{{ $thongKe['tb'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Chưa Đạt / Yếu ( < 5.0 )
                        <span class="badge bg-danger rounded-pill px-3">{{ $thongKe['yeu'] }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-dark text-white fw-bold">
                Danh sách Điểm Trung Bình (Học kỳ hiện tại)
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="table-secondary">
                            <tr>
                                <th>STT</th>
                                <th>Mã HS</th>
                                <th class="text-start">Họ và Tên</th>
                                <th>Điểm Trung Bình</th>
                                <th>Xếp Loại (Tạm tính)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hocSinhs as $key => $hs)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $hs->ma_hs }}</td>
                                <td class="text-start fw-bold">{{ $hs->ho_ten }}</td>
                                
                                @if($hs->dtb === null)
                                    <td colspan="2" class="text-muted fst-italic">Chưa đủ dữ liệu điểm</td>
                                @else
                                    <td><h5 class="mb-0 text-primary">{{ number_format($hs->dtb, 2) }}</h5></td>
                                    <td>
                                        @if($hs->dtb >= 8.0) <span class="badge bg-success">Giỏi</span>
                                        @elseif($hs->dtb >= 6.5) <span class="badge bg-primary">Khá</span>
                                        @elseif($hs->dtb >= 5.0) <span class="badge bg-warning text-dark">Trung bình</span>
                                        @else <span class="badge bg-danger">Yếu</span>
                                        @endif
                                    </td>
                                @endif
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