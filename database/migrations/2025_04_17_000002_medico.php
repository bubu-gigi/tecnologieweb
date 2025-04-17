<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medici', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->integer('eta')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->unique();
            $table->string('specializzazione')->nullable();
            $table->foreignId('dipartimento_id')->references('id')->on('dipartimenti')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: 'medici');
    }
};
