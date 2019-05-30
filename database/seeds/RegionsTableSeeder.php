<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN I',
	        'sede' => 'TANTOYUCA',
            'coordinador' => 'PROFR. MANUEL DE LA CRUZ VICENTE',
            'email' => 'region_I@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-I', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN II',
	        'sede' => 'TUXPAN',
	        'coordinador' => 'PROFR. DEMETRIO ALEJANDRO HERNÁNDEZ',
            'email' => 'region_II@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-II', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN III',
	        'sede' => 'POZA RICA',
	        'coordinador' => 'PROFR. ELI CARLOS CASTILLO PÉREZ',
            'email' => 'region_III@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-III', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN IV',
	        'sede' => 'MARTÍNEZ DE LA TORRE',
	        'coordinador' => 'PROFR. LORENZO TUBALCAIN SANGABRIEL CUBAS',
            'email' => 'region_IV@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-IV', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN V',
	        'sede' => 'XALAPA',
	        'coordinador' => 'PROFR. DELFINO MARQUEZ SALINAS',
            'email' => 'region_V@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-V', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN VI',
	        'sede' => 'VERACRUZ',
	        'coordinador' => 'PROFR. JORGE TORRES VEGA',
            'email' => 'region_VI@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-VI', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN VII',
	        'sede' => 'CORDOBA',
	        'coordinador' => 'PROFR. JOSÉ LUIS SALAZAR CORTÉS',
            'email' => 'region_VII@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-VII', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN VIII',
	        'sede' => 'ORIZABA',
	        'coordinador' => 'PROFRA. SUSANA TATUN FLORES ALTAMIRANO',
            'email' => 'region_VIII@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-VIII', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN IX',
	        'sede' => 'COSAMALOAPAN',
	        'coordinador' => 'PROFR. ARTURO HERNÁNDEZ MARRON',
            'email' => 'region_IX@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-IX', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN X',
	        'sede' => 'SAN ANDRES TUXTLA',
	        'coordinador' => 'PROFRA. RUTH ABURTO MONTALVO',
            'email' => 'region_X@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-X', 
        ]);
        factory(App\Region::class)->create([
	        'nombre' => 'REGIÓN XI',
	        'sede' => 'MINATITLAN',
	        'coordinador' => 'PROFRA. PERLA MARIA SANTOS VARGAS',
            'email' => 'region_XI@example.com',
            'telefono' => '(228) 817 1570 Ext. 112',            
            'slug' => 'region-XI', 
        ]); 
    }
}
