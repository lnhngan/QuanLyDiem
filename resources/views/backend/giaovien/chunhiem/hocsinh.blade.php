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
                        <th>Tài khoản</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hocSinhs as $key => $hs)
                    <tr>
                        <td>{{ $hocSinhs->firstItem() + $key }}</td>
                        <td><strong>{{ $hs->ma_hs }}</strong></td>
                        <td>{{ $hs->ho_ten }}</td>
                        <td>{{ \Carbon\Carbon::parse($hs->ngay_sinh)->format('d/m/Y') }}</td>
                        <td>{{ $hs->gioi_tinh == 1 ? 'Nam' : 'Nữ' }}</td>
                        <td>{{ $hs->dia_chi }}</td>
                        <td>
                            @if($hs->taiKhoan)
                                <span class="badge bg-success">Đã cấp</span>
                            @else
                                <span class="badge bg-secondary">Chưa có</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center">Chưa có học sinh nào trong lớp.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">{{ $hocSinhs->links() }}</div>
    </div>
</div>
@endsection