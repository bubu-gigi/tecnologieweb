<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('erogazioni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medico_id')->references('id')->on('medici')->onDelete('cascade');
            $table->foreignId('prestazione_id')->references('id')->on('prestazioni')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: 'erogazioni');
    }
};
