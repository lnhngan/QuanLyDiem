@extends('layouts.frontend')
@section('title', 'Hệ thống Quản lý Học tập')

@section('content')
<div class="container py-5 mt-4 mb-5">
    <div class="row justify-content-center text-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <i class="bi bi-mortarboard-fill text-primary" style="font-size: 5rem;"></i>
            </div>
            
            <h1 class="display-5 fw-bold text-dark mb-3">Hệ Thống Quản Lý Giáo Dục</h1>
            <p class="lead text-muted mb-5 px-md-5">Nền tảng nội bộ hỗ trợ tra cứu điểm số, theo dõi tiến độ học tập và chia sẻ tài liệu. <br> <strong class="text-danger">Dành riêng cho Cán bộ, Giáo viên và Học sinh nhà trường.</strong></p>

            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm fw-bold">Vào Quản trị Admin <i class="bi bi-arrow-right ms-2"></i></a>
                    @elseif(Auth::user()->isGiaoVien())
                        <a href="{{ route('giaovien.dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm fw-bold">Vào Kênh Giáo viên <i class="bi bi-arrow-right ms-2"></i></a>
                    @elseif(Auth::user()->isHocSinh())
                        <a href="{{ route('hocsinh.dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm fw-bold">Vào Kênh Học sinh <i class="bi bi-arrow-right ms-2"></i></a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Đăng Nhập Hệ Thống
                    </a>
                    <a href="{{ route('lien-he') }}" class="btn btn-outline-secondary btn-lg px-5 py-3 rounded-pill fw-bold">
                        <i class="bi bi-headset me-2"></i> Hỗ trợ
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <div class="row text-center g-4 justify-content-center">
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 border-top border-primary border-4 hover-shadow transition-all">
                    <i class="bi bi-shield-lock text-primary fs-1 mb-3"></i>
                    <h4 class="fw-bold">Bảo mật dữ liệu</h4>
                    <p class="text-muted mb-0">Mọi thông tin điểm số và lý lịch đều được bảo mật nghiêm ngặt. Chỉ người dùng được cấp tài khoản hợp lệ mới có quyền truy cập.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 border-top border-success border-4 hover-shadow transition-all">
                    <i class="bi bi-journal-check text-success fs-1 mb-3"></i>
                    <h4 class="fw-bold">Thông tin minh bạch</h4>
                    <p class="text-muted mb-0">Dữ liệu được cập nhật trực tiếp và liên tục từ hệ thống Giáo viên bộ môn, đảm bảo tính minh bạch, chính xác và kịp thời.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 border-top border-info border-4 hover-shadow transition-all">
                    <i class="bi bi-cloud-arrow-down text-info fs-1 mb-3"></i>
                    <h4 class="fw-bold">Tài nguyên độc quyền</h4>
                    <p class="text-muted mb-0">Kho tài liệu, bài giảng và đề thi được lưu trữ tập trung, hỗ trợ học sinh ôn tập mọi lúc mọi nơi ngay trên hệ thống.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection