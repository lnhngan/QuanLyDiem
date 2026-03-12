@extends('layouts.backend')
@section('title', 'Danh mục tài liệu')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách Danh mục tài liệu</h5>
        <a href="{{ route('admin.danh-muc-tai-lieu.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Thêm danh mục
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
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($danhmucs as $key => $dm)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="fw-bold">{{ $dm->ten_danh_muc }}</td>
                        <td>{{ $dm->mo_ta ?? 'Không có mô tả' }}</td>
                        <td>
                            <a href="{{ route('admin.danh-muc-tai-lieu.edit', $dm->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.danh-muc-tai-lieu.destroy', $dm->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Chưa có dữ liệu danh mục</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection