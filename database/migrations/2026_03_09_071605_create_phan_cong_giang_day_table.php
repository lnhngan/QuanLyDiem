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
        Schema::create('phan_cong_giang_day', function (Blueprint $table) {
            $table->id();
            $table->foreignId('giao_vien_id')->constrained('giao_vien');
            $table->foreignId('mon_hoc_id')->constrained('mon_hoc');
            $table->foreignId('lop_id')->constrained('lop_hoc');
            $table->foreignId('hoc_ky_id')->constrained('hoc_ky');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phan_cong_giang_day');
    }
};
