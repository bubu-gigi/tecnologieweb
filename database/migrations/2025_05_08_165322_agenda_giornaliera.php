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
            $table->date('data');
            $table->time('orario');
            $table->boolean('disponibile')->default(true);
            $table->foreignId('prenotazione_id')->nullable()->constrained('prenotazioni')->nullOnDelete();
            $table->timestamps();

            $table->unique(['prestazione_id', 'data', 'orario']);
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
