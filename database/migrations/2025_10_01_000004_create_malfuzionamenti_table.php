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
        Schema::create('malfunzionamenti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodotto_id')->constrained('centri_assistenza')->onDelete('set null');
            $table->string('descrizione'); 
            $table->text('soluzione'); 
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('malfunzionamenti');
    }
};
