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
    Schema::create('hoc_sinh', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tai_khoan_id')->constrained('tai_khoan');
        $table->string('ma_hoc_sinh')->unique();
        $table->string('ho_ten');
        $table->date('ngay_sinh');
        $table->foreignId('lop_id')->constrained('lop_hoc');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoc_sinh');
    }
};
