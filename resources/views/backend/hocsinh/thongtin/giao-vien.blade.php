@extends('layouts.backend')
@section('title', 'Thông tin giáo viên')

@section('content')
<div class="card shadow-sm border-info">
    <div class="card-header bg-info text-white py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-person-video3"></i> Danh sách Giáo viên giảng dạy lớp {{ $lop->ten_lop ?? 'N/A' }}</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">STT</th>
                        <th class="text-start" style="width: 25%">Môn học phụ trách</th>
                        <th class="text-start" style="width: 30%">Họ tên Giáo viên</th>
                        <th>Số điện thoại / Liên hệ</th>
                        <th>Vai trò</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($phanCongs ?? [] as $key => $pc)
                    <tr class="{{ (isset($lop->gv_chu_nhiem_id) && $pc->giao_vien_id == $lop->gv_chu_nhiem_id) ? 'table-success bg-gradient' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td class="text-start fw-bold text-primary fs-6">{{ $pc->monHoc->ten_mon_hoc ?? 'N/A' }}</td>
                        <td class="text-start fw-bold text-dark fs-6">{{ $pc->giaoVien->ho_ten ?? 'N/A' }}</td>
                        <td class="fw-bold">{{ $pc->giaoVien->so_dien_thoai ?? 'Đang cập nhật' }}</td>
                        <td>
                            @if(isset($lop->gv_chu_nhiem_id) && $pc->giao_vien_id == $lop->gv_chu_nhiem_id)
                                <span class="badge bg-danger shadow-sm px-3 py-2"><i class="bi bi-star-fill"></i> Giáo viên Chủ nhiệm</span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">Giáo viên Bộ môn</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted fst-italic">Nhà trường chưa công bố danh sách phân công giảng dạy cho lớp này.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection