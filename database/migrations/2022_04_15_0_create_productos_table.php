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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_producto');
            $table->string('descripcion_producto');
            $table->bigInteger('precio_producto');
            $table->string('estado_Producto')->default('Activo');
            $table->string('tipo_producto')->default('casa');
            $table->string('material_producto')->default('Plaqueta');
            $table->string('pisos_producto')->default('1 piso');
            $table->string('foto_producto')->default('No existe archivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
