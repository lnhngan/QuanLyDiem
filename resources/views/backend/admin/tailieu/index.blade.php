@extends('layouts.backend')
@section('title', 'Quản lý Tài liệu')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách Tài liệu học tập</h5>
        <div class="d-flex gap-2">
            <a href="{{ route(name: 'admin.tailieu.thong-ke') }}" class="btn btn-info btn-sm text-white"><i class="bi bi-bar-chart"></i> Thống kê</a>
            <a href="{{ route('admin.tailieu.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-cloud-upload"></i> Upload Tài liệu</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover datatable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Tên tài liệu</th>
                        <th>Danh mục</th>
                        <th>Người đăng</th>
                        <th>File đính kèm</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tailieus as $tl)
                    <tr>
                        <td class="fw-bold">{{ $tl->tieu_de }}</td> <td>{{ $tl->danhMuc->ten_danh_muc ?? 'Chung' }}</td>
                        <td>{{ $tl->giaoVien->ho_ten ?? 'Admin' }}</td>
                        <td>
                            @if($tl->duong_dan_file) <a href="{{ asset('storage/'.$tl->duong_dan_file) }}" target="_blank" class="badge bg-success text-decoration-none"><i class="bi bi-download"></i> Tải về</a>
                            @else
                                <span class="badge bg-secondary">Không có file</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.tailieu.edit', $tl->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <button type="button" onclick="confirmDelete('{{ route('admin.tailieu.destroy', $tl->id) }}')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection