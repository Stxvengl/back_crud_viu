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
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id_cliente');
            $table->string('nombres');
            $table->string('apellido');
            $table->string('cedula');
            $table->string('correo');
            $table->string('numero_personal');
            $table->string('estado')->default('A');
            $table->ipAddress('ip');
            $table->string('terminal',31);
            $table->integer('id_usuario_auditor');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_actualizacion')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
