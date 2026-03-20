@extends('layouts.backend')
@section('title', 'Xem điểm cá nhân')

@section('content')
<div class="card shadow-sm border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-graph-up"></i> Tra cứu điểm số cá nhân</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('hocsinh.diem.xem') }}" method="GET" class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Chọn học kỳ</label>
                <select name="hoc_ky_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tất cả học kỳ --</option>
                    @foreach($hocKys ?? [] as $hk)
                        <option value="{{ $hk->id }}" {{ request('hoc_ky_id') == $hk->id ? 'selected' : '' }}>
                            {{ $hk->ten_hoc_ky }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th class="text-start">Môn học</th>
                        <th>Học kỳ</th>
                        <th>Loại điểm</th>
                        <th>Điểm số</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bangDiems ?? [] as $key => $diem)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="text-start fw-bold text-primary">{{ $diem->monHoc->ten_mon_hoc ?? '' }}</td>
                        <td>{{ $diem->hocKy->ten_hoc_ky ?? '' }}</td>
                        <td><span class="badge bg-secondary">{{ $diem->loaiDiem->ten_loai_diem ?? '' }}</span></td>
                        <td>
                            <strong class="{{ $diem->diem_so < 5 ? 'text-danger' : 'text-success' }} fs-5">
                                {{ number_format($diem->diem_so, 1) }}
                            </strong>
                        </td>
                        <td>
                            <a href="{{ route('hocsinh.diem.chi-tiet', $diem->mon_hoc_id) }}" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i> Xem môn
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Chưa có dữ liệu điểm nào được nhập.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection