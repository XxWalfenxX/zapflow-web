<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tener', function (Blueprint $table) {
            $table->foreignId('id_user');
            $table->foreignId('id_subscripciones');
            $table->date('fecha_inicio')->default(DB::raw('curdate()'));
            $table->date('fecha_fin')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_subscripciones')->references('id')->on('suscripciones')->onDelete('cascade');
            $table->primary(['id_user', 'id_subscripciones']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tener');
    }
};
