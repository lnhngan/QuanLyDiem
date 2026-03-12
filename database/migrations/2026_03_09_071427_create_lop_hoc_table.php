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
        Schema::create('lop_hoc', function (Blueprint $table) {
            $table->id();
            $table->string('ten_lop');
            $table->foreignId('khoi_lop_id')->constrained('khoi_lop');
            $table->foreignId('nam_hoc_id')->constrained('nam_hoc');
            $table->foreignId('gv_chu_nhiem_id')->nullable()->constrained('giao_vien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lop_hoc');
    }
};
