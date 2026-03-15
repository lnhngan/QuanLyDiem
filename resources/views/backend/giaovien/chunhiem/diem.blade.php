@extends('layouts.backend')
@section('title', 'Bảng điểm chi tiết lớp chủ nhiệm')

@section('content')
<div class="card mb-4 shadow-sm border-success">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="bi bi-journal-text"></i> Tra cứu Điểm chi tiết lớp chủ nhiệm: {{ $lopChuNhiem->ten_lop }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('giaovien.chunhiem.diem') }}" method="GET">
            <div class="row align-items-end">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Xem theo môn học <span class="text-danger">*</span></label>
                    <select name="mon_hoc_id" class="form-select border-success" onchange="this.form.submit()">
                        <option value="">-- Chọn môn học để xem bảng điểm --</option>
                        @foreach($monHocs as $mh)
                            <option value="{{ $mh->id }}" {{ request('mon_hoc_id') == $mh->id ? 'selected' : '' }}>
                                Bảng điểm môn: {{ $mh->ten_mon_hoc }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

@if($monHocActive)
<div class="card border-primary shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-uppercase">
            CHI TIẾT MÔN {{ $monHocActive->ten_mon_hoc }} - LỚP {{ $lopChuNhiem->ten_lop }}
        </h5>
    </div>
    <div class="card-body p-0">
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
                        
                        <th class="bg-warning-subtle">ĐTB Môn</th>
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
                        <td colspan="{{ 4 + $loaiDiems->count() }}" class="text-center py-4">Lớp này hiện chưa có học sinh.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert alert-info shadow-sm border-info">
    <i class="bi bi-info-circle-fill me-2"></i> Kính mời Thầy/Cô chọn một Môn học ở hộp thoại phía trên để xem chi tiết điểm của lớp mình phụ trách.
</div>
@endif
@endsection