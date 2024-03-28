<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(
            [
                'id'=>1 ,
                'name'=>'super admin'
            ]
        ) ;
        Role::create(
            [
                'id'=>2 ,
                'name'=>'admin'
            ]
        ) ;
        Role::create(
            [
                'id'=>3 ,
                'name'=>'visiteur'
            ]
        ) ;
         \App\Models\User::create([
             'name' => 'Duvaal super',
             'email' => 'adminduvaal@gmail.com',
             'fontion' => 'DRH' ,
             'phone' =>'+237677895592',
             'date_entree' => date('2021-03-21') ,
             'role_id' => '2',
             'password' => 'password'

        ]);
    }
}
