<nav class="sidebar col-md-3 col-lg-2 d-md-block bg-dark">
    <div class="position-sticky pt-3">
        <div class="text-center mb-4 px-3 border-bottom border-secondary pb-3">
            <h5 class="text-white mb-0">Hệ thống quản lý</h5>
            <small class="text-info fw-bold">Dành cho Học Sinh</small>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.dashboard') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    Bảng điều khiển
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3 fw-bold" style="font-size: 0.75rem;">HỌC TẬP</small>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.diem.xem') || request()->routeIs('hocsinh.diem.chi-tiet') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.diem.xem') }}">
                    <i class="bi bi-bar-chart"></i>
                    Xem điểm chi tiết
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.diem.bang-tong-hop') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.diem.bang-tong-hop') }}">
                    <i class="bi bi-award"></i>
                    Bảng tổng hợp (Cả năm)
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.tailieu.*') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.tailieu.index') }}">
                    <i class="bi bi-folder-open"></i>
                    Tài liệu học tập
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3 fw-bold" style="font-size: 0.75rem;">THÔNG TIN</small>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.thongtin.ca-nhan') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.thongtin.ca-nhan') }}">
                    <i class="bi bi-person"></i>
                    Lý lịch cá nhân
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.thongtin.lop') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.thongtin.lop') }}">
                    <i class="bi bi-building"></i>
                    Thành viên lớp
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.thongtin.giaovien') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.thongtin.giaovien') }}">
                    <i class="bi bi-person-badge"></i>
                    Giáo viên giảng dạy
                </a>
            </li>
        </ul>
        
        <div class="px-3 py-3 border-top border-secondary mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                </button>
            </form>
        </div>
    </div>
</nav>