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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id('id_participante');
            $table->foreign('id_carrera')->references('id_carrera')->on('carreras');
            $table->foreign('id_jinete')->references('id_jinete')->on('jinetes');
            $table->integer('num_partcipante');
            $table->string('dorsal');
            $table->string('qr');
            $table->time('tiempo');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
