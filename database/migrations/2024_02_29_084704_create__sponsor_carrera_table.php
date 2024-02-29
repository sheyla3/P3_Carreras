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
        Schema::create('_sponsor_carrera', function (Blueprint $table) {
            $table->id('id_sponsorCarrera');
            $table->unsignedBigInteger('id_carrera');
            $table->foreign('id_carrera')->references('id_carrera')->on('carreras');
            $table->unsignedBigInteger('id_sponsor');
            $table->foreign('id_sponsor')->references('id_sponsor')->on('sponsor');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_sponsor_carrera');
    }
};
