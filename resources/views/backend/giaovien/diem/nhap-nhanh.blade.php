@extends('layouts.backend')
@section('title', 'Nhập điểm nhanh')

@section('content')
<div class="card mb-4">
    <div class="card-header"><h5 class="mb-0">Chọn lớp nhập điểm (Nhập dạng lưới)</h5></div>
    <div class="card-body">
        <form action="{{ route('giaovien.diem.nhap-nhanh') }}" method="GET" class="row align-items-end">
            <div class="col-md-8">
                <label class="form-label">Phân công giảng dạy của bạn</label>
                <select name="phan_cong_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Chọn lớp & môn học để hiển thị danh sách --</option>
                    @foreach($phanCongs as $pc)
                        <option value="{{ $pc->id }}" {{ (request('phan_cong_id') == $pc->id) ? 'selected' : '' }}>
                            Lớp {{ $pc->lopHoc->ten_lop }} | Môn: {{ $pc->monHoc->ten_mon_hoc }} | Khóa: {{ $pc->hocKy->ten_hoc_ky }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

@if($phanCongActive)
<div class="card border-primary">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Bảng điểm lớp {{ $phanCongActive->lopHoc->ten_lop }} - Môn {{ $phanCongActive->monHoc->ten_mon_hoc }}</h5>
    </div>
    <div class="card-body">
        @include('partials.messages')
        <form action="{{ route('giaovien.diem.luu-nhap-nhanh') }}" method="POST">
            @csrf
            <input type="hidden" name="phan_cong_id" value="{{ $phanCongActive->id }}">
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">STT</th>
                            <th style="width: 10%">Mã HS</th>
                            <th class="text-start" style="width: 25%">Họ và tên</th>
                            @foreach($loaiDiems as $ld)
                                <th>{{ $ld->ten_loai_diem }} <br><small class="text-danger">(HS: {{ $ld->he_so }})</small></th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hocSinhs as $key => $hs)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $hs->ma_hs }}</td>
                            <td class="text-start fw-bold text-primary">{{ $hs->ho_ten }}</td>
                            
                            @foreach($loaiDiems as $ld)
                                @php
                                    // Kiểm tra xem hs này đã có điểm loại này chưa
                                    $diemHienTai = $diemDaNhap[$hs->id][$ld->id] ?? '';
                                @endphp
                                <td>
                                    <input type="number" step="0.1" min="0" max="10" 
                                           name="diem[{{ $hs->id }}][{{ $ld->id }}]" 
                                           class="form-control text-center" 
                                           value="{{ $diemHienTai }}" placeholder="-">
                                </td>
                            @endforeach
                        </tr>
                        @empty
                        <tr><td colspan="10">Lớp học này hiện chưa có học sinh.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($hocSinhs->count() > 0)
            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Lưu Toàn Bộ Điểm</button>
            </div>
            @endif
        </form>
    </div>
</div>
@endif
@endsection