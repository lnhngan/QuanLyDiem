@extends('layouts.backend')
@section('title', 'Tài liệu học tập')

@section('content')
<div class="card shadow-sm mb-4 border-0">
    <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom">
        <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-journal-bookmark"></i> Kho Tài Liệu Mới Nhất</h5>
        <a href="{{ route('hocsinh.tailieu.theo-mon') }}" class="btn btn-outline-primary btn-sm">Xem theo Môn học</a>
    </div>
    <div class="card-body bg-light">
        <form action="{{ route('hocsinh.tailieu.index') }}" method="GET" class="mb-4">
            <div class="input-group shadow-sm">
                <input type="text" name="search" class="form-control border-primary" placeholder="Nhập tên tài liệu bạn muốn tìm..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i> Tìm</button>
            </div>
        </form>

        <div class="row">
            @forelse($taiLieus ?? [] as $tl)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-info text-dark">{{ $tl->monHoc->ten_mon_hoc ?? 'Môn chung' }}</span>
                            <small class="text-muted"><i class="bi bi-clock"></i> {{ $tl->created_at->format('d/m/Y') }}</small>
                        </div>
                        <h5 class="card-title fw-bold text-truncate text-dark" title="{{ $tl->tieu_de }}">{{ $tl->tieu_de }}</h5>
                        <p class="card-text text-muted small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $tl->mo_ta ?? 'Giáo viên không để lại mô tả.' }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-3">
                        <a href="{{ route('hocsinh.tailieu.xem', $tl->id) }}" class="btn btn-primary w-100"><i class="bi bi-eye"></i> Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-folder-x" style="font-size: 4rem; opacity: 0.5;"></i>
                <p class="mt-3 fs-5">Hiện tại không có tài liệu nào.</p>
            </div>
            @endforelse
        </div>
        
        <div class="d-flex justify-content-center mt-3">
            {{ isset($taiLieus) && method_exists($taiLieus, 'links') ? $taiLieus->links() : '' }}
        </div>
    </div>
</div>
@endsection