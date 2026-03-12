@extends('layouts.backend')
@section('title', 'Quản lý Giáo viên')
@section('page-title', 'Danh sách giáo viên')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách giáo viên</h5>
        <a href="{{ route('admin.giaovien.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Thêm mới</a>
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
                        <th>Mã GV</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Tên đăng nhập</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($giaoviens as $gv)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $gv->ma_gv }}</span></td>
                        <td class="fw-bold">{{ $gv->ho_ten }}</td>
                        <td>{{ $gv->email }}</td>
                        <td>{{ $gv->so_dien_thoai ?? 'N/A' }}</td>
                        <td>{{ $gv->taiKhoan->ten_dang_nhap ?? 'N/A' }}</td>
                        <td>
                            @if($gv->taiKhoan && $gv->taiKhoan->trang_thai)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Khóa</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.giaovien.show', $gv->id) }}" class="btn btn-info btn-sm text-white"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.giaovien.edit', $gv->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.giaovien.destroy', $gv->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa giáo viên này?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center">Chưa có dữ liệu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">{{ $giaoviens->links() }}</div>
    </div>
</div>
@endsection