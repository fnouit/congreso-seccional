<?php

use Illuminate\Database\Seeder;

class SituacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Situacion::class)->create([
            'estado_civil' => 'SOLTERO/A',
            'slug' => 'soltero'            
        ]);
        factory(App\Situacion::class)->create([
            'estado_civil' => 'CASADO/A',            
            'slug' => 'casado'            
        ]);
        factory(App\Situacion::class)->create([
            'estado_civil' => 'DIVORCIADO/A',            
            'slug' => 'divorciado'            
        ]);
        factory(App\Situacion::class)->create([
            'estado_civil' => 'VIUDO/A',            
            'slug' => 'viudo'            
        ]);
        factory(App\Situacion::class)->create([
            'estado_civil' => 'UNIÓN LIBRE',            
            'slug' => 'libre'            
        ]);  
    }
}
