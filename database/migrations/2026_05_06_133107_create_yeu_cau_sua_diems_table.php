<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('yeu_cau_sua_diem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bang_diem_id')->constrained('bang_diem')->cascadeOnDelete();
            $table->foreignId('giao_vien_id')->constrained('giao_vien')->cascadeOnDelete();
            $table->float('diem_cu');
            $table->float('diem_moi');
            $table->text('ly_do');
            // Trạng thái: 0: Chờ duyệt, 1: Đã duyệt, 2: Từ chối
            $table->tinyInteger('trang_thai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yeu_cau_sua_diems');
    }
};
