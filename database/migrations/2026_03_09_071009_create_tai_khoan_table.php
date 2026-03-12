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
            Schema::create('tai_khoan', function (Blueprint $table) {
                $table->id();
                $table->string('ten_dang_nhap')->unique();
                $table->string('mat_khau');
                $table->foreignId('vai_tro_id')->constrained('vai_tro');
                $table->boolean('trang_thai')->default(true);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_khoan');
    }
};
