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
        Schema::create('bang_diem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoc_sinh_id')->constrained('hoc_sinh');
            $table->foreignId('mon_hoc_id')->constrained('mon_hoc');
            $table->foreignId('hoc_ky_id')->constrained('hoc_ky');
            $table->foreignId('loai_diem_id')->constrained('loai_diem');
            $table->float('diem_so');
            $table->foreignId('giao_vien_id')->constrained('giao_vien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bang_diem');
    }
};
