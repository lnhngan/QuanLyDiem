<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamHoc extends Model
{
    use HasFactory;

    protected $table = 'nam_hoc';
    protected $fillable = ['ten_nam_hoc'];

    /**
     * Một năm học có nhiều học kỳ
     */
    public function hocKys()
    {
        return $this->hasMany(HocKy::class, 'nam_hoc_id');
    }

    /**
     * Một năm học có nhiều lớp học
     */
    public function lopHocs()
    {
        return $this->hasMany(LopHoc::class, 'nam_hoc_id');
    }
}