<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gioi-thieu', [HomeController::class, 'gioiThieu'])->name('gioi-thieu');
Route::get('/lien-he', [HomeController::class, 'lienHe'])->name('lien-he');
Route::get('/tin-tuc', [HomeController::class, 'tinTuc'])->name('tin-tuc');
Route::get('/tin-tuc/{id}', [HomeController::class, 'chiTietTin'])->name('chi-tiet-tin');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    
    // Dashboard redirect
    Route::get('/dashboard', function() {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isGiaoVien()) {
            return redirect()->route('giaovien.dashboard');
        } elseif ($user->isHocSinh()) {
            return redirect()->route('hocsinh.dashboard');
        }
    })->name('dashboard');
    
    // --- BỔ SUNG CÁC ROUTE CHO PROFILE VÀ SETTINGS ---
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
        Route::get('/settings', [\App\Http\Controllers\ProfileController::class, 'settings'])->name('settings');
        Route::post('/settings/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
    });
    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Quản lý giáo viên
        Route::resource('giaovien', App\Http\Controllers\Admin\GiaoVienController::class);
        
        // Quản lý học sinh
        Route::resource('hocsinh', App\Http\Controllers\Admin\HocSinhController::class);
        
        // Quản lý năm học
        Route::resource('namhoc', App\Http\Controllers\Admin\NamHocController::class);
        
        // Quản lý khối lớp
        Route::resource('khoilop', App\Http\Controllers\Admin\KhoiLopController::class);
        
        // Quản lý lớp học
        Route::resource('lophoc', App\Http\Controllers\Admin\LopHocController::class);
        
        // Quản lý môn học
        Route::resource('monhoc', App\Http\Controllers\Admin\MonHocController::class);
        
        // Quản lý phân công giảng dạy
        Route::resource('phan-cong', App\Http\Controllers\Admin\PhanCongGiangDayController::class);
        
        // Quản lý loại điểm
        Route::resource('loai-diem', App\Http\Controllers\Admin\LoaiDiemController::class);
        
        // Quản lý danh mục tài liệu
        Route::resource('danh-muc-tai-lieu', App\Http\Controllers\Admin\DanhMucTaiLieuController::class);
        
        // Quản lý tài liệu
        Route::get('tailieu/thong-ke', [App\Http\Controllers\Admin\TaiLieuController::class, 'thongKe'])->name('tailieu.thong-ke');
        Route::resource('tailieu', App\Http\Controllers\Admin\TaiLieuController::class);   
    });
    
    // Giáo viên Routes
    Route::prefix('giaovien')->name('giaovien.')->middleware('role:giaovien')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\GiaoVien\DashboardController::class, 'index'])->name('dashboard');
        
        // Quản lý điểm
        Route::prefix('diem')->name('diem.')->group(function() {
            Route::get('/nhap', [App\Http\Controllers\GiaoVien\DiemController::class, 'nhapDiem'])->name('nhap');
            
            // 1. ĐÃ SỬA: Thêm ->name('luu') vào cuối dòng này
            Route::post('/nhap', [App\Http\Controllers\GiaoVien\DiemController::class, 'luuDiem'])->name('luu');
            
            // 2. ĐÃ THÊM: Route để Javascript gọi lấy danh sách học sinh
            Route::get('/get-hoc-sinh', [App\Http\Controllers\GiaoVien\DiemController::class, 'getHocSinhTheoPhanCong'])->name('get-hoc-sinh');
            
            Route::get('/danh-sach', [App\Http\Controllers\GiaoVien\DiemController::class, 'danhSach'])->name('danh-sach');
            Route::get('/{id}/sua', [App\Http\Controllers\GiaoVien\DiemController::class, 'sua'])->name('sua');
            Route::put('/{id}', [App\Http\Controllers\GiaoVien\DiemController::class, 'capNhat'])->name('cap-nhat');
            Route::get('/nhap-nhanh', [App\Http\Controllers\GiaoVien\DiemController::class, 'nhapNhanh'])->name('nhap-nhanh');
            Route::post('/luu-nhap-nhanh', [App\Http\Controllers\GiaoVien\DiemController::class, 'luuNhapNhanh'])->name('luu-nhap-nhanh');
        });
        
        // Quản lý tài liệu
        Route::resource('tailieu', App\Http\Controllers\GiaoVien\TaiLieuController::class);
        
        // Chủ nhiệm
        Route::prefix('chunhiem')->name('chunhiem.')->group(function() {
            Route::get('/hocsinh', [App\Http\Controllers\GiaoVien\ChuNhiemController::class, 'hocSinh'])->name('hocsinh');
            Route::get('/diem', [App\Http\Controllers\GiaoVien\ChuNhiemController::class, 'diem'])->name('diem');
        });
    });
    
    // Học sinh Routes
    Route::prefix('hocsinh')->name('hocsinh.')->middleware('role:hocsinh')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\HocSinh\DashboardController::class, 'index'])->name('dashboard');
        
        // 1. Xem điểm (Đã bọc group và thêm Bảng tổng hợp)
        Route::prefix('diem')->name('diem.')->group(function() {
            Route::get('/', [App\Http\Controllers\HocSinh\DiemController::class, 'xemDiem'])->name('xem');
            Route::get('/chi-tiet/{monHocId}', [App\Http\Controllers\HocSinh\DiemController::class, 'chiTiet'])->name('chi-tiet');
            Route::get('/bang-tong-hop', [App\Http\Controllers\HocSinh\DiemController::class, 'bangTongHop'])->name('bang-tong-hop');
        });
        
        // 2. Tài liệu học tập (Đã sửa lại tên chuẩn và thêm Lọc theo môn)
        Route::prefix('tai-lieu')->name('tailieu.')->group(function() {
            Route::get('/', [App\Http\Controllers\HocSinh\TaiLieuController::class, 'index'])->name('index');
            Route::get('/theo-mon', [App\Http\Controllers\HocSinh\TaiLieuController::class, 'theoMon'])->name('theo-mon');
            Route::get('/{id}', [App\Http\Controllers\HocSinh\TaiLieuController::class, 'xem'])->name('xem');
            Route::get('/{id}/download', [App\Http\Controllers\HocSinh\TaiLieuController::class, 'download'])->name('download');
        });
        
        // 3. Thông tin (Đã bọc group cho gọn)
        Route::prefix('thong-tin')->name('thongtin.')->group(function() {
            Route::get('/ca-nhan', [App\Http\Controllers\HocSinh\ThongTinController::class, 'caNhan'])->name('ca-nhan');
            Route::get('/lop', [App\Http\Controllers\HocSinh\ThongTinController::class, 'lop'])->name('lop');
            Route::get('/giao-vien', [App\Http\Controllers\HocSinh\ThongTinController::class, 'giaoVien'])->name('giaovien');
        });
    });           
});


