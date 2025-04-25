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
        Schema::create('producto_sexo', function (Blueprint $table) {
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->foreignId('sexo_id')->constrained()->onDelete('cascade');
            $table->primary(['producto_id', 'sexo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_sexo');
    }
};
