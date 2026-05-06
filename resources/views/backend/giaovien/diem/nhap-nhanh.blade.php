@extends('layouts.backend')
@section('title', 'Nhập điểm theo danh sách')

@section('content')
<div class="card mb-4 shadow-sm border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Nhập điểm nhanh theo danh sách</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('giaovien.diem.nhap-nhanh') }}" method="GET">
            <div class="row align-items-end">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Chọn lớp và môn học cần nhập điểm <span
                            class="text-danger">*</span></label>
                    <select name="phan_cong_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Chọn phân công giảng dạy --</option>
                        @foreach($phanCongs as $pc)
                            <option value="{{ $pc->id }}" {{ request('phan_cong_id') == $pc->id ? 'selected' : '' }}>
                                Lớp {{ $pc->lopHoc->ten_lop }} | Môn {{ $pc->monHoc->ten_mon_hoc }} | KHÓA:
                                {{ $pc->hocKy->ten_hoc_ky }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

@if($phanCongActive)
    <div class="card shadow border-success">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-uppercase">
                BẢNG NHẬP ĐIỂM LỚP {{ $phanCongActive->lopHoc->ten_lop }} - MÔN {{ $phanCongActive->monHoc->ten_mon_hoc }}
            </h5>
        </div>
        <div class="card-body p-0">
            @include('partials.messages')

            <form action="{{ route('giaovien.diem.luu-nhap-nhanh') }}" method="POST">
                @csrf
                <input type="hidden" name="phan_cong_id" value="{{ $phanCongActive->id }}">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">STT</th>
                                <th style="width: 15%">Mã HS</th>
                                <th class="text-start" style="width: 20%">Họ và tên</th>

                                @foreach($loaiDiems as $ld)
                                    <th>
                                        {{ $ld->ten_loai_diem }} <br>
                                        <span class="badge bg-secondary">HS: {{ $ld->he_so }}</span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hocSinhs as $key => $hs)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="fw-bold text-secondary">{{ $hs->ma_hoc_sinh }}</td>
                                    <td class="text-start fw-bold text-primary">{{ $hs->ho_ten }}</td>

                                    @foreach($loaiDiems as $ld)
                                        @php
                                            $diemHienTai = $diemDaNhap[$hs->id][$ld->id] ?? '';
                                        @endphp
                                        <td>
                                            <input type="number" step="0.1" min="0" max="10"
                                                name="diem[{{ $hs->id }}][{{ $ld->id }}]"
                                                class="form-control form-control-sm text-center fw-bold text-primary"
                                                value="{{ $diemHienTai }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 3 + $loaiDiems->count() }}" class="text-center py-4 text-danger">
                                        Lớp này hiện chưa có học sinh nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($hocSinhs->count() > 0)
                    <div class="card-footer text-end bg-light">
                        <button type="submit" class="btn btn-success px-5 fw-bold"><i class="bi bi-save2"></i> LƯU TOÀN BỘ BẢNG
                            ĐIỂM</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endif
@endsection