@extends('layouts.frontend')
@section('title', 'Liên hệ')

@section('content')
<div class="container py-5 my-3">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">Liên Hệ Với Nhà Trường</h1>
        <p class="text-muted fs-5">Chúng tôi luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc từ Quý phụ huynh và các em Học sinh.</p>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg bg-primary text-white rounded-4 overflow-hidden">
                <div class="card-body p-5 position-relative">
                    <h3 class="fw-bold mb-4">Thông tin liên hệ</h3>
                    
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-geo-alt-fill text-warning fs-3 me-3"></i>
                        <span class="fs-5">Quốc lộ 91, Khóm Bình Long 3, xã Châu Phú, tỉnh An Giang</span>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-telephone-fill text-warning fs-3 me-3"></i>
                        <span class="fs-5">0123 456 789</span>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-envelope-fill text-warning fs-3 me-3"></i>
                        <span class="fs-5">contact@truongthpt.edu.vn</span>
                    </div>
                    
                    <hr class="border-light opacity-50 my-4">
                    
                    <h5 class="fw-bold mb-3"><i class="bi bi-calendar-week me-2"></i> Giờ làm việc / Tiếp dân</h5>
                    <p class="mb-2 fs-6 ms-4"><i class="bi bi-clock me-2"></i> Thứ 2 - Thứ 6: 07:00 - 17:00</p>
                    <p class="mb-0 fs-6 ms-4"><i class="bi bi-clock-fill me-2"></i> Thứ 7: 07:00 - 11:30</p>
                    
                    <i class="bi bi-headset position-absolute text-white" style="font-size: 15rem; bottom: -40px; right: -20px; opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection