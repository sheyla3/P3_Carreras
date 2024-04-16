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
        Schema::create('jinetes', function (Blueprint $table) {
            $table->id('id_jinete');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->unique();
            $table->string('contrasena');
            $table->string('foto');
            $table->integer('telf');
            $table->string('calle');
            $table->string('num_federat')->unique();
            $table->date('edad');
            $table->integer('dorsal');
            $table->boolean('activo')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jinetes');
    }
};
