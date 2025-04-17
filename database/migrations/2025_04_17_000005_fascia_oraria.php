<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fascie_orarie', function (Blueprint $table) {
            $table->id();
            $table->string('inizio');
            $table->string('fine');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: 'fascie_orarie');
    }
};
