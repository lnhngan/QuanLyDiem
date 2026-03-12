<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoiLop extends Model
{
    use HasFactory;

    protected $table = 'khoi_lop';
    protected $fillable = ['ten_khoi'];

    /**
     * Một khối lớp có nhiều lớp học
     */
    public function lopHocs()
    {
        return $this->hasMany(LopHoc::class, 'khoi_lop_id');
    }

    /**
     * Một khối lớp có nhiều tài liệu
     */
    public function taiLieus()
    {
        return $this->hasMany(TaiLieu::class, 'khoi_lop_id');
    }
}