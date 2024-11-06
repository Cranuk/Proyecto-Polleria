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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // NOTE: creacion de llave forranea
            $table->unsignedBigInteger('payment_id');
            $table->integer('amount');
            $table->float('price');
            $table->timestamps();

            $table->foreign('product_id') // NOTE: creacion en la asignacion de la llave forranea segun corresponda
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('payment_id')
                ->references('id')
                ->on('payment_method')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
