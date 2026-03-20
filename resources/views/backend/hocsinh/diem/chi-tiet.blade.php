@extends('layouts.backend')
@section('title', 'Chi tiết điểm')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-card-list"></i> Bảng điểm chi tiết: {{ $monHoc->ten_mon_hoc ?? 'Tất cả môn' }}</h5>
        <a href="javascript:history.back()" class="btn btn-sm btn-light text-info fw-bold">Quay lại</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-start">Môn học</th>
                        @foreach($loaiDiems ?? [] as $ld)
                            <th>{{ $ld->ten_loai_diem }} <br><small class="text-muted">HS: {{ $ld->he_so }}</small></th>
                        @endforeach
                        <th class="bg-warning-subtle text-danger">Điểm Trung Bình</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($diemChiTiet ?? [] as $monId => $diemsMon)
                    <tr>
                        <td class="fw-bold text-start text-primary">{{ $diemsMon['ten_mon'] ?? 'Môn học' }}</td>
                        @foreach($loaiDiems ?? [] as $ld)
                            <td>
                                @if(isset($diemsMon['diem'][$ld->id]))
                                    <span class="fw-bold fs-5 {{ $diemsMon['diem'][$ld->id] < 5 ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($diemsMon['diem'][$ld->id], 1) }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endforeach
                        <td class="fw-bold bg-warning-subtle text-danger fs-5">{{ number_format($diemsMon['dtb'] ?? 0, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">Không có điểm chi tiết của môn học này.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection