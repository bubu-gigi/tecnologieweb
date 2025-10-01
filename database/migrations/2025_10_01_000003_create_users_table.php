<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->date('data_nascita')->nullable();
            $table->string('specializzazione')->nullable();
            $table->foreignId('centro_assistenza_id')->nullable()->constrained('centri_assistenza')->onDelete('set null');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('ruolo', ['tecnico_assistenza', 'tecnico_azienda', 'amministratore']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
