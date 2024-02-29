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
        Schema::create('caballo', function (Blueprint $table) {
            $table->id('id_caballo');
            $table->unsignedBigInteger('id_jinete');
            $table->foreign('id_jinete')->references('id_jinete')->on('jinetes');
            $table->string('nombre');
            $table->enum('raza', ['Pura Sangre Inglés','Hannoveriano','Holsteiner','Mustang']);
            $table->enum('color', ['negro','blanco','gris','rubio']);
            $table->date('edad');
            $table->date('años_participando');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caballo');
    }
};
