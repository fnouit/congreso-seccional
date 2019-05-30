<?php

use Illuminate\Database\Seeder;

class EstudiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Estudio::class)->create([
            'maximo_estudio' => 'PRIMARIA',
            'slug' => 'primaria'
        ]);
        factory(App\Estudio::class)->create([
	        'maximo_estudio' => 'SECUNDARIA',
            'slug' => 'secundaria'
        ]);
        factory(App\Estudio::class)->create([
            'maximo_estudio' => 'BACHILLERATO',
            'slug' => 'bachillerato'
        ]);
        factory(App\Estudio::class)->create([
            'maximo_estudio' => 'LICENCIATURA',
            'slug' => 'licenciatura'
        ]);
        factory(App\Estudio::class)->create([
	        'maximo_estudio' => 'MAESTRÍA',
            'slug' => 'maestria'
        ]);
        factory(App\Estudio::class)->create([
            'maximo_estudio' => 'DOCTORADO',
            'slug' => 'doctorado'
        ]); 
    }
}
