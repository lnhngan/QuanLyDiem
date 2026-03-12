@extends('layouts.backend')
@section('title', 'Quản lý Môn học')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách Môn học</h5>
        <a href="{{ route('admin.monhoc.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Thêm môn</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Mã Môn</th>
                        <th>Tên Môn học</th>
                        <th>Số tiết</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($monhocs as $mon)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $mon->ma_mon }}</span></td>
                        <td class="fw-bold">{{ $mon->ten_mon_hoc }}</td>
                        <td>{{ $mon->so_tiet ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.monhoc.edit', $mon->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <button onclick="confirmDelete('{{ route('admin.monhoc.destroy', $mon->id) }}')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
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