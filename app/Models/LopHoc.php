<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;

    protected $table = 'lop_hoc';
    protected $fillable = [
        'ten_lop', 
        'khoi_lop_id', 
        'nam_hoc_id', 
        'gv_chu_nhiem_id'
    ];

    /**
     * Lớp học thuộc về một khối lớp
     */
    public function khoiLop()
    {
        return $this->belongsTo(KhoiLop::class, 'khoi_lop_id');
    }

    /**
     * Lớp học thuộc về một năm học
     */
    public function namHoc()
    {
        return $this->belongsTo(NamHoc::class, 'nam_hoc_id');
    }

    /**
     * Lớp học có một giáo viên chủ nhiệm
     */
    public function giaoVienChuNhiem()
    {
        return $this->belongsTo(GiaoVien::class, 'gv_chu_nhiem_id');
    }

    /**
     * Một lớp học có nhiều học sinh
     */
    public function hocSinhs()
    {
        return $this->hasMany(HocSinh::class, 'lop_id');
    }

    /**
     * Một lớp học có nhiều phân công giảng dạy
     */
    public function phanCongGiangDays()
    {
        return $this->hasMany(PhanCongGiangDay::class, 'lop_id');
    }

    /**
     * Lấy danh sách giáo viên dạy lớp này (thông qua phân công)
     */
    public function giaoViens()
    {
        return $this->belongsToMany(GiaoVien::class, 'phan_cong_giang_day', 'lop_id', 'giao_vien_id')
                    ->withPivot('mon_hoc_id', 'hoc_ky_id')
                    ->withTimestamps();
    }

    /**
     * Lấy danh sách môn học của lớp này
     */
    public function monHocs()
    {
        return $this->belongsToMany(MonHoc::class, 'phan_cong_giang_day', 'lop_id', 'mon_hoc_id')
                    ->withPivot('giao_vien_id', 'hoc_ky_id')
                    ->withTimestamps();
    }
}