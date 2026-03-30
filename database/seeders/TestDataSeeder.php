<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN'); // Dùng tên tiếng Việt
        $now = Carbon::now();

        // 0. TẠO VAI TRÒ (Bắt buộc phải có trước để gán cho tài khoản)
        DB::table('vai_tro')->insertOrIgnore([
            ['id' => 1, 'ten_vai_tro' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'ten_vai_tro' => 'Giáo viên', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'ten_vai_tro' => 'Học sinh', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 0.1 TẠO TÀI KHOẢN ADMIN (Để bạn đăng nhập quản trị)
        DB::table('tai_khoan')->insertOrIgnore([
            'id' => 1,
            'ten_dang_nhap' => 'admin',
            'mat_khau' => Hash::make('123456'), // Mật khẩu: 123456
            'vai_tro_id' => 1,
            'created_at' => $now, 'updated_at' => $now
        ]);

        // 0.2 TẠO NĂM HỌC VÀ HỌC KỲ (Dữ liệu nền tảng)
        $namHocId = DB::table('nam_hoc')->insertGetId(['ten_nam_hoc' => '2025-2026', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('hoc_ky')->insert([
            ['ten_hoc_ky' => 'Học kỳ 1', 'nam_hoc_id' => $namHocId, 'created_at' => $now, 'updated_at' => $now],
            ['ten_hoc_ky' => 'Học kỳ 2', 'nam_hoc_id' => $namHocId, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 1. TẠO LOẠI ĐIỂM
        $loaiDiems = [
            ['ten_loai_diem' => 'Thường xuyên 1', 'he_so' => 1],
            ['ten_loai_diem' => 'Thường xuyên 2', 'he_so' => 1],
            ['ten_loai_diem' => 'Giữa kỳ', 'he_so' => 2],
            ['ten_loai_diem' => 'Cuối kỳ', 'he_so' => 3],
        ];
        foreach ($loaiDiems as $ld) {
            DB::table('loai_diem')->insertOrIgnore(array_merge($ld, ['created_at' => $now, 'updated_at' => $now]));
        }

        // 2. TẠO 3 KHỐI LỚP (10, 11, 12)
        $khoiIds = [];
        foreach (['Khối 10', 'Khối 11', 'Khối 12'] as $tenKhoi) {
            $khoiIds[] = DB::table('khoi_lop')->insertGetId(['ten_khoi' => $tenKhoi, 'created_at' => $now, 'updated_at' => $now]);
        }

        // 3. TẠO 30 GIÁO VIÊN
        $giaoVienIds = [];
        for ($i = 1; $i <= 30; $i++) {
            $maGV = 'GV' . str_pad($i, 3, '0', STR_PAD_LEFT); 
            
            $tkId = DB::table('tai_khoan')->insertGetId([
                'ten_dang_nhap' => $maGV,
                'mat_khau' => Hash::make('123456'), 
                'vai_tro_id' => 2, 
                'created_at' => $now, 'updated_at' => $now
            ]);

            $giaoVienIds[] = DB::table('giao_vien')->insertGetId([
                'ma_gv' => $maGV,
                'ho_ten' => $faker->name,
                'so_dien_thoai' => $faker->phoneNumber,
                'tai_khoan_id' => $tkId,
                'created_at' => $now, 'updated_at' => $now
            ]);
        }

        // 4. TẠO 27 LỚP HỌC VÀ PHÂN GVCN
        $lopIds = [];
        $gvIndex = 0; 
        foreach ($khoiIds as $index => $khoiId) {
            $tenKhoiPrefix = 10 + $index; 
            for ($i = 1; $i <= 9; $i++) {
                $lopIds[] = DB::table('lop_hoc')->insertGetId([
                    'ten_lop' => $tenKhoiPrefix . 'A' . $i, 
                    'khoi_lop_id' => $khoiId,
                    'gv_chu_nhiem_id' => $giaoVienIds[$gvIndex], 
                    'nam_hoc_id' => $namHocId, // <-- DÒNG BỔ SUNG LÀ Ở ĐÂY
                    'created_at' => $now, 'updated_at' => $now
                ]);
                $gvIndex++;
            }
        }

        // 5. TẠO 200 HỌC SINH
        for ($i = 1; $i <= 200; $i++) {
            $maHS = 'HS' . str_pad($i, 4, '0', STR_PAD_LEFT); 
            
            $tkId = DB::table('tai_khoan')->insertGetId([
                'ten_dang_nhap' => $maHS,
                'mat_khau' => Hash::make('123456'), 
                'vai_tro_id' => 3, 
                'created_at' => $now, 'updated_at' => $now
            ]);

            DB::table('hoc_sinh')->insert([
                // LƯU Ý: Nếu DB của bạn tên cột là ma_hs thì giữ nguyên, nếu là ma_hoc_sinh thì sửa lại nhé.
                'ma_hoc_sinh' => $maHS,
                'ho_ten' => $faker->name,
                'ngay_sinh' => $faker->dateTimeBetween('-18 years', '-15 years')->format('Y-m-d'),
                'gioi_tinh' => $faker->randomElement([1, 0]), 
                'dia_chi' => $faker->address,
                'lop_id' => $faker->randomElement($lopIds), 
                'tai_khoan_id' => $tkId,
                'created_at' => $now, 'updated_at' => $now
            ]);
        }

        $this->command->info('Tuyệt vời! Đã khôi phục Role, Admin và tạo thành công 200 Học sinh!');
    }
}