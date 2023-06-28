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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->char('operacion', 1);
            $table->string('concepto', 200);
            $table->decimal('puntos', 5, 0);
            $table->decimal('saldomov', 5, 0);
            $table->char('tarjeta', 16);
            $table->char('localizador', 8)->nullable();
            $table->char('comercio', 80)->nullable();
            $table->text('comentarios')->nullable();
            $table->timestamps(); // created_at, updated_at - crea las dos columnas

            $table->unsignedBigInteger('cuenta_id'); // 

            $table->foreign('cuenta_id')->references('id')->on('cuentas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
