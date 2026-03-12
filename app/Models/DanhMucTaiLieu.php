<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucTaiLieu extends Model
{
    use HasFactory;

    protected $table = 'danh_muc_tai_lieu';
    protected $fillable = ['ten_danh_muc'];

    /**
     * Một danh mục có nhiều tài liệu
     */
    public function taiLieus()
    {
        return $this->hasMany(TaiLieu::class, 'danh_muc_id');
    }
}