@extends('layouts.backend')
@section('title', 'Tài liệu theo môn')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-info text-white py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-collection"></i> Khám Phá Tài Liệu Theo Môn Học</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 border-end pe-3">
                <h6 class="fw-bold mb-3 text-secondary text-uppercase"><i class="bi bi-funnel"></i> Lọc theo Môn</h6>
                <div class="list-group shadow-sm">
                    <a href="{{ route('hocsinh.tailieu.theo-mon') }}" class="list-group-item list-group-item-action {{ !request('mon_hoc_id') ? 'active bg-info border-info' : '' }}">
                        <i class="bi bi-grid"></i> Tất cả môn học
                    </a>
                    @foreach($monHocs ?? [] as $mh)
                    <a href="{{ route('hocsinh.tailieu.theo-mon', ['mon_hoc_id' => $mh->id]) }}" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request('mon_hoc_id') == $mh->id ? 'active bg-info border-info' : '' }}">
                        {{ $mh->ten_mon_hoc }}
                        <span class="badge bg-secondary rounded-pill">{{ $mh->tai_lieus_count ?? '' }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            
            <div class="col-md-9 ps-4">
                <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">
                    Tài liệu môn: <span class="text-danger">{{ $monHocActive->ten_mon_hoc ?? 'Tất Cả' }}</span>
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Tiêu đề tài liệu</th>
                                <th>Môn học</th>
                                <th>Ngày cung cấp</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($taiLieus ?? [] as $tl)
                            <tr>
                                <td class="fw-bold text-dark">{{ $tl->tieu_de }}</td>
                                <td><span class="badge bg-secondary">{{ $tl->monHoc->ten_mon_hoc ?? '' }}</span></td>
                                <td class="text-muted"><i class="bi bi-calendar-event"></i> {{ $tl->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('hocsinh.tailieu.xem', $tl->id) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                        <i class="bi bi-box-arrow-in-right"></i> Mở
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-box-seam text-muted" style="font-size: 2rem;"></i>
                                    <p class="mt-2 text-muted mb-0">Môn học này hiện chưa có giáo viên nào tải tài liệu lên.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ isset($taiLieus) && method_exists($taiLieus, 'links') ? $taiLieus->links() : '' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection