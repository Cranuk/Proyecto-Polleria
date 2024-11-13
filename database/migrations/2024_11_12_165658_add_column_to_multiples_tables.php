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
        Schema::table('products', function (Blueprint $table) {
            $table->string('type_unit')->default('kg');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->string('type_unit')->default('kg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('type_unit');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('type_unit');
        });
    }
};
