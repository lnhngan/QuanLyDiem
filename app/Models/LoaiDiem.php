<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiDiem extends Model
{
    use HasFactory;

    protected $table = 'loai_diem';
    protected $fillable = ['ten_loai_diem', 'he_so'];

    /**
     * Một loại điểm có nhiều bảng điểm
     */
    public function bangDiems()
    {
        return $this->hasMany(BangDiem::class, 'loai_diem_id');
    }
}