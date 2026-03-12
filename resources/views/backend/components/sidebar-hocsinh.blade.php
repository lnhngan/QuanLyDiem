<nav class="sidebar col-md-3 col-lg-2 d-md-block">
    <div class="position-sticky pt-3">
        <div class="text-center mb-4 px-3">
            <h5 class="text-white mb-0">Hệ thống quản lý</h5>
            <small class="text-white-50">Học sinh</small>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.dashboard') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">HỌC TẬP</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.diem.xem*') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.diem.xem') }}">
                    <i class="bi bi-bar-chart"></i>
                    Xem điểm
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.tailieu.xem*') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.tailieu.xem') }}">
                    <i class="bi bi-folder-open"></i>
                    Tài liệu học tập
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">THÔNG TIN</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.thongtin.ca-nhan*') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.thongtin.ca-nhan') }}">
                    <i class="bi bi-person"></i>
                    Thông tin cá nhân
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.thongtin.lop*') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.thongtin.lop') }}">
                    <i class="bi bi-building"></i>
                    Thông tin lớp
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('hocsinh.thongtin.giaovien*') ? 'active' : '' }}" 
                   href="{{ route('hocsinh.thongtin.giaovien') }}">
                    <i class="bi bi-person-badge"></i>
                    Giáo viên bộ môn
                </a>
            </li>
        </ul>
    </div>
</nav>