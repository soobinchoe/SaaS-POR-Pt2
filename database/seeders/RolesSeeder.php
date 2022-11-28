<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            ['name'=>'admin',],
            ['name'=>'manager',],
            ['name'=>'user',],
            ['name'=>'guest',],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
