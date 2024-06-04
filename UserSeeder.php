<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = collect([
            [
                'name' => 'Ravi Kumar',
                'email' => 'cravikumar689@gmail.com'
            ],
            [
                'name' => 'Shalini',
                'email' => 'shalini@gmail.com'
            ],
            [
                'name' => 'Sagar',
                'email' => 'sagar@gmail.com'
            ],
            [
                'name' => 'Dada Khelender',
                'email' => 'dada@gmail.com'
            ]
        ]);

        $users->each(function($user){
            User::insert($user);
        });
    }
}
