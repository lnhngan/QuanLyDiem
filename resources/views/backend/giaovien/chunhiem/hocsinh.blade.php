@extends('layouts.backend')
@section('title', 'Danh sách Lớp chủ nhiệm')

@section('content')
<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Học sinh lớp: {{ $lopChuNhiem->ten_lop }} (Sĩ số: {{ $hocSinhs->total() }})</h5>
    </div>
    <div class="card-body">
        @include('partials.messages')
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã HS</th>
                        <th>Họ và Tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <th>SĐT Phụ Huynh</th> <th>Tài khoản</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hocSinhs as $key => $hs)
                    <tr>
                        <td class="align-middle">{{ $hocSinhs->firstItem() + $key }}</td>
                        <td class="align-middle"><strong>{{ $hs->ma_hoc_sinh ?? $hs->ma_hs }}</strong></td>
                        <td class="align-middle">{{ $hs->ho_ten }}</td>
                        <td class="align-middle">{{ $hs->ngay_sinh ? \Carbon\Carbon::parse($hs->ngay_sinh)->format('d/m/Y') : 'N/A' }}</td>
                        <td class="align-middle">{{ ($hs->gioi_tinh == 1) ? 'Nam' : 'Nữ' }}</td>
                        <td class="align-middle">{{ $hs->dia_chi }}</td>
                        
                        <td class="align-middle">
                            @if($hs->sdt_phu_huynh)
                                <a href="tel:{{ $hs->sdt_phu_huynh }}" class="text-info text-decoration-none">
                                    <i class="bi bi-telephone-fill me-1"></i>{{ $hs->sdt_phu_huynh }}
                                </a>
                            @else
                                <span class="text-muted fst-italic">Chưa có</span>
                            @endif
                        </td>

                        <td class="align-middle">
                            @if($hs->taiKhoan)
                                <span class="badge bg-success">Đã cấp</span>
                            @else
                                <span class="badge bg-secondary">Chưa có</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center">Chưa có học sinh nào trong lớp.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">{{ $hocSinhs->links() }}</div>
    </div>
</div>
@endsection