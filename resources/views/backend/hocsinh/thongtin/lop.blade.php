@extends('layouts.backend')
@section('title', 'Thông tin lớp học')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-people-fill"></i> Danh sách thành viên lớp: {{ $lop->ten_lop ?? 'N/A' }}</h5>
        <span class="badge bg-light text-dark fw-bold fs-6 shadow-sm">Sĩ số: {{ isset($danhSachLop) ? $danhSachLop->count() : 0 }} Học sinh</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover text-center align-middle mb-0">
                <thead class="table-light border-bottom">
                    <tr>
                        <th style="width: 10%">STT</th>
                        <th style="width: 15%">Mã HS</th>
                        <th class="text-start">Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($danhSachLop ?? [] as $key => $hs)
                    <tr class="{{ (isset(Auth::user()->hocSinh) && $hs->id == Auth::user()->hocSinh->id) ? 'table-warning fw-bold' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td class="text-secondary fw-bold">{{ $hs->ma_hoc_sinh ?? $hs->ma_hs ?? '' }}</td>
                        <td class="text-start text-primary fs-6">{{ $hs->ho_ten }} 
                            @if(isset(Auth::user()->hocSinh) && $hs->id == Auth::user()->hocSinh->id) 
                                <span class="badge bg-danger ms-2 shadow-sm"><i class="bi bi-star-fill"></i> Bạn</span> 
                            @endif
                        </td>
                        <td>{{ isset($hs->ngay_sinh) ? \Carbon\Carbon::parse($hs->ngay_sinh)->format('d/m/Y') : '' }}</td>
                        <td>
                            @if($hs->gioi_tinh == 0 || strtolower(trim($hs->gioi_tinh)) === 'nam')
                                <span class="text-primary fw-bold">Nữ</span>
                            @else
                                <span class="text-danger fw-bold">Nam</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted fst-italic">Lớp chưa có danh sách học sinh.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection