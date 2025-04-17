<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agende', function (Blueprint $table) {
            $table->id();
            $table->foreignId('giorno_id')->references('id')->on('giorni')->onDelete('cascade');
            $table->foreignId('fascia_id')->references('id')->on('fascie_orarie')->onDelete('cascade');
            $table->unsignedInteger('max_prenotazioni')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: 'agende');
    }
};
