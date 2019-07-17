<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Rol::class)->create([
	        'nombre' => 'Administrador',
	        'descripcion' => 'Administradores de Sistema',
        ]);
        factory(App\Rol::class)->create([
	        'nombre' => 'Visualizador',
	        'descripcion' => 'Visualizara solamente la información sin poder editarla',
        ]);
        factory(App\Rol::class)->create([
	        'nombre' => 'Capturador',
	        'descripcion' => 'Captura la información de los delegados electos en las asambleas',
        ]);
    }
}
