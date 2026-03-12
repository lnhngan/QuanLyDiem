@extends('layouts.backend')
@section('title', 'Quản lý Lớp học')
@section('page-title', 'Danh sách Lớp học')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách Lớp học</h5>
        <a href="{{ route('admin.lophoc.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Thêm Lớp
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Tên Lớp</th>
                        <th>Khối</th>
                        <th>Năm Học</th>
                        <th>Giáo viên Chủ nhiệm</th>
                        <th>Sĩ số</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lophocs as $lop)
                    <tr>
                        <td class="fw-bold text-primary">{{ $lop->ten_lop }}</td>
                        <td>{{ $lop->khoiLop->ten_khoi ?? 'N/A' }}</td>
                        <td>{{ $lop->namHoc->ten_nam_hoc ?? 'N/A' }}</td>
                        <td>{{ $lop->giaoVien->ho_ten ?? 'Chưa phân công' }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $lop->hoc_sinhs_count ?? ($lop->hocSinhs ? $lop->hocSinhs->count() : 0) }} HS
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.lophoc.show', $lop->id) }}" class="btn btn-info btn-sm text-white" title="Xem danh sách học sinh">
                                <i class="bi bi-people"></i>
                            </a>
                            <a href="{{ route('admin.lophoc.edit', $lop->id) }}" class="btn btn-warning btn-sm" title="Sửa thông tin">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.lophoc.destroy', $lop->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa lớp học này?');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Xóa"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Chưa có dữ liệu lớp học</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $lophocs->links() ?? '' }}
        </div>
    </div>
</div>
@endsection