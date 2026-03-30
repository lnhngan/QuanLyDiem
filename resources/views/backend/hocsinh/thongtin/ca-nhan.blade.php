@extends('layouts.backend')
@section('title', 'Thông tin cá nhân')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                <i class="bi bi-person-bounding-box" style="font-size: 4rem;"></i>
                <h4 class="mt-3 mb-0 text-uppercase fw-bold">Hồ sơ Học Sinh</h4>
            </div>
            <div class="card-body p-4 bg-light">
                <div class="bg-white p-4 rounded shadow-sm border">
                    <table class="table table-borderless mb-0 fs-5">
                        <tbody>
                            <tr>
                                <th class="text-end text-muted" style="width: 40%">Mã Học Sinh:</th>
                                <td class="fw-bold text-danger">{{ $hocSinh->ma_hoc_sinh ?? $hocSinh->ma_hs ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end text-muted">Họ và tên:</th>
                                <td class="fw-bold text-primary fs-4">{{ $hocSinh->ho_ten ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end text-muted">Ngày sinh:</th>
                                <td>{{ isset($hocSinh->ngay_sinh) ? \Carbon\Carbon::parse($hocSinh->ngay_sinh)->format('d/m/Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end text-muted">Giới tính:</th>
                               <td>
                                    @if(($hocSinh->gioi_tinh ?? 1) == 1 || strtolower(trim($hocSinh->gioi_tinh ?? '')) === 'nam')
                                        <i class="bi bi-gender-male text-primary"></i> <span class="fw-bold">Nam</span>
                                    @else
                                        <i class="bi bi-gender-female text-danger"></i> <span class="fw-bold">Nữ</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-end text-muted">Địa chỉ liên hệ:</th>
                                <td>{{ $hocSinh->dia_chi ?? 'Chưa cập nhật' }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><hr class="my-2"></td>
                            </tr>
                            <tr>
                                <th class="text-end text-muted">Lớp biên chế:</th>
                                <td class="fw-bold text-success fs-5"><i class="bi bi-easel2"></i> {{ $hocSinh->lop->ten_lop ?? 'Chưa xếp lớp' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end text-muted">GV Chủ nhiệm:</th>
                                <td class="fw-bold"><i class="bi bi-person-badge"></i> {{ $hocSinh->lop->giaoVienChuNhiem->ho_ten ?? 'Chưa phân công' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-center py-3">
                <p class="text-muted small mb-0"><i class="bi bi-exclamation-triangle text-warning"></i> Lưu ý: Nếu thông tin lý lịch bị sai, vui lòng phản ánh ngay với Giáo viên chủ nhiệm để được đính chính.</p>
            </div>
        </div>
    </div>
</div>
@endsection