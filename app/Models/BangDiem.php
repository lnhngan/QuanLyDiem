<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BangDiem extends Model
{
    use HasFactory;

    protected $table = 'bang_diem';
    protected $fillable = [
        'hoc_sinh_id', 
        'mon_hoc_id', 
        'hoc_ky_id', 
        'loai_diem_id', 
        'diem_so', 
        'giao_vien_id'
    ];

    protected $casts = [
        'diem_so' => 'float',
    ];

    /**
     * Bảng điểm thuộc về một học sinh
     */
    public function hocSinh()
    {
        return $this->belongsTo(HocSinh::class, 'hoc_sinh_id');
    }

    /**
     * Bảng điểm thuộc về một môn học
     */
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'mon_hoc_id');
    }

    /**
     * Bảng điểm thuộc về một học kỳ
     */
    public function hocKy()
    {
        return $this->belongsTo(HocKy::class, 'hoc_ky_id');
    }

    /**
     * Bảng điểm thuộc về một loại điểm
     */
    public function loaiDiem()
    {
        return $this->belongsTo(LoaiDiem::class, 'loai_diem_id');
    }

    /**
     * Bảng điểm do một giáo viên nhập
     */
    public function giaoVien()
    {
        return $this->belongsTo(GiaoVien::class, 'giao_vien_id');
    }

    /**
     * Scope lấy điểm theo học kỳ
     */
    public function scopeTheoHocKy($query, $hocKyId)
    {
        return $query->where('hoc_ky_id', $hocKyId);
    }

    /**
     * Scope lấy điểm theo môn học
     */
    public function scopeTheoMon($query, $monHocId)
    {
        return $query->where('mon_hoc_id', $monHocId);
    }

    /**
     * Scope lấy điểm theo học sinh
     */
    public function scopeTheoHocSinh($query, $hocSinhId)
    {
        return $query->where('hoc_sinh_id', $hocSinhId);
    }
}