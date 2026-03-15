@extends('layouts.backend')
@section('title', 'Tra cứu bảng điểm')

@section('content')
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="bi bi-search"></i> Tra cứu Bảng điểm theo môn học</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('giaovien.diem.danh-sach') }}" method="GET">
            <div class="row align-items-end">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Chọn lớp và môn học <span class="text-danger">*</span></label>
                    <select name="phan_cong_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Chọn phân công giảng dạy để xem --</option>
                        @foreach($phanCongs as $pc)
                            <option value="{{ $pc->id }}" {{ request('phan_cong_id') == $pc->id ? 'selected' : '' }}>
                                Lớp {{ $pc->lopHoc->ten_lop }} | Môn {{ $pc->monHoc->ten_mon_hoc }} | KHÓA: {{ $pc->hocKy->ten_hoc_ky }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3 text-md-end">
                    <a href="{{ route('giaovien.diem.nhap-nhanh') }}" class="btn btn-success">
                        <i class="bi bi-pencil-square"></i> Cập nhật điểm lớp này
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@if($phanCongActive)
<div class="card border-primary shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-uppercase">
            BẢNG ĐIỂM MÔN {{ $phanCongActive->monHoc->ten_mon_hoc }} - LỚP {{ $phanCongActive->lopHoc->ten_lop }}
        </h5>
    </div>
    <div class="card-body p-0">
        @include('partials.messages')
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">STT</th>
                        <th style="width: 12%">Mã HS</th>
                        <th class="text-start" style="width: 23%">Họ và tên</th>
                        
                        @foreach($loaiDiems as $ld)
                            <th>
                                {{ $ld->ten_loai_diem }} <br>
                                <span class="badge bg-secondary" style="font-size: 0.7rem">HS: {{ $ld->he_so }}</span>
                            </th>
                        @endforeach
                        
                        <th class="bg-warning-subtle">ĐTB (Dự kiến)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hocSinhs as $key => $hs)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="fw-bold text-secondary">{{ $hs->ma_hoc_sinh }}</td> 
                        <td class="text-start fw-bold text-primary">{{ $hs->ho_ten }}</td>
                        
                        @php
                            $tongDiem = 0;
                            $tongHeSo = 0;
                        @endphp

                        @foreach($loaiDiems as $ld)
                            @php
                                $diem = $diemDaNhap[$hs->id][$ld->id] ?? null;
                                if ($diem) {
                                    $tongDiem += $diem->diem_so * $ld->he_so;
                                    $tongHeSo += $ld->he_so;
                                }
                            @endphp
                            <td>
                                @if($diem)
                                    <span class="{{ $diem->diem_so < 5 ? 'text-danger' : 'text-success' }} fw-bold" style="font-size: 1.1rem;">
                                        {{ number_format($diem->diem_so, 1) }}
                                    </span>
                                    <a href="{{ route('giaovien.diem.sua', $diem->id) }}" class="text-warning ms-2" title="Sửa điểm"><i class="bi bi-pencil-fill"></i></a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endforeach
                        
                        <td class="fw-bold bg-warning-subtle text-danger" style="font-size: 1.1rem;">
                            {{ $tongHeSo > 0 ? number_format($tongDiem / $tongHeSo, 2) : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ 4 + $loaiDiems->count() }}" class="text-center py-4">Lớp này hiện chưa có danh sách học sinh.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert alert-info shadow-sm">
    <i class="bi bi-info-circle-fill me-2"></i> Vui lòng chọn một Lớp & Môn học ở hộp thoại phía trên để xem bảng điểm chi tiết.
</div>
@endif
@endsection