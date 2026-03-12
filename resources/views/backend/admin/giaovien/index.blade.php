@extends('layouts.backend')

@section('title', 'Quản lý Giáo viên')
@section('page-title', 'Danh sách giáo viên')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách giáo viên</h5>
        <a href="{{ route('admin.giaovien.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Thêm mới
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Tên đăng nhập</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($giaoviens as $key => $gv)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $gv->ho_ten }}</td>
                        <td>{{ $gv->email }}</td>
                        <td>{{ $gv->so_dien_thoai }}</td>
                        <td>{{ $gv->taiKhoan->ten_dang_nhap ?? 'N/A' }}</td>
                        <td>
                            @if($gv->taiKhoan && $gv->taiKhoan->trang_thai)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Khóa</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.giaovien.edit', $gv->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button onclick="confirmDelete('{{ route('admin.giaovien.destroy', $gv->id) }}')" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Chưa có dữ liệu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $giaoviens->links() }}
        </div>
    </div>
</div>
@endsection