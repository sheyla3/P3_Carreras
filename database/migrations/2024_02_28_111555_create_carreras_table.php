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
        Schema::create('carreras', function (Blueprint $table) {
            $table->id('id_carrera');
            $table->string('nombre');
            $table->string('descripcion')->max(1000);
            $table->enum('tipo', ['plano','vallas','campo a traves','trote y arnes','parejeras']);
            $table->string('lugar_foto');
            $table->integer('max_participantes')->default(10);
            $table->integer('aforo')->default(200);
            $table->integer('km');
            $table->dateTime('fechaHora');
            $table->string('cartel');
            $table->integer('precio');
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
        Schema::dropIfExists('carreras');
    }
};
