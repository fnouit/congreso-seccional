<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(NomenclaturasTableSeeder::class);
        $this->call(NivelsTableSeeder::class);
        $this->call(SituacionsTableSeeder::class);
        $this->call(GenerosTableSeeder::class);
        $this->call(EstudiosTableSeeder::class);
    }
}
