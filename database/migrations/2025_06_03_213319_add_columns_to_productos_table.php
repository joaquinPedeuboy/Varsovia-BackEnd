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
        Schema::table('productos', function (Blueprint $table) {
            $table->string('titulo');
            $table->string('codigo_barras')->nullable()->unique();
            $table->double('precio');
            $table->string('marca');
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('stock');
            $table->text('descripcion');
            $table->boolean('disponible')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign('productos_categoria_id_foreign');
            $table->dropColumn(['titulo','codigo_barras','precio','marca','categoria_id','stock','descripcion','disponible']);
        });
    }
};
