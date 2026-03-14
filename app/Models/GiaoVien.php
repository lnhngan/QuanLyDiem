<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaoVien extends Model
{
    use HasFactory;

    protected $table = 'giao_vien';
    protected $fillable = [
        'tai_khoan_id', 
        'ma_gv',
        'ho_ten', 
        'so_dien_thoai', 
        'email'
    ];

    /**
     * Giáo viên thuộc về một tài khoản
     */
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    /**
     * Một giáo viên có nhiều phân công giảng dạy
     */
    public function phanCongGiangDays()
    {
        return $this->hasMany(PhanCongGiangDay::class, 'giao_vien_id');
    }

    /**
     * Một giáo viên có thể là chủ nhiệm của nhiều lớp (qua các năm)
     */
    public function lopChuNhiems()
    {
        return $this->hasMany(LopHoc::class, 'gv_chu_nhiem_id');
    }

    /**
     * Một giáo viên nhập nhiều bảng điểm
     */
    public function bangDiems()
    {
        return $this->hasMany(BangDiem::class, 'giao_vien_id');
    }

    /**
     * Một giáo viên đăng nhiều tài liệu
     */
    public function taiLieus()
    {
        return $this->hasMany(TaiLieu::class, 'giao_vien_id');
    }

    /**
     * Lấy danh sách lớp dạy (thông qua phân công)
     */
    public function lopDays()
    {
        return $this->belongsToMany(LopHoc::class, 'phan_cong_giang_day', 'giao_vien_id', 'lop_id')
                    ->withPivot('mon_hoc_id', 'hoc_ky_id')
                    ->withTimestamps();
    }

    /**
     * Lấy danh sách môn dạy
     */
    public function monDays()
    {
        return $this->belongsToMany(MonHoc::class, 'phan_cong_giang_day', 'giao_vien_id', 'mon_hoc_id')
                    ->withPivot('lop_id', 'hoc_ky_id')
                    ->withTimestamps();
    }

    /**
     * Lấy lớp chủ nhiệm hiện tại
     */
    public function lopChuNhiemHienTai()
    {
        return $this->hasOne(LopHoc::class, 'gv_chu_nhiem_id')
                    ->where('nam_hoc_id', session('nam_hoc_hien_tai', 1));
    }
}