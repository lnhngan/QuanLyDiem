@extends('layouts.frontend')
@section('title', 'Giới thiệu về nhà trường')

@section('content')
<div class="container py-5 my-3">
    <div class="row align-items-center mb-5">
        <div class="col-md-6 pe-md-5">
            <h1 class="fw-bold text-primary mb-4">Về Chúng Tôi</h1>
            <p class="lead text-dark" style="text-align: justify;">Trường THPT Mẫu tự hào là một trong những lá cờ đầu trong ngành giáo dục, chuyên đào tạo và bồi dưỡng những thế hệ học sinh tài năng, phát triển toàn diện.</p>
            <p class="text-muted" style="text-align: justify;">Được thành lập từ năm 2000, trường đã có hơn 20 năm kinh nghiệm. Với đội ngũ giáo viên tận tâm, trình độ chuyên môn cao cùng cơ sở vật chất hiện đại, chúng tôi cam kết mang lại một môi trường học tập an toàn, thân thiện và sáng tạo.</p>
            
            <div class="row mt-4 text-center">
                <div class="col-4">
                    <h2 class="text-success fw-bold">20+</h2>
                    <small class="text-muted">Năm lịch sử</small>
                </div>
                <div class="col-4">
                    <h2 class="text-info fw-bold">50+</h2>
                    <small class="text-muted">Giáo viên giỏi</small>
                </div>
                <div class="col-4">
                    <h2 class="text-warning fw-bold">5k+</h2>
                    <small class="text-muted">Học sinh tốt nghiệp</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=800&auto=format&fit=crop" alt="Giới thiệu trường" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover; height: 450px;">
        </div>
    </div>
</div>
@endsection