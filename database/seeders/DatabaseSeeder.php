<?php

namespace Database\Seeders;

use App\Models\User;
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
        // 1. Thêm vai trò
        DB::table('vai_tro')->insert([
            ['ten_vai_tro' => 'Admin'],
            ['ten_vai_tro' => 'Giáo viên'],
            ['ten_vai_tro' => 'Học sinh'],
        ]);

        // 2. Thêm tài khoản admin hệ thống
        DB::table('tai_khoan')->insert([
            'ten_dang_nhap' => 'admin',
            'mat_khau' => Hash::make('123456'),
            'vai_tro_id' => 1,
            'trang_thai' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Thêm năm học
        DB::table('nam_hoc')->insert([
            ['ten_nam_hoc' => '2024-2025'],
            ['ten_nam_hoc' => '2025-2026'],
        ]);

        // 4. Thêm học kỳ
        DB::table('hoc_ky')->insert([
            ['ten_hoc_ky' => 'Học kỳ 1', 'nam_hoc_id' => 1],
            ['ten_hoc_ky' => 'Học kỳ 2', 'nam_hoc_id' => 1],
        ]);

        // 5. Thêm khối lớp
        DB::table('khoi_lop')->insert([
            ['ten_khoi' => 'Khối 10'],
            ['ten_khoi' => 'Khối 11'],
            ['ten_khoi' => 'Khối 12'],
        ]);

        // 6. Thêm môn học
        DB::table('mon_hoc')->insert([
            ['ten_mon_hoc' => 'Toán'],
            ['ten_mon_hoc' => 'Ngữ Văn'],
            ['ten_mon_hoc' => 'Tiếng Anh'],
            ['ten_mon_hoc' => 'Vật Lý'],
            ['ten_mon_hoc' => 'Hóa Học'],
            ['ten_mon_hoc' => 'Sinh Học'],
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
        

        User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);
    }
}