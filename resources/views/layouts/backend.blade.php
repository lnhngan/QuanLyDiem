<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Quản trị hệ thống') - Trường THPT Nguyễn Bỉnh Khiêm</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <style>
        
        body {
            font-size: .875rem;
            background-color: #f4f6f9;
        }
        
        /* 1. Sửa lại Sidebar: Cho chiếm toàn bộ cột trái */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px; 
            z-index: 1040; /* Cho Sidebar lên cao nhất */
            padding: 20px 10px 0; /* Trả padding top về 20px để Logo/Tiêu đề sát trên cùng */
            box-shadow: 2px 0 5px rgba(0,0,0,0.1); /* Đổi bóng đổ sang bên phải */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow-y: auto; 
        }
        
        /* Các hiệu ứng Hover của Sidebar giữ nguyên */
        .sidebar .nav-link {
            font-weight: 500;
            color: rgba(255,255,255,.8);
            padding: 0.75rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.5rem;
            transition: all 0.3s; 
        }
        
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,.1);
            transform: translateX(5px); 
        }
        
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,.2);
            font-weight: bold;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }

        /* 2. Sửa lại Navbar: Chỉ bắt đầu từ sau Sidebar (250px) */
        .navbar {
            position: fixed; 
            top: 0;
            right: 0;
            left: 250px; /* QUAN TRỌNG: Né cái Sidebar 250px ra */
            width: auto; /* Ghi đè chiều rộng 100% mặc định của Bootstrap */
            height: 60px; 
            z-index: 1030; /* Thấp hơn Sidebar 1 chút */
            background-color: white !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* 3. Sửa lại Main Content: Nằm dưới Navbar và bên phải Sidebar */
        main {
            padding-top: 80px; 
            margin-left: 250px; 
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        
        .table thead th {
            border-top: none;
            background-color: #f8f9fa;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .content-wrapper {
            padding: 1.5rem;
        }
        
        .page-title {
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #495057;
        }
        
        .stat-card {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    @if(auth()->user()->isAdmin())
        @include('backend.components.sidebar-admin')
    @elseif(auth()->user()->isGiaoVien())
        @include('backend.components.sidebar-giaovien')
    @elseif(auth()->user()->isHocSinh())
        @include('backend.components.sidebar-hocsinh')
    @endif
    
    <!-- Navbar -->
    @include('backend.components.header')
    
    <!-- Main Content -->
    <main class="flex-shrink-0">
        <div class="content-wrapper">
            <!-- Page Title -->
            <h1 class="page-title">@yield('page-title')</h1>
            
            <!-- Breadcrumb -->
            @yield('breadcrumb')
            
            <!-- Alert Messages -->
            @include('partials.messages')
            
            <!-- Main Content Area -->
            @yield('content')
        </div>
    </main>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // DataTables initialization
        $(document).ready(function() {
            $('.datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json'
                }
            });
        });
        
        // Confirmation dialog for delete (Đã fix chuẩn cho Laravel DELETE)
        function confirmDelete(url, message = 'Bạn có chắc chắn muốn xóa?') {
            Swal.fire({
                title: 'Xác nhận',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tạo một Form ảo để gửi request DELETE an toànss
                    let form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
        
        // Toast notification
        function showToast(message, type = 'success') {
            Swal.fire({
                text: message,
                icon: type,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        }
    </script>
    @stack('scripts')
</body>
</html>