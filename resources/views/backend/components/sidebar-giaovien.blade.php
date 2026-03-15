<nav class="sidebar col-md-3 col-lg-2 d-md-block">
    <div class="position-sticky pt-3">
        <div class="text-center mb-4 px-3">
            <h5 class="text-white mb-0">Hệ thống quản lý</h5>
            <small class="text-white-50">Giáo viên</small>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('giaovien.dashboard') ? 'active' : '' }}" 
                   href="{{ route('giaovien.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">QUẢN LÝ ĐIỂM SỐ</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('giaovien.diem.nhap*') ? 'active' : '' }}" 
                   href="{{ route('giaovien.diem.nhap') }}">
                    <i class="bi bi-pencil-square"></i>
                    Nhập điểm
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('giaovien.diem.danh-sach*') ? 'active' : '' }}" 
                   href="{{ route('giaovien.diem.danh-sach') }}">
                    <i class="bi bi-table"></i>
                    Danh sách điểm
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">QUẢN LÝ TÀI LIỆU</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('giaovien.tailieu.them*') ? 'active' : '' }}" 
                   href="{{ route('giaovien.tailieu.create') }}">
                    <i class="bi bi-cloud-upload"></i>
                    Đăng tài liệu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('giaovien.tailieu.danh-sach*') ? 'active' : '' }}" 
                   href="{{ route('giaovien.tailieu.index') }}">
                    <i class="bi bi-files"></i>
                    Tài liệu đã đăng
                </a>
            </li>
            
            @if(auth()->user()->giaoVien->lopChuNhiems->isNotEmpty())
            <li class="nav-item mt-3">
                <small class="text-white-50 px-3">CHỦ NHIỆM</small>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('giaovien.chunhiem.hocsinh*') ? 'active' : '' }}" 
                   href="{{ route('giaovien.chunhiem.hocsinh') }}">
                    <i class="bi bi-people"></i>
                    Danh sách lớp
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('giaovien.chunhiem.diem*') ? 'active' : '' }}" 
                   href="{{ route('giaovien.chunhiem.diem') }}">
                    <i class="bi bi-graph-up"></i>
                    Xem điểm lớp
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>