<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gioi-thieu', [HomeController::class, 'gioiThieu'])->name('gioi-thieu');
Route::get('/lien-he', [HomeController::class, 'lienHe'])->name('lien-he');

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
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('can:admin')->group(function() {
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
        Route::resource('tai-lieu', App\Http\Controllers\Admin\TaiLieuController::class);
    });
    
    // Giáo viên Routes
    Route::prefix('giaovien')->name('giaovien.')->middleware('can:giaovien')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\GiaoVien\DashboardController::class, 'index'])->name('dashboard');
        
        // Quản lý điểm
        Route::prefix('diem')->name('diem.')->group(function() {
            Route::get('/nhap', [App\Http\Controllers\GiaoVien\DiemController::class, 'nhapDiem'])->name('nhap');
            Route::post('/nhap', [App\Http\Controllers\GiaoVien\DiemController::class, 'luuDiem']);
            Route::get('/danh-sach', [App\Http\Controllers\GiaoVien\DiemController::class, 'danhSach'])->name('danh-sach');
            Route::get('/{id}/sua', [App\Http\Controllers\GiaoVien\DiemController::class, 'sua'])->name('sua');
            Route::put('/{id}', [App\Http\Controllers\GiaoVien\DiemController::class, 'capNhat'])->name('cap-nhat');
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
    Route::prefix('hocsinh')->name('hocsinh.')->middleware('can:hocsinh')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\HocSinh\DashboardController::class, 'index'])->name('dashboard');
        
        // Xem điểm
        Route::get('/diem', [App\Http\Controllers\HocSinh\DiemController::class, 'xemDiem'])->name('diem.xem');
        Route::get('/diem/chi-tiet/{monHocId}', [App\Http\Controllers\HocSinh\DiemController::class, 'chiTiet'])->name('diem.chi-tiet');
        
        // Tài liệu học tập
        Route::get('/tai-lieu', [App\Http\Controllers\HocSinh\TaiLieuController::class, 'index'])->name('tailieu.xem');
        Route::get('/tai-lieu/{id}', [App\Http\Controllers\HocSinh\TaiLieuController::class, 'xem'])->name('tailieu.xem-chi-tiet');
        Route::get('/tai-lieu/{id}/download', [App\Http\Controllers\HocSinh\TaiLieuController::class, 'download'])->name('tailieu.download');
        
        // Thông tin
        Route::get('/thong-tin/ca-nhan', [App\Http\Controllers\HocSinh\ThongTinController::class, 'caNhan'])->name('thongtin.ca-nhan');
        Route::get('/thong-tin/lop', [App\Http\Controllers\HocSinh\ThongTinController::class, 'lop'])->name('thongtin.lop');
        Route::get('/thong-tin/giao-vien', [App\Http\Controllers\HocSinh\ThongTinController::class, 'giaoVien'])->name('thongtin.giaovien');
    });
});


//test
Route::get('/test-middleware', function() {
    $middlewares = app('router')->getMiddleware();
    
    return [
        'registered_middlewares' => $middlewares,
        'has_can_alias' => isset($middlewares['can']),
        'can_alias_points_to' => $middlewares['can'] ?? 'not found',
    ];
});