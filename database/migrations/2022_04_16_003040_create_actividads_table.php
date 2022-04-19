<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividads', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('etapa_id')->unsigned();
            $table->bigInteger('encargado_id')->unsigned();

            $table->string('nombre_actividad');
            $table->string('objetivo_actividad');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('observaciones_actividad')->nullable();
            $table->string('estado_actividad');

            $table->timestamps();

            $table->foreign('etapa_id')->references('id')->on('etapas');
            $table->foreign('encargado_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividads');
    }
};
