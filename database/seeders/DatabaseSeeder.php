<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Producto::factory(10)->create();
        \App\Models\Privilegio::factory(3)->create();
        \App\Models\Rol::factory(3)->create();
        \App\Models\RolPrivilegio::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Etapa::factory(6)->create();
        \App\Models\Actividad::factory(10)->create();
        \App\Models\Proyecto::factory(10)->create();
        \App\Models\ProyectoEtapa::factory(10)->create();
        \App\Models\Cotizacion::factory(10)->create();

        \App\Models\Evento::factory(10)->create();
    }
}
