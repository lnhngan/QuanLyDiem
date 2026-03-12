@extends('layouts.backend')
@section('title', 'Quản lý Khối lớp')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách Khối lớp</h5>
        <a href="{{ route('admin.khoilop.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Thêm mới</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Khối lớp</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($khoilops as $key => $khoi)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="fw-bold text-primary">{{ $khoi->ten_khoi }}</td>
                        <td>
                            <a href="{{ route('admin.khoilop.edit', $khoi->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <button onclick="confirmDelete('{{ route('admin.khoilop.destroy', $khoi->id) }}')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center">Chưa có dữ liệu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection