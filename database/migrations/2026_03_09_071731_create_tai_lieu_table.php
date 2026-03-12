<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tai_lieu', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->text('mo_ta')->nullable();
            $table->string('duong_dan_file');
            $table->foreignId('danh_muc_id')->constrained('danh_muc_tai_lieu');
            $table->foreignId('mon_hoc_id')->constrained('mon_hoc');
            $table->foreignId('khoi_lop_id')->constrained('khoi_lop');
            $table->foreignId('giao_vien_id')->constrained('giao_vien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_lieu');
    }
};
