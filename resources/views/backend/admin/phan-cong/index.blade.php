@extends('layouts.backend')
@section('title', 'Phân công giảng dạy')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách Phân công</h5>
        <a href="{{ route('admin.phan-cong.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Phân công mới</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Giáo viên</th>
                        <th>Môn học</th>
                        <th>Lớp học</th>
                        <th>Năm học</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($phancongs as $pc)
                    <tr>
                        <td class="fw-bold text-success">{{ $pc->giaoVien->ho_ten ?? 'N/A' }}</td>
                        <td>{{ $pc->monHoc->ten_mon_hoc ?? 'N/A' }}</td>
                        <td>{{ $pc->lopHoc->ten_lop ?? 'N/A' }}</td>
                        <td>{{ $pc->namHoc->ten_nam_hoc ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.phan-cong.edit', $pc->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <button onclick="confirmDelete('{{ route('admin.phan-cong.destroy', $pc->id) }}')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Chưa có phân công nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection