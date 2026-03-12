<?php

namespace App\Helpers;

use App\Models\NamHoc;
use App\Models\HocKy;

class AppHelper
{
    /**
     * Lấy năm học hiện tại
     */
    public static function getNamHocHienTai()
    {
        return session('nam_hoc_hien_tai', NamHoc::latest()->first()->id ?? 1);
    }

    /**
     * Lấy học kỳ hiện tại
     */
    public static function getHocKyHienTai()
    {
        return session('hoc_ky_hien_tai', HocKy::latest()->first()->id ?? 1);
    }

    /**
     * Format điểm số
     */
    public static function formatDiem($diem)
    {
        return number_format($diem, 1, ',', '.');
    }

    /**
     * Tính xếp loại dựa trên điểm trung bình
     */
    public static function xepLoai($diemTB)
    {
        if ($diemTB >= 9) return 'Xuất sắc';
        if ($diemTB >= 8) return 'Giỏi';
        if ($diemTB >= 6.5) return 'Khá';
        if ($diemTB >= 5) return 'Trung bình';
        if ($diemTB >= 3.5) return 'Yếu';
        return 'Kém';
    }
}