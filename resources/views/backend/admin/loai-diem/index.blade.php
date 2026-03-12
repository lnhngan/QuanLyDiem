@extends('layouts.backend')
@section('title', 'Quản lý Loại điểm')
@section('page-title', 'Danh sách Loại điểm')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách Loại điểm</h5>
        <a href="{{ route('admin.loai-diem.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Thêm mới</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên loại điểm</th>
                        <th>Hệ số</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loaiDiems as $key => $ld)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="fw-bold text-primary">{{ $ld->ten_loai_diem }}</td>
                        <td><span class="badge bg-info text-dark">Hệ số {{ $ld->he_so }}</span></td>
                        <td>
                            <a href="{{ route('admin.loai-diem.edit', $ld->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            
                            <button type="button" onclick="confirmDelete('{{ route('admin.loai-diem.destroy', $ld->id) }}')" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $loaiDiems->links() ?? '' }}
        </div>
    </div>
</div>
@endsection