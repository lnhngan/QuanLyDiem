<nav class="sidebar col-md-3 col-lg-2 d-md-block">
    <div class="position-sticky pt-3">
        <div class="text-center mb-4 px-3">
            <h5 class="text-white mb-0">Hệ thống quản lý</h5>
            <small class="text-white-50">Admin</small>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">QUẢN LÝ NGƯỜI DÙNG</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.giaovien*') ? 'active' : '' }}" 
                   href="{{ route('admin.giaovien.index') }}">
                    <i class="bi bi-person-badge"></i>
                    Giáo viên
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.hocsinh*') ? 'active' : '' }}" 
                   href="{{ route('admin.hocsinh.index') }}">
                    <i class="bi bi-people"></i>
                    Học sinh
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">QUẢN LÝ TRƯỜNG HỌC</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.namhoc*') ? 'active' : '' }}" 
                   href="{{ route('admin.namhoc.index') }}">
                    <i class="bi bi-calendar"></i>
                    Năm học
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.khoilop*') ? 'active' : '' }}" 
                   href="{{ route('admin.khoilop.index') }}">
                    <i class="bi bi-layers"></i>
                    Khối lớp
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.lophoc*') ? 'active' : '' }}" 
                   href="{{ route('admin.lophoc.index') }}">
                    <i class="bi bi-building"></i>
                    Lớp học
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">QUẢN LÝ CHUYÊN MÔN</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.monhoc*') ? 'active' : '' }}" 
                   href="{{ route('admin.monhoc.index') }}">
                    <i class="bi bi-book"></i>
                    Môn học
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.phan-cong*') ? 'active' : '' }}" 
                   href="{{ route('admin.phan-cong.index') }}">
                    <i class="bi bi-person-workspace"></i>
                    Phân công giảng dạy
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">QUẢN LÝ ĐIỂM SỐ</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.loai-diem*') ? 'active' : '' }}" 
                   href="{{ route('admin.loai-diem.index') }}">
                    <i class="bi bi-diagram-3"></i>
                    Loại điểm
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">QUẢN LÝ TÀI LIỆU</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.danh-muc-tai-lieu*') ? 'active' : '' }}" 
                   href="{{ route('admin.danh-muc-tai-lieu.index') }}">
                    <i class="bi bi-folder"></i>
                    Danh mục tài liệu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.tai-lieu*') ? 'active' : '' }}" 
                   href="{{ route('admin.tailieu.index') }}">
                    <i class="bi bi-file-text"></i>
                    Tài liệu
                </a>
            </li>
            
            <li class="nav-item mt-4">
                <a class="nav-link text-warning" href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-globe"></i>
                    Xem trang chủ
                </a>
            </li>
        </ul>
    </div>
</nav>