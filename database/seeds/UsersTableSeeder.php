<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*         User::create([
            'name' => 'Vicente Juarez',
            'email' => 'root@intranet.snte56',
            'password' => bcrypt('123456'),
            'admin' => true
        ]); */
        factory(App\User::class)->create([
            'name' => 'Vicente Juarez',
            'email' => 'root@snte56',
            'password' => bcrypt('123456'),
            'admin' => true,
            'slug' => 'vicente_juarez_alarcon'         
        ]);

        factory(App\User::class)->create([ 'name' => 'Mario Hernández Sánchez', 'email' => 'mario_hernandez@snte56', 'password' => bcrypt('261095'), 'admin' =>false,'slug' => 'mario_hernandez']);
        factory(App\User::class)->create([ 'name' => 'Manuel De La Cruz Vicente', 'email' => 'manuel_de_la_cruz@snte56', 'password' => bcrypt('335715'), 'admin' =>false,'slug' => 'manuel_de_la_cruz']);
        factory(App\User::class)->create([ 'name' => 'Demetrio Alejandro Hernández', 'email' => 'demetrio_alejandro@snte56', 'password' => bcrypt('228497'), 'admin' =>false,'slug' => 'demetrio_alejandro']);
        factory(App\User::class)->create([ 'name' => 'Eli Carlos Castillo López', 'email' => 'eli_carlos_castillo@snte56', 'password' => bcrypt('327678'), 'admin' =>false,'slug' => 'eli_carlos_castillo']);
        factory(App\User::class)->create([ 'name' => 'Lorenzo Tubalcain Sangabriel Cubas', 'email' => 'lorenzo_tubalcain@snte56', 'password' => bcrypt('475674'), 'admin' =>false,'slug' => 'lorenzo_tubalcain']);
        factory(App\User::class)->create([ 'name' => 'Delfino Márquez Salinas', 'email' => 'delfino_marquez@snte56', 'password' => bcrypt('289768'), 'admin' =>false,'slug' => 'delfino_marquez']);
        factory(App\User::class)->create([ 'name' => 'José Luis Salazar Cortés', 'email' => 'jose_luis_salazar@snte56', 'password' => bcrypt('472319'), 'admin' =>false,'slug' => 'jose_luis_salazar']);
        factory(App\User::class)->create([ 'name' => 'Susana Tatún Flores Altamirano', 'email' => 'susana_tatun_flores@snte56', 'password' => bcrypt('248321'), 'admin' =>false,'slug' => 'susana_tatun_flores']);
        factory(App\User::class)->create([ 'name' => 'Ruth Aburto Montalvo', 'email' => 'ruth_aburto@snte56', 'password' => bcrypt('364135'), 'admin' =>false,'slug' => 'ruth_aburto']);
        factory(App\User::class)->create([ 'name' => 'Perla María Santos Vargas', 'email' => 'perla_maria_santos@snte56', 'password' => bcrypt('332533'), 'admin' =>false,'slug' => 'perla_maria_santos']);
        factory(App\User::class)->create([ 'name' => 'Juan Carlos León Bonilla', 'email' => 'juan_carlos_leon@snte56', 'password' => bcrypt('208776'), 'admin' =>false,'slug' => 'juan_carlos_leon']);
        factory(App\User::class)->create([ 'name' => 'Francisco Cilias Susunaga', 'email' => 'francisco_cilias@snte56', 'password' => bcrypt('219369'), 'admin' =>false,'slug' => 'francisco_cilias']);
        factory(App\User::class)->create([ 'name' => 'María Elizabeth Texco Sosa', 'email' => 'maria_elizabeth_texco@snte56', 'password' => bcrypt('321196'), 'admin' =>false,'slug' => 'maria_elizabeth_texco']);
        factory(App\User::class)->create([ 'name' => 'Javier Aparicio Martínez', 'email' => 'javier_aparicio@snte56', 'password' => bcrypt('240404'), 'admin' =>false,'slug' => 'javier_aparicio']);
        factory(App\User::class)->create([ 'name' => 'Nadia Benavides Herrera', 'email' => 'nadia_benavides@snte56', 'password' => bcrypt('455416'), 'admin' =>false,'slug' => 'nadia_benavides']);
        factory(App\User::class)->create([ 'name' => 'Efraín Fernández Hernández', 'email' => 'efrain_fernandez@snte56', 'password' => bcrypt('232397'), 'admin' =>false,'slug' => 'efrain_fernandez']);
        factory(App\User::class)->create([ 'name' => 'Becker Martínez Santos', 'email' => 'becker_martinez@snte56', 'password' => bcrypt('344919'), 'admin' =>false,'slug' => 'becker_martinez']);
        factory(App\User::class)->create([ 'name' => 'Luis Alejandro Rodríguez Ramírez', 'email' => 'luis_alejandro_rodriguez@snte56', 'password' => bcrypt('262744'), 'admin' =>false,'slug' => 'luis_alejandro_rodriguez']);
        factory(App\User::class)->create([ 'name' => 'Iván López Hernández', 'email' => 'ivan_lopez@snte56', 'password' => bcrypt('354639'), 'admin' =>false,'slug' => 'ivan_lopez']);
        factory(App\User::class)->create([ 'name' => 'José Reveriano Marín Hernández', 'email' => 'jose_reveriano_marin@snte56', 'password' => bcrypt('470926'), 'admin' =>false,'slug' => 'jose_reveriano_marin']);
        factory(App\User::class)->create([ 'name' => 'María Del Rosario Flores', 'email' => 'maria_del_rosario@snte56', 'password' => bcrypt('489946'), 'admin' =>false,'slug' => 'maria_del_rosario']);
        factory(App\User::class)->create([ 'name' => 'Juan Martínez Acosta', 'email' => 'juan_martinez@snte56', 'password' => bcrypt('329481'), 'admin' =>false,'slug' => 'juan_martinez']);
        factory(App\User::class)->create([ 'name' => 'Jorge Torres Vega', 'email' => 'jorge_torres@snte56', 'password' => bcrypt('298286'), 'admin' =>false,'slug' => 'jorge_torres']);
        factory(App\User::class)->create([ 'name' => 'Cirila Viveros Rosado', 'email' => 'cirila_viveros@snte56', 'password' => bcrypt('425856'), 'admin' =>false,'slug' => 'cirila_viveros']);
        factory(App\User::class)->create([ 'name' => 'Francisco Arias Jiménez', 'email' => 'francisco_arias@snte56', 'password' => bcrypt('327259'), 'admin' =>false,'slug' => 'francisco_arias']);
        factory(App\User::class)->create([ 'name' => 'Leonardo Campos Aparicio', 'email' => 'leonardo_campos@snte56', 'password' => bcrypt('308198'), 'admin' =>false,'slug' => 'leonardo_campos']);
        factory(App\User::class)->create([ 'name' => 'Enrique Milton Swartwood Gutiérrez', 'email' => 'enrique_milton@snte56', 'password' => bcrypt('378822'), 'admin' =>false,'slug' => 'enrique_milton']);
        factory(App\User::class)->create([ 'name' => 'Irving Aguirre Landa', 'email' => 'irving_aguirre@snte56', 'password' => bcrypt('214184'), 'admin' =>false,'slug' => 'irving_aguirre']);
        factory(App\User::class)->create([ 'name' => 'Néstor Gilberto Ramos Domínguez', 'email' => 'nestor_gilberto_ramos@snte56', 'password' => bcrypt('368489'), 'admin' =>false,'slug' => 'nestor_gilberto_ramos']);
        factory(App\User::class)->create([ 'name' => 'Evencio Castillo Hernández', 'email' => 'evencio_castillo@snte56', 'password' => bcrypt('363866'), 'admin' =>false,'slug' => 'evencio_castillo']);
        factory(App\User::class)->create([ 'name' => 'Fernando Nery Contreras', 'email' => 'fernando_nery@snte56', 'password' => bcrypt('326270'), 'admin' =>false,'slug' => 'fernando_nery']);
        factory(App\User::class)->create([ 'name' => 'Abel Mendoza Condado', 'email' => 'abel_mendoza@snte56', 'password' => bcrypt('456774'), 'admin' =>false,'slug' => 'abel_mendoza']);
        factory(App\User::class)->create([ 'name' => 'Israel Landa Ortiz', 'email' => 'israel_landa@snte56', 'password' => bcrypt('350253'), 'admin' =>false,'slug' => 'israel_landa']);
        factory(App\User::class)->create([ 'name' => 'Miriam De Los Ángeles García Morteo', 'email' => 'miriam_garcia@snte56', 'password' => bcrypt('473276'), 'admin' =>false,'slug' => 'miriam_garcia']);
        factory(App\User::class)->create([ 'name' => 'Arturo Hernández Marrón', 'email' => 'arturo_hernandez@snte56', 'password' => bcrypt('280778'), 'admin' =>false,'slug' => 'arturo_hernandez']);
        factory(App\User::class)->create([ 'name' => 'Pedro Cruz Peralta', 'email' => 'pedro_cruz@snte56', 'password' => bcrypt('221494'), 'admin' =>false,'slug' => 'pedro_cruz']);
        factory(App\User::class)->create([ 'name' => 'Eraclio De La Cruz Vicente', 'email' => 'eraclio_de_la_cruz@snte56', 'password' => bcrypt('352207'), 'admin' =>false,'slug' => 'eraclio_de_la_cruz']);
        factory(App\User::class)->create([ 'name' => 'Adán Zarate Rivera', 'email' => 'adan_zarate@snte56', 'password' => bcrypt('215368'), 'admin' =>false,'slug' => 'adan_zarate']);
        factory(App\User::class)->create([ 'name' => 'Adriana Hernández Mateos', 'email' => 'adriana_hernandez@snte56', 'password' => bcrypt('363967'), 'admin' =>false,'slug' => 'adriana_hernandez']);
        factory(App\User::class)->create([ 'name' => 'Alejandro Montiel Galicia', 'email' => 'alejandro_montiel@snte56', 'password' => bcrypt('473404'), 'admin' =>false,'slug' => 'alejandro_montiel']);
        factory(App\User::class)->create([ 'name' => 'Alfonso Montano Rodríguez', 'email' => 'alfonso_montano@snte56', 'password' => bcrypt('395230'), 'admin' =>false,'slug' => 'alfonso_montano']);
        factory(App\User::class)->create([ 'name' => 'Ángel David Flores Mar', 'email' => 'angel_david_flores@snte56', 'password' => bcrypt('498079'), 'admin' =>false,'slug' => 'angel_david_flores']);
        factory(App\User::class)->create([ 'name' => 'Antolín Iturbide Meunier', 'email' => 'antolin_iturbide@snte56', 'password' => bcrypt('361665'), 'admin' =>false,'slug' => 'antolin_iturbide']);
        factory(App\User::class)->create([ 'name' => 'Antonio Reyes Cisneros', 'email' => 'antonio_reyes@snte56', 'password' => bcrypt('342976'), 'admin' =>false,'slug' => 'antonio_reyes']);
        factory(App\User::class)->create([ 'name' => 'Concepción Cabrera Heredia', 'email' => 'concepcion_cabrera@snte56', 'password' => bcrypt('320134'), 'admin' =>false,'slug' => 'concepcion_cabrera']);
        factory(App\User::class)->create([ 'name' => 'Cornelio Bastida Huesca', 'email' => 'cornelio_bastida@snte56', 'password' => bcrypt('231551'), 'admin' =>false,'slug' => 'cornelio_bastida']);
        factory(App\User::class)->create([ 'name' => 'David Amadeo Luna De Jesús', 'email' => 'david_amadeo_luna@snte56', 'password' => bcrypt('447395'), 'admin' =>false,'slug' => 'david_amadeo_luna']);
        factory(App\User::class)->create([ 'name' => 'Enrique Ortiz Hernández', 'email' => 'enrique_ortiz@snte56', 'password' => bcrypt('309087'), 'admin' =>false,'slug' => 'enrique_ortiz']);
        factory(App\User::class)->create([ 'name' => 'Erika Cobos Aguílar', 'email' => 'erika_cobos@snte56', 'password' => bcrypt('234328'), 'admin' =>false,'slug' => 'erika_cobos']);
        factory(App\User::class)->create([ 'name' => 'Fernando Sánchez Sánchez', 'email' => 'fernando_sanchez@snte56', 'password' => bcrypt('240078'), 'admin' =>false,'slug' => 'fernando_sanchez']);
        factory(App\User::class)->create([ 'name' => 'Gerardo Rosas Consuegra', 'email' => 'gerardo_rosas@snte56', 'password' => bcrypt('478875'), 'admin' =>false,'slug' => 'gerardo_rosas']);
        factory(App\User::class)->create([ 'name' => 'Guillermo Pelayo Álvarez', 'email' => 'guillermo_pelayo@snte56', 'password' => bcrypt('404757'), 'admin' =>false,'slug' => 'guillermo_pelayo']);
        factory(App\User::class)->create([ 'name' => 'Héctor Morales Viveros', 'email' => 'hector_morales@snte56', 'password' => bcrypt('246555'), 'admin' =>false,'slug' => 'hector_morales']);
        factory(App\User::class)->create([ 'name' => 'Isaías García Castillo', 'email' => 'isaias_garcia@snte56', 'password' => bcrypt('221792'), 'admin' =>false,'slug' => 'isaias_garcia']);
        factory(App\User::class)->create([ 'name' => 'Julio Cesar Moreno Aguílar', 'email' => 'julio_cesar_moreno@snte56', 'password' => bcrypt('433654'), 'admin' =>false,'slug' => 'julio_cesar_moreno']);
        factory(App\User::class)->create([ 'name' => 'Karina Lee Ortiz', 'email' => 'karina_lee@snte56', 'password' => bcrypt('439556'), 'admin' =>false,'slug' => 'karina_lee']);
        factory(App\User::class)->create([ 'name' => 'Leticia Báez Huesca', 'email' => 'leticia_baez@snte56', 'password' => bcrypt('360700'), 'admin' =>false,'slug' => 'leticia_baez']);
        factory(App\User::class)->create([ 'name' => 'Liliana Díaz García', 'email' => 'liliana_diaz@snte56', 'password' => bcrypt('406005'), 'admin' =>false,'slug' => 'liliana_diaz']);
        factory(App\User::class)->create([ 'name' => 'Lucia Reyes Aguílar', 'email' => 'lucia_reyes@snte56', 'password' => bcrypt('321690'), 'admin' =>false,'slug' => 'lucia_reyes']);
        factory(App\User::class)->create([ 'name' => 'Luis Camerino Costeño Totomol', 'email' => 'luis_camerino_costeño@snte56', 'password' => bcrypt('356978'), 'admin' =>false,'slug' => 'luis_camerino_costeño']);
        factory(App\User::class)->create([ 'name' => 'Luis Sarabia Olguín', 'email' => 'luis_sarabia@snte56', 'password' => bcrypt('246280'), 'admin' =>false,'slug' => 'luis_sarabia']);
        factory(App\User::class)->create([ 'name' => 'Lydia Reyes González', 'email' => 'lydia_reyes@snte56', 'password' => bcrypt('287173'), 'admin' =>false,'slug' => 'lydia_reyes']);
        factory(App\User::class)->create([ 'name' => 'Mauricio Mendoza Palomares', 'email' => 'mauricio_mendoza@snte56', 'password' => bcrypt('426592'), 'admin' =>false,'slug' => 'mauricio_mendoza']);
        factory(App\User::class)->create([ 'name' => 'Máximo Pazos Hernández', 'email' => 'maximo_pazos@snte56', 'password' => bcrypt('292475'), 'admin' =>false,'slug' => 'maximo_pazos']);
        factory(App\User::class)->create([ 'name' => 'Noel Colorado Morales', 'email' => 'noel_colorado@snte56', 'password' => bcrypt('330467'), 'admin' =>false,'slug' => 'noel_colorado']);
        factory(App\User::class)->create([ 'name' => 'Octavio Ortiz Salazar', 'email' => 'octavio_ortiz@snte56', 'password' => bcrypt('228962'), 'admin' =>false,'slug' => 'octavio_ortiz']);
        factory(App\User::class)->create([ 'name' => 'Porfirio Gutiérrez López', 'email' => 'porfirio_gutierrez@snte56', 'password' => bcrypt('300375'), 'admin' =>false,'slug' => 'porfirio_gutierrez']);
        factory(App\User::class)->create([ 'name' => 'Rafael Ochoa Cruz', 'email' => 'rafael_ochoa@snte56', 'password' => bcrypt('264681'), 'admin' =>false,'slug' => 'rafael_ochoa']);
        factory(App\User::class)->create([ 'name' => 'Roberto García Morales', 'email' => 'roberto_garcia@snte56', 'password' => bcrypt('377675'), 'admin' =>false,'slug' => 'roberto_garcia']);
        factory(App\User::class)->create([ 'name' => 'Rogelio Hernández Herrera', 'email' => 'rogelio_hernandez@snte56', 'password' => bcrypt('209262'), 'admin' =>false,'slug' => 'rogelio_hernandez']);
        factory(App\User::class)->create([ 'name' => 'Rosa Luz Suárez Sanabria', 'email' => 'rosa_luz_suarez@snte56', 'password' => bcrypt('374045'), 'admin' =>false,'slug' => 'rosa_luz_suarez']);
        factory(App\User::class)->create([ 'name' => 'Salvador Almeida Asleins', 'email' => 'salvador_almeida@snte56', 'password' => bcrypt('286698'), 'admin' =>false,'slug' => 'salvador_almeida']);
        factory(App\User::class)->create([ 'name' => 'Tomas Juárez Moreno', 'email' => 'tomas_juarez@snte56', 'password' => bcrypt('454877'), 'admin' =>false,'slug' => 'tomas_juarez']);
        factory(App\User::class)->create([ 'name' => 'Ubaldo Martínez Suarez', 'email' => 'ubaldo_martinez@snte56', 'password' => bcrypt('284530'), 'admin' =>false,'slug' => 'ubaldo_martinez']);
    }
}
