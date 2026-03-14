<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Thêm vai trò (Roles)
        DB::table('vai_tro')->insert([
            ['id' => 1, 'ten_vai_tro' => 'Admin'],
            ['id' => 2, 'ten_vai_tro' => 'Giáo viên'],
            ['id' => 3, 'ten_vai_tro' => 'Học sinh'],
        ]);

        // 2. Thêm tài khoản Admin hệ thống (ID: 1)
        DB::table('tai_khoan')->insert([
            'id' => 1,
            'ten_dang_nhap' => 'admin',
            'mat_khau' => Hash::make('123456'),
            'vai_tro_id' => 1, // Vai trò Admin
            'trang_thai' => true,
            'created_at' => now(),
        ]);

        // 3. Thêm năm học
        DB::table('nam_hoc')->insert([
            ['id' => 1, 'ten_nam_hoc' => '2024-2025'],
            ['id' => 2, 'ten_nam_hoc' => '2025-2026'],
        ]);

        // 4. Thêm học kỳ
        DB::table('hoc_ky')->insert([
            ['ten_hoc_ky' => 'Học kỳ 1', 'nam_hoc_id' => 1],
            ['ten_hoc_ky' => 'Học kỳ 2', 'nam_hoc_id' => 1],
        ]);

        // 5. Thêm khối lớp
        DB::table('khoi_lop')->insert([
            ['id' => 1, 'ten_khoi' => 'Khối 10'],
            ['id' => 2, 'ten_khoi' => 'Khối 11'],
            ['id' => 3, 'ten_khoi' => 'Khối 12'],
        ]);

        // 6. Thêm môn học (BỔ SUNG ma_mon theo cấu trúc mới)
        DB::table('mon_hoc')->insert([
            ['ma_mon' => 'TOAN', 'ten_mon_hoc' => 'Toán'],
            ['ma_mon' => 'VAN', 'ten_mon_hoc' => 'Ngữ Văn'],
            ['ma_mon' => 'ANH', 'ten_mon_hoc' => 'Tiếng Anh'],
            ['ma_mon' => 'LY', 'ten_mon_hoc' => 'Vật Lý'],
            ['ma_mon' => 'HOA', 'ten_mon_hoc' => 'Hóa Học'],
            ['ma_mon' => 'SINH', 'ten_mon_hoc' => 'Sinh Học'],
        ]);

        // 7. Thêm loại điểm
        DB::table('loai_diem')->insert([
            ['ten_loai_diem' => 'Đánh giá thường xuyên 1', 'he_so' => 1],
            ['ten_loai_diem' => 'Đánh giá thường xuyên 2', 'he_so' => 1],
            ['ten_loai_diem' => 'Đánh giá giữa kỳ', 'he_so' => 2],
            ['ten_loai_diem' => 'Đánh giá cuối kỳ', 'he_so' => 3],
        ]);

        // 8. Thêm danh mục tài liệu
        DB::table('danh_muc_tai_lieu')->insert([
            ['ten_danh_muc' => 'Bài giảng'],
            ['ten_danh_muc' => 'Đề thi'],
            ['ten_danh_muc' => 'Bài tập'],
        ]);

        // 9. Dữ liệu mẫu cho Giáo viên (Dùng cho cấu trúc 3 tầng)
        // Tạo tài khoản cho giáo viên trước
        DB::table('tai_khoan')->insert([
            'id' => 2,
            'ten_dang_nhap' => 'gv001',
            'mat_khau' => Hash::make('123456'),
            'vai_tro_id' => 2, // Vai trò Giáo viên
            'trang_thai' => true,
        ]);
        // Liên kết với thông tin giáo viên
        DB::table('giao_vien')->insert([
            'tai_khoan_id' => 2,
            'ma_gv' => 'GV001', // Mã nghiệp vụ
            'ho_ten' => 'Nguyễn Văn Giáo Viên',
            'email' => 'gv@example.com',
            'so_dien_thoai' => '0987654321',
        ]);
        
        $this->command->info('Đã cập nhật Seeder theo cấu trúc mới thành công!');
    }
}