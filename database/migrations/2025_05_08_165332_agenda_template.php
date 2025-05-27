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
            $table->unsignedTinyInteger('giorno');
            $table->string('fascia_oraria');
            $table->timestamps();
            $table->unique(['prestazione_id', 'giorno', 'fascia_oraria'], 'agenda_template_unique');
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
