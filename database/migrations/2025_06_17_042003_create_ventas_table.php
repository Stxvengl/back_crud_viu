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
        Schema::create('ventas', function (Blueprint $table) {
          $table->bigIncrements('id_ventas');
            $table->integer('id_articulo');
            $table->decimal('valor_venta', 10, 2);
            $table->enum('estado', ['A', 'E', 'I'])->default('A');
            $table->string('ip');
            $table->string('terminal', 31);
            $table->integer('id_usuario_auditor')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable()->useCurrentOnUpdate();
            $table->foreign('id_localidad')->references('id_localidad')->on('localidad')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
