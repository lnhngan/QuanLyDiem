@extends('layouts.backend')
@section('title', 'Theo dõi điểm lớp chủ nhiệm')

@section('content')
<div class="card border-success">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Bảng điểm lớp {{ $lopChuNhiem->ten_lop }} - Học kỳ hiện tại</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm text-center">
                <thead class="table-light align-middle">
                    <tr>
                        <th>Mã HS</th>
                        <th>Họ tên</th>
                        <th>Chi tiết các môn có điểm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hocSinhs as $hs)
                    <tr>
                        <td class="align-middle">{{ $hs->ma_hs }}</td>
                        <td class="align-middle text-start fw-bold">{{ $hs->ho_ten }}</td>
                        <td class="text-start">
                            @if($hs->bangDiems->isEmpty())
                                <em class="text-muted">Chưa có dữ liệu điểm học kỳ này</em>
                            @else
                                <ul class="mb-0 ps-3">
                                @foreach($hs->bangDiems as $diem)
                                    <li>
                                        {{ $diem->monHoc->ten_mon_hoc }}: 
                                        <strong>{{ number_format($diem->diem_so, 1) }}</strong> 
                                        <span class="text-muted">({{ $diem->loaiDiem->ten_loai_diem }})</span>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection