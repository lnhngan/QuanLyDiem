@extends('layouts.backend')
@section('title', 'Quản lý Học sinh')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách học sinh</h5>
        <a href="{{ route('admin.hocsinh.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Thêm mới</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Mã HS</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Lớp</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hocsinhs as $hs)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $hs->ma_hoc_sinh }}</span></td>
                        <td class="fw-bold">{{ $hs->ho_ten }}</td>
                        <td>{{ \Carbon\Carbon::parse($hs->ngay_sinh)->format('d/m/Y') }}</td>
                        <td>{{ $hs->lop->ten_lop ?? 'Chưa xếp lớp' }}</td>
                        <td>
                            @if($hs->taiKhoan && $hs->taiKhoan->trang_thai) 
                                <span class="badge bg-success">Hoạt động</span>
                            @else 
                                <span class="badge bg-danger">Khóa</span> 
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.hocsinh.show', $hs->id) }}" class="btn btn-info btn-sm text-white"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.hocsinh.edit', $hs->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <button type="button" onclick="confirmDelete('{{ route('admin.hocsinh.destroy', $hs->id) }}')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $hocsinhs->links() }}</div>
    </div>
</div>
@endsection