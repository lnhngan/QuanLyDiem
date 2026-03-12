<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    use HasFactory;

    protected $table = 'vai_tro';
    protected $fillable = ['ten_vai_tro'];

    /**
     * Một vai trò có nhiều tài khoản
     */
    public function taiKhoans()
    {
        return $this->hasMany(TaiKhoan::class, 'vai_tro_id');
    }
}