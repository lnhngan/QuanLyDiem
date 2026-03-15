@extends('layouts.backend')
@section('title', 'Tài liệu của tôi')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Quản lý Tài liệu giảng dạy</h5>
        <a href="{{ route('giaovien.tailieu.create') }}" class="btn btn-primary btn-sm">Đăng tài liệu</a>
    </div>
    <div class="card-body">
        @include('partials.messages')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Môn học</th>
                    <th>Khối</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tailieus as $tl)
                <tr>
                    <td>{{ $tl->tieu_de }}</td>
                    <td>{{ $tl->danhMuc->ten_danh_muc ?? '' }}</td>
                    <td>{{ $tl->monHoc->ten_mon_hoc ?? '' }}</td>
                    <td>{{ $tl->khoiLop->ten_khoi ?? '' }}</td>
                    <td>
                        <a href="{{ Storage::url($tl->duong_dan_file) }}" target="_blank" class="btn btn-info btn-sm text-white"><i class="bi bi-eye"></i> Xem</a>
                        <a href="{{ route('giaovien.tailieu.edit', $tl->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('giaovien.tailieu.destroy', $tl->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xóa tài liệu này?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Chưa có tài liệu nào.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $tailieus->links() }}
    </div>
</div>
@endsection