<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-bell me-1"></i>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <h6 class="dropdown-header">Thông báo</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">Có điểm mới được cập nhật</a></li>
                        <li><a class="dropdown-item" href="#">Tài liệu mới được đăng</a></li>
                        <li><a class="dropdown-item" href="#">Lịch họp phụ huynh</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5 me-2"></i>
                        <span>
                            {{ auth()->user()->ten_dang_nhap }}
                            <br>
                            <small class="text-muted">
                                @if(auth()->user()->isAdmin())
                                    Quản trị viên
                                @elseif(auth()->user()->isGiaoVien())
                                    {{ auth()->user()->giaoVien->ho_ten ?? 'Giáo viên' }}
                                @elseif(auth()->user()->isHocSinh())
                                    {{ auth()->user()->hocSinh->ho_ten ?? 'Học sinh' }}
                                @endif
                            </small>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                    class="bi bi-person me-2"></i>Hồ sơ</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.settings') }}"><i
                                    class="bi bi-gear me-2"></i>Cài đặt</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>