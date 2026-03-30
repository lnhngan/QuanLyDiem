@extends('layouts.frontend')
@section('title', 'Chi tiết tin tức')

@section('content')
<div class="container py-5 my-3">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb p-3 bg-light rounded-pill px-4 shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"><i class="bi bi-house-door"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tin-tuc') }}" class="text-decoration-none">Tin tức</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết bài viết</li>
                </ol>
            </nav>

            <span class="badge bg-danger mb-3 px-3 py-2 fs-6">Thông báo</span>
            <h1 class="fw-bold text-dark mb-3" style="line-height: 1.4;">Lễ khai giảng năm học mới rực rỡ sắc màu và tràn đầy nhiệt huyết</h1>
            
            <div class="d-flex align-items-center text-muted mb-4 border-bottom pb-3">
                <div class="me-4"><i class="bi bi-calendar2-check text-primary"></i> 10/10/2025</div>
                <div class="me-4"><i class="bi bi-person-circle text-primary"></i> Tác giả: Ban Giám Hiệu</div>
                <div><i class="bi bi-eye text-primary"></i> 1,204 Lượt xem</div>
            </div>
            
            <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?q=80&w=1200&auto=format&fit=crop" alt="Cover" class="img-fluid rounded-4 mb-5 w-100 shadow-sm">
            
            <div class="content text-dark" style="line-height: 1.8; font-size: 1.15rem; text-align: justify;">
                <p class="fw-bold">Sáng nay, trong không khí vui tươi, phấn khởi của những ngày đầu thu, trường THPT đã long trọng tổ chức lễ khai giảng năm học mới.</p>
                <p>Buổi lễ có sự tham dự của các đồng chí lãnh đạo địa phương, ban đại diện cha mẹ học sinh cùng toàn thể cán bộ, giáo viên, nhân viên và các em học sinh toàn trường. Tiếng trống trường vang lên từng nhịp rộn rã đánh dấu một chặng đường học tập mới chính thức bắt đầu.</p>
                <p>Năm học này, nhà trường tiếp tục đổi mới phương pháp giảng dạy, nâng cao chất lượng giáo dục toàn diện, đẩy mạnh các hoạt động ngoại khóa nhằm phát huy tối đa năng lực, sự sáng tạo của từng học sinh.</p>
                <p>Phát biểu tại buổi lễ, thầy Hiệu trưởng nhấn mạnh: <em>"Mỗi học sinh là một hạt mầm tương lai. Nhiệm vụ của chúng tôi là tạo ra mảnh đất màu mỡ nhất để các em nảy mầm và phát triển mạnh mẽ."</em></p>
                <p>Xin kính chúc các thầy cô giáo và các em học sinh có một năm học mới dồi dào sức khỏe, đạt nhiều thành tích xuất sắc và lưu giữ thật nhiều kỷ niệm đẹp dưới mái trường thân yêu!</p>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                <a href="{{ route('tin-tuc') }}" class="btn btn-outline-secondary rounded-pill px-4"><i class="bi bi-arrow-left"></i> Về danh sách</a>
                <div>
                    <span class="me-2 text-muted fw-bold">Chia sẻ:</span>
                    <a href="#" class="btn btn-primary btn-sm rounded-circle me-1"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-info btn-sm rounded-circle text-white"><i class="bi bi-twitter"></i></a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection