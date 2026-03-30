@extends('layouts.backend')
@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-0"><i class="bi bi-person-badge text-primary me-2"></i>Hồ Sơ Cá Nhân</h2>
            <p class="text-muted">Thông tin chi tiết về tài khoản của bạn</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4 border-bottom pb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <i class="bi bi-person-fill fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-1">{{ $thongTin ? $thongTin->ho_ten : 'Quản trị viên' }}</h4>
                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">{{ $role }}</span>
                    </div>

                    <h5 class="fw-bold text-secondary mb-3">Thông tin tài khoản</h5>
                    <table class="table table-borderless mb-4">
                        <tbody>
                            <tr>
                                <td class="text-muted fw-bold" style="width: 35%">Tên đăng nhập:</td>
                                <td class="fw-semibold">{{ $user->ten_dang_nhap }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">Ngày tạo tài khoản:</td>
                                <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Không có thông tin' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if($thongTin)
                        <h5 class="fw-bold text-secondary mb-3">Thông tin chi tiết</h5>
                        <table class="table table-borderless">
                            <tbody>
                                @if($user->isGiaoVien())
                                    <tr>
                                        <td class="text-muted fw-bold" style="width: 35%">Mã giáo viên:</td>
                                        <td class="fw-semibold">{{ $thongTin->ma_gv }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted fw-bold">Số điện thoại:</td>
                                        <td>{{ $thongTin->so_dien_thoai ?? 'Chưa cập nhật' }}</td>
                                    </tr>
                                @elseif($user->isHocSinh())
                                    <tr>
                                        <td class="text-muted fw-bold" style="width: 35%">Mã học sinh:</td>
                                        <td class="fw-semibold">{{ $thongTin->ma_hoc_sinh }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted fw-bold">Lớp:</td>
                                        <td>{{ $thongTin->lop->ten_lop ?? 'Chưa xếp lớp' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted fw-bold">Ngày sinh:</td>
                                        <td>{{ $thongTin->ngay_sinh ? \Carbon\Carbon::parse($thongTin->ngay_sinh)->format('d/m/Y') : 'Chưa cập nhật' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted fw-bold">Giới tính:</td>
                                        <td>
                                            @if(isset($thongTin->gioi_tinh))
                                                {{ $thongTin->gioi_tinh == 1 ? 'Nam' : 'Nữ' }}
                                            @else
                                                Chưa cập nhật
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted fw-bold">Địa chỉ:</td>
                                        <td>{{ $thongTin->dia_chi ?? 'Chưa cập nhật' }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @endif
                    
                    <div class="text-center mt-4 pt-3 border-top">
                        <a href="{{ route('profile.settings') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="bi bi-shield-lock me-2"></i> Đổi mật khẩu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection