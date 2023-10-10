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
        Schema::create('puntos_carga', function (Blueprint $table) {
            $table->id();
            $table->double('latitud')->default(0);
            $table->double('longitud')->default(0);
            $table->string('ubicacion', 255);
            $table->double('potencia');
            $table->boolean('funciona');
            $table->date('ultimo_mantenimiento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntos_carga');
    }
};
