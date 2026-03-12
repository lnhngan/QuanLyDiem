@extends('layouts.backend')
@section('title', 'Quản lý Năm học')
@section('page-title', 'Danh sách năm học')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách năm học</h5>
        <a href="{{ route('admin.namhoc.create') }}" class="btn btn-primary btn-sm">
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

        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên năm học</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($namhocs as $key => $nh)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="fw-bold">{{ $nh->ten_nam_hoc }}</td>
                        <td><span class="badge bg-success">Đang hoạt động</span></td>
                        <td>
                            <a href="{{ route('admin.namhoc.edit', $nh->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button onclick="confirmDelete('{{ route('admin.namhoc.destroy', $nh->id) }}')" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center">Chưa có dữ liệu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection