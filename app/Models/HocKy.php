<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocKy extends Model
{
    use HasFactory;

    protected $table = 'hoc_ky';
    protected $fillable = ['ten_hoc_ky', 'nam_hoc_id'];

    /**
     * Học kỳ thuộc về một năm học
     */
    public function namHoc()
    {
        return $this->belongsTo(NamHoc::class, 'nam_hoc_id');
    }

    /**
     * Một học kỳ có nhiều phân công giảng dạy
     */
    public function phanCongGiangDays()
    {
        return $this->hasMany(PhanCongGiangDay::class, 'hoc_ky_id');
    }

    /**
     * Một học kỳ có nhiều bảng điểm
     */
    public function bangDiems()
    {
        return $this->hasMany(BangDiem::class, 'hoc_ky_id');
    }
}