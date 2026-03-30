@extends('layouts.frontend')
@section('title', 'Tin tức & Sự kiện')

@section('content')
<div class="container py-5 my-3">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="fw-bold text-primary mb-0"><i class="bi bi-newspaper"></i> Tin tức & Sự kiện nổi bật</h2>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all rounded-4 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?q=80&w=600&auto=format&fit=crop" class="card-img-top" alt="Tin tức" style="height: 220px; object-fit: cover;">
                <div class="card-body p-4">
                    <span class="badge bg-danger mb-2">Thông báo</span>
                    <small class="text-muted float-end"><i class="bi bi-calendar3"></i> 10/10/2025</small>
                    <h5 class="card-title fw-bold mt-2 text-dark">Lễ khai giảng năm học mới rực rỡ sắc màu</h5>
                    <p class="card-text text-muted mt-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-align: justify;">
                        Sáng nay, trường THPT đã long trọng tổ chức lễ khai giảng năm học mới với sự tham gia của toàn thể cán bộ, giáo viên và hơn 2000 học sinh toàn trường...
                    </p>
                </div>
                <div class="card-footer bg-white border-0 px-4 pb-4">
                    <a href="{{ route('chi-tiet-tin', 1) }}" class="text-decoration-none fw-bold text-primary">Đọc tiếp <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all rounded-4 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=600&auto=format&fit=crop" class="card-img-top" alt="Tin tức" style="height: 220px; object-fit: cover;">
                <div class="card-body p-4">
                    <span class="badge bg-success mb-2">Thành tích</span>
                    <small class="text-muted float-end"><i class="bi bi-calendar3"></i> 05/10/2025</small>
                    <h5 class="card-title fw-bold mt-2 text-dark">Học sinh nhà trường đạt giải Nhất kỳ thi HSG Tỉnh</h5>
                    <p class="card-text text-muted mt-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-align: justify;">
                        Xin chúc mừng đội tuyển học sinh giỏi môn Toán của trường đã xuất sắc đem về giải Nhất toàn đoàn trong kỳ thi HSG cấp Tỉnh vừa qua...
                    </p>
                </div>
                <div class="card-footer bg-white border-0 px-4 pb-4">
                    <a href="{{ route('chi-tiet-tin', 2) }}" class="text-decoration-none fw-bold text-primary">Đọc tiếp <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all rounded-4 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1546410531-ea4ca67d476a?q=80&w=600&auto=format&fit=crop" class="card-img-top" alt="Tin tức" style="height: 220px; object-fit: cover;">
                <div class="card-body p-4">
                    <span class="badge bg-info text-dark mb-2">Hoạt động</span>
                    <small class="text-muted float-end"><i class="bi bi-calendar3"></i> 01/10/2025</small>
                    <h5 class="card-title fw-bold mt-2 text-dark">Hội thao thanh niên chào mừng ngày nhà giáo</h5>
                    <p class="card-text text-muted mt-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-align: justify;">
                        Sự kiện thể thao được mong đợi nhất năm đã chính thức khởi tranh với hàng loạt các môn thi đấu hấp dẫn như kéo co, bóng đá, cầu lông...
                    </p>
                </div>
                <div class="card-footer bg-white border-0 px-4 pb-4">
                    <a href="{{ route('chi-tiet-tin', 3) }}" class="text-decoration-none fw-bold text-primary">Đọc tiếp <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection