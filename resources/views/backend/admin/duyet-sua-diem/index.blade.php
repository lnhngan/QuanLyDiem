@extends('layouts.backend')
@section('title', 'Duyệt yêu cầu sửa điểm')

@section('content')
    <div class="card shadow border-danger">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="bi bi-shield-check"></i> Phê duyệt Yêu cầu Sửa điểm</h5>
        </div>
        <div class="card-body p-0">
            @include('partials.messages')

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Học sinh</th>
                            <th>Môn học</th>
                            <th>Giáo viên y/c</th>
                            <th>Điểm Cũ ➡️ Mới</th>
                            <th>Lý do</th>
                            <th>Thời gian</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($yeuCaus as $key => $yc)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="fw-bold text-primary text-start">
                                    {{ $yc->bangDiem->hocSinh->ma_hoc_sinh }} <br>
                                    {{ $yc->bangDiem->hocSinh->ho_ten }}
                                </td>
                                <td>
                                    {{ $yc->bangDiem->monHoc->ten_mon_hoc }} <br>
                                    <span class="badge bg-secondary">{{ $yc->bangDiem->loaiDiem->ten_loai_diem }}</span>
                                </td>
                                <td>{{ $yc->giaoVien->ho_ten }}</td>
                                <td class="fw-bold fs-5">
                                    <span class="text-secondary">{{ $yc->diem_cu }}</span>
                                    <i class="bi bi-arrow-right text-success mx-2"></i>
                                    <span class="text-danger">{{ $yc->diem_moi }}</span>
                                </td>
                                <td class="text-start fst-italic">{{ $yc->ly_do }}</td>
                                <td class="text-muted" style="font-size: 0.85rem">
                                    {{ $yc->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td>
                                    <form action="{{ route('admin.duyet-sua-diem.duyet', $yc->id) }}" method="POST"
                                        class="d-block mb-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success w-100"
                                            onclick="return confirm('Bạn có chắc chắn muốn CHẤP NHẬN cập nhật điểm này không?')">
                                            <i class="bi bi-check-circle"></i> Duyệt
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.duyet-sua-diem.tu-choi', $yc->id) }}" method="POST"
                                        class="d-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100"
                                            onclick="return confirm('Bạn sẽ TỪ CHỐI yêu cầu này?')">
                                            Từ chối
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-success">
                                    <i class="bi bi-check2-all fs-1"></i><br>
                                    <h5>Hiện tại không có yêu cầu sửa điểm nào cần xử lý.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection