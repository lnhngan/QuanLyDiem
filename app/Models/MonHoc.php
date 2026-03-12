<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    use HasFactory;

    protected $table = 'mon_hoc';
    protected $fillable = ['ten_mon_hoc'];

    /**
     * Một môn học có nhiều phân công giảng dạy
     */
    public function phanCongGiangDays()
    {
        return $this->hasMany(PhanCongGiangDay::class, 'mon_hoc_id');
    }

    /**
     * Một môn học có nhiều bảng điểm
     */
    public function bangDiems()
    {
        return $this->hasMany(BangDiem::class, 'mon_hoc_id');
    }

    /**
     * Một môn học có nhiều tài liệu
     */
    public function taiLieus()
    {
        return $this->hasMany(TaiLieu::class, 'mon_hoc_id');
    }

    /**
     * Lấy danh sách giáo viên dạy môn này
     */
    public function giaoViens()
    {
        return $this->belongsToMany(GiaoVien::class, 'phan_cong_giang_day', 'mon_hoc_id', 'giao_vien_id')
                    ->withPivot('lop_id', 'hoc_ky_id')
                    ->withTimestamps();
    }

    /**
     * Lấy danh sách lớp học môn này
     */
    public function lopHocs()
    {
        return $this->belongsToMany(LopHoc::class, 'phan_cong_giang_day', 'mon_hoc_id', 'lop_id')
                    ->withPivot('giao_vien_id', 'hoc_ky_id')
                    ->withTimestamps();
    }
}