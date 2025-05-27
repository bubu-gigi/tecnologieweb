<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('agenda_giornaliera', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestazione_id')->constrained('prestazioni');
            $table->foreignId(column: 'prenotazione_id')->constrained('prenotazioni');
            $table->date('data');
            $table->string('orario');
            $table->unique(['prestazione_id', 'data', 'orario'], 'agenda_giornaliera_unique');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_giornaliera');
    }
};
