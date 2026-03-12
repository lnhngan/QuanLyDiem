<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tai_khoan'; // QUAN TRỌNG: chỉ định tên bảng

    protected $fillable = [
        'ten_dang_nhap',
        'mat_khau',
        'vai_tro_id',
        'trang_thai'
    ];

    protected $hidden = [
        'mat_khau',
    ];

    // QUAN TRỌNG: chỉ định tên cột mật khẩu
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    // QUAN TRỌNG: chỉ định tên cột đăng nhập
    public function username()
    {
        return 'ten_dang_nhap';
    }

    // Relationships
    public function vaiTro()
    {
        return $this->belongsTo(VaiTro::class, 'vai_tro_id');
    }

    public function giaoVien()
    {
        return $this->hasOne(GiaoVien::class, 'tai_khoan_id');
    }

    public function hocSinh()
    {
        return $this->hasOne(HocSinh::class, 'tai_khoan_id');
    }

    // Kiểm tra quyền
    public function isAdmin()
    {
        return $this->vaiTro && $this->vaiTro->ten_vai_tro === 'Admin';
    }

    public function isGiaoVien()
    {
        return $this->vaiTro && $this->vaiTro->ten_vai_tro === 'Giáo viên';
    }

    public function isHocSinh()
    {
        return $this->vaiTro && $this->vaiTro->ten_vai_tro === 'Học sinh';
    }
}