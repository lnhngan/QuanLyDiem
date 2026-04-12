<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocSinh extends Model
{
    use HasFactory;

    protected $table = 'hoc_sinh';
    protected $fillable = [
        'ma_hoc_sinh',
        'ho_ten',
        'ngay_sinh',
        'gioi_tinh',
        'dia_chi',
        'sdt_phu_huynh', 
        'lop_id',
        'tai_khoan_id'
    ];

    protected $casts = [
        'ngay_sinh' => 'date',
    ];

    /**
     * Học sinh thuộc về một tài khoản
     */
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    /**
     * Học sinh thuộc về một lớp
     */
    public function lop()
    {
        return $this->belongsTo(LopHoc::class, 'lop_id');
    }

    /**
     * Một học sinh có nhiều bảng điểm
     */
    public function bangDiems()
    {
        return $this->hasMany(BangDiem::class, 'hoc_sinh_id');
    }

    /**
     * Lấy điểm trung bình của học sinh theo học kỳ
     */
    public function diemTrungBinhTheoHocKy($hocKyId)
    {
        $diem = $this->bangDiems()
                    ->where('hoc_ky_id', $hocKyId)
                    ->join('loai_diem', 'bang_diem.loai_diem_id', '=', 'loai_diem.id')
                    ->selectRaw('SUM(bang_diem.diem_so * loai_diem.he_so) / SUM(loai_diem.he_so) as diem_tb')
                    ->first();
        
        return $diem ? round($diem->diem_tb, 2) : 0;
    }

    /**
     * Lấy điểm các môn của học sinh theo học kỳ
     */
    public function diemTheoMonHocKy($hocKyId)
    {
        return $this->bangDiems()
                    ->where('hoc_ky_id', $hocKyId)
                    ->with(['monHoc', 'loaiDiem'])
                    ->get()
                    ->groupBy('mon_hoc_id');
    }
}