<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hoc_sinh', function (Blueprint $table) {
            // Thêm cột sdt_phu_huynh, cho phép null, đặt sau cột dia_chi
            $table->string('sdt_phu_huynh', 20)->nullable()->after('dia_chi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoc_sinh', function (Blueprint $table) {
            $table->dropColumn('sdt_phu_huynh');
        });
    }
};