<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuCauSuaDiem extends Model
{
    use HasFactory;

    protected $table = 'yeu_cau_sua_diem';

    protected $fillable = [
        'bang_diem_id',
        'giao_vien_id',
        'diem_cu',
        'diem_moi',
        'ly_do',
        'trang_thai'
    ];

    // Tạo liên kết đến bảng điểm
    public function bangDiem()
    {
        return $this->belongsTo(BangDiem::class, 'bang_diem_id');
    }

    // Tạo liên kết đến giáo viên
    public function giaoVien()
    {
        return $this->belongsTo(GiaoVien::class, 'giao_vien_id');
    }
}
