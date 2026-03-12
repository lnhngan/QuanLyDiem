<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanCongGiangDay extends Model
{
    use HasFactory;

    protected $table = 'phan_cong_giang_day';
    protected $fillable = [
        'giao_vien_id', 
        'mon_hoc_id', 
        'lop_id', 
        'hoc_ky_id'
    ];

    /**
     * Phân công thuộc về một giáo viên
     */
    public function giaoVien()
    {
        return $this->belongsTo(GiaoVien::class, 'giao_vien_id');
    }

    /**
     * Phân công thuộc về một môn học
     */
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'mon_hoc_id');
    }

    /**
     * Phân công thuộc về một lớp học
     */
    public function lopHoc()
    {
        return $this->belongsTo(LopHoc::class, 'lop_id');
    }

    /**
     * Phân công thuộc về một học kỳ
     */
    public function hocKy()
    {
        return $this->belongsTo(HocKy::class, 'hoc_ky_id');
    }
}