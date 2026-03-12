@extends('layouts.frontend')

@section('title', 'Trang chủ - THPT Nguyễn Bỉnh Khiêm')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-4">Hệ thống quản lý điểm số</h1>
        <p class="lead mb-4">và cung cấp tài liệu học tập trực tuyến</p>
        @guest
            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5">
                <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập ngay
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-5">
                <i class="bi bi-speedometer2 me-2"></i>Vào Dashboard
            </a>
        @endguest
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Tính năng nổi bật</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-bar-chart fs-1"></i>
                        </div>
                        <h5 class="card-title">Quản lý điểm số</h5>
                        <p class="card-text text-muted">Theo dõi và cập nhật điểm số chính xác, kịp thời theo đúng quy định của Bộ GD&ĐT</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-success bg-gradient text-white rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-folder-open fs-1"></i>
                        </div>
                        <h5 class="card-title">Tài liệu học tập</h5>
                        <p class="card-text text-muted">Kho tài liệu phong phú với bài giảng, đề thi, bài tập cho mọi khối lớp</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-warning bg-gradient text-white rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-people fs-1"></i>
                        </div>
                        <h5 class="card-title">Phân quyền thông minh</h5>
                        <p class="card-text text-muted">Hệ thống phân quyền rõ ràng cho Admin, Giáo viên và Học sinh</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4">
                <div class="display-4 fw-bold text-primary">1500+</div>
                <div class="text-muted">Học sinh</div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="display-4 fw-bold text-success">80+</div>
                <div class="text-muted">Giáo viên</div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="display-4 fw-bold text-warning">36</div>
                <div class="text-muted">Lớp học</div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="display-4 fw-bold text-info">500+</div>
                <div class="text-muted">Tài liệu</div>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Tin tức - Sự kiện</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="News">
                    <div class="card-body">
                        <h5 class="card-title">Khai giảng năm học mới 2025-2026</h5>
                        <p class="card-text text-muted">Lễ khai giảng năm học mới sẽ được tổ chức vào ngày 5/9/2025</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="News">
                    <div class="card-body">
                        <h5 class="card-title">Thi học kỳ 1</h5>
                        <p class="card-text text-muted">Lịch thi học kỳ 1 dự kiến từ 15/12 đến 25/12/2025</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="News">
                    <div class="card-body">
                        <h5 class="card-title">Hội thảo hướng nghiệp</h5>
                        <p class="card-text text-muted">Tổ chức hội thảo hướng nghiệp cho học sinh khối 12</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection