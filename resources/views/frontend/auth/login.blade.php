@extends('layouts.frontend')

@section('title', 'Đăng nhập - THPT Nguyễn Bỉnh Khiêm')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h4 class="mb-0">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập hệ thống
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="ten_dang_nhap" class="form-label">
                                <i class="bi bi-person me-1"></i>Tên đăng nhập
                            </label>
                            <input type="text" 
                                   class="form-control @error('ten_dang_nhap') is-invalid @enderror" 
                                   id="ten_dang_nhap" 
                                   name="ten_dang_nhap" 
                                   value="{{ old('ten_dang_nhap') }}"
                                   placeholder="Nhập mã giáo viên hoặc học sinh"
                                   required>
                            @error('ten_dang_nhap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="mat_khau" class="form-label">
                                <i class="bi bi-lock me-1"></i>Mật khẩu
                            </label>
                            <input type="password" 
                                   class="form-control @error('mat_khau') is-invalid @enderror" 
                                   id="mat_khau" 
                                   name="mat_khau" 
                                   placeholder="••••••••"
                                   required>
                            @error('mat_khau')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection