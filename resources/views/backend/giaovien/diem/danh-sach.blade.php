@extends('layouts.backend')
@section('title', 'Danh sách điểm đã nhập')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lịch sử nhập điểm của tôi</h5>
        <a href="{{ route('giaovien.diem.nhap') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Nhập điểm mới</a>
    </div>
    <div class="card-body">
        @include('partials.messages')
        
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Học sinh</th>
                        <th>Lớp</th>
                        <th>Môn học</th>
                        <th>Học kỳ</th>
                        <th>Loại điểm</th>
                        <th>Điểm số</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bangDiems as $key => $diem)
                    <tr>
                        <td>{{ $bangDiems->firstItem() + $key }}</td>
                        <td class="fw-bold">{{ $diem->hocSinh->ho_ten ?? 'N/A' }}</td>
                        <td>{{ $diem->hocSinh->lop->ten_lop ?? 'N/A' }}</td>
                        <td>{{ $diem->monHoc->ten_mon_hoc ?? 'N/A' }}</td>
                        <td>{{ $diem->hocKy->ten_hoc_ky ?? 'N/A' }}</td>
                        <td><span class="badge bg-info text-dark">{{ $diem->loaiDiem->ten_loai_diem ?? 'N/A' }}</span></td>
                        <td>
                            <strong class="{{ $diem->diem_so < 5 ? 'text-danger' : 'text-success' }}">
                                {{ number_format($diem->diem_so, 1) }}
                            </strong>
                        </td>
                        <td>
                            <a href="{{ route('giaovien.diem.sua', $diem->id) }}" class="btn btn-sm btn-warning" title="Sửa điểm"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Bạn chưa nhập điểm nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            {{ $bangDiems->links() }}
        </div>
    </div>
</div>
@endsection