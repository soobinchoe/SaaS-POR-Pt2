<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $seedUsers = [
            [ 'id' => '1', 'given_name'	=> 'Ad', 'family_name' => 'Ministrator', 'email' => 'admin@example.com', 'password' =>	'Password1!', ],
            [ 'id' => '2', 'given_name'	=> 'Soobin', 'family_name' => 'Choe', 'email' => 'soobin@example.com', 'password' =>	'Password1!', ],
            [ 'id' => '45', 'given_name'=> 'Jacques', 'family_name' => 'd’Carre', 'email' => 'jacques@example.com', 'password' =>	'Password1!', ],
            [ 'id' => '46', 'given_name'=> 'Dee', 'family_name' => 'Leet', 'email' => 'dee@example.com', 'password' =>	'Password1!', ],
            [ 'id' => '47', 'given_name'=> 'Eileen', 'family_name' => '	Dover', 'email' => 'eileen@example.com', 'password' =>	'Password1!', ],
            [ 'id' => '48', 'given_name'=> 'Booker', 'family_name' => '	Holliday', 'email' => 'booker@example.com', 'password' => '	Password1!', ],
            [ 'id' => '49', 'given_name'=> 'Fallon', 'family_name' => '	Dover', 'email' => 'fallon@example.com', 'password' =>	'Password1!', ],
        ];

        foreach ($seedUsers as $seedUser) {
            User::create($seedUser);
        }

    }
}
