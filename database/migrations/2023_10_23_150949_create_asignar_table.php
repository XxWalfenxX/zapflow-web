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
        Schema::create('asignar', function (Blueprint $table) {
            $table->foreignId('id_user');
            $table->foreignId('id_roles');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_roles')->references('id')->on('roles')->onDelete('cascade');
            $table->primary(['id_user', 'id_roles']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignar');
    }
};
