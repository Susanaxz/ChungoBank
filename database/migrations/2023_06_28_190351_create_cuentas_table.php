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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->char('entidad', 4);
            $table->char('oficina', 4);
            $table->char('dc', 2);
            $table->char('cuenta', 10);
            $table->char('programa', 3);
            $table->tinyInteger('extracto');
            $table->tinyInteger('renuncia');
            $table->decimal('saldo', 5, 0);
            $table->date('fechaextracto')->nullable();
            $table->timestamps(); // created_at, updated_at

            $table->unsignedBigInteger('persona_id'); //  

            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas');
    }
};
