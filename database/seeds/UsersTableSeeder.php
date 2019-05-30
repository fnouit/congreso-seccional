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
        User::create([
            'name' => 'Vicente Juarez',
            'email' => 'root@intranet.snte56',
            'password' => bcrypt('123456'),
            'admin' => true
        ]);
    }
}
