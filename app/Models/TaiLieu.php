<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiLieu extends Model
{
    use HasFactory;

    protected $table = 'tai_lieu';
    protected $fillable = [
        'tieu_de', 
        'mo_ta', 
        'duong_dan_file', 
        'danh_muc_id', 
        'mon_hoc_id', 
        'khoi_lop_id', 
        'giao_vien_id'
    ];

    /**
     * Tài liệu thuộc về một danh mục
     */
    public function danhMuc()
    {
        return $this->belongsTo(DanhMucTaiLieu::class, 'danh_muc_id');
    }

    /**
     * Tài liệu thuộc về một môn học
     */
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'mon_hoc_id');
    }

    /**
     * Tài liệu thuộc về một khối lớp
     */
    public function khoiLop()
    {
        return $this->belongsTo(KhoiLop::class, 'khoi_lop_id');
    }

    /**
     * Tài liệu do một giáo viên đăng
     */
    public function giaoVien()
    {
        return $this->belongsTo(GiaoVien::class, 'giao_vien_id');
    }

    /**
     * Lấy đường dẫn đầy đủ của file
     */
    public function getDuongDanDayDuAttribute()
    {
        return asset('storage/' . $this->duong_dan_file);
    }

    /**
     * Scope lấy tài liệu theo môn
     */
    public function scopeTheoMon($query, $monHocId)
    {
        return $query->where('mon_hoc_id', $monHocId);
    }

    /**
     * Scope lấy tài liệu theo khối
     */
    public function scopeTheoKhoi($query, $khoiLopId)
    {
        return $query->where('khoi_lop_id', $khoiLopId);
    }

    /**
     * Scope lấy tài liệu theo danh mục
     */
    public function scopeTheoDanhMuc($query, $danhMucId)
    {
        return $query->where('danh_muc_id', $danhMucId);
    }
}