<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('phan_cong_giang_day', function (Blueprint $table) {
            $table->id();
            $table->foreignId('giao_vien_id')->constrained('giao_vien')->onDelete('cascade');
            $table->foreignId('mon_hoc_id')->constrained('mon_hoc')->onDelete('cascade');
            $table->foreignId('lop_id')->constrained('lop_hoc')->onDelete('cascade');
            $table->foreignId('hoc_ky_id')->constrained('hoc_ky')->onDelete('cascade');
            $table->timestamps();

            // Ràng buộc duy nhất: 1 môn của 1 lớp trong 1 học kỳ chỉ có 1 phân công
            $table->unique(['mon_hoc_id', 'lop_id', 'hoc_ky_id'], 'unique_phan_cong');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phan_cong_giang_day');
    }
};