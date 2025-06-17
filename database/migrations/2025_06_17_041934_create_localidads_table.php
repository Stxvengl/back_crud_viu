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
        Schema::create('localidad', function (Blueprint $table) {
        $table->bigIncrements('id_localidad');
            $table->string('descripcion');
            $table->enum('estado', ['A', 'E', 'I'])->default('A');
            $table->string('ip');
            $table->string('terminal', 31);
            $table->unsignedBigInteger('id_usuario_auditor')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable()->useCurrentOnUpdate();
            $table->foreign('id_usuario_auditor')->references('id')->on('usuario')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localidad');
    }
};
