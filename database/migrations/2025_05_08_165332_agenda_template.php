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
        Schema::create('agenda_template', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestazione_id')->constrained('prestazioni');
            $table->unsignedTinyInteger('giorno_settimana'); // 1 = lunedì, 6 = sabato
            $table->time('orario_inizio');
            $table->unsignedInteger('numero_slot');
            $table->timestamps();

            $table->unique(['prestazione_id', 'giorno_settimana', 'orario_inizio'], 'agenda_template_unique');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_template');
    }
};
