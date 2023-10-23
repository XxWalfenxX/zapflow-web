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
        Schema::create('cargar', function (Blueprint $table) {
            $table->foreignId('id_user');
            $table->foreignId('id_punto_carga');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_punto_carga')->references('id')->on('puntos_carga')->onDelete('cascade');
            $table->primary(['id_user', 'id_punto_carga']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargar');
    }
};
