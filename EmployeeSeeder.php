<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\employee;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $employees = collect(
            [
                [
                    'name' => 'Ravi Kumar',
                    'age' => 22,
                    'salary' => 17000,
                    'company' => 'Samsung'
                ],
                [
                    'name' => 'Dada Khelender',
                    'age' => 23,
                    'salary' => 15000,
                    'company' => 'Wipro'
                ],
                [
                    'name' => 'Kishore',
                    'age' => 24,
                    'salary' => 16000,
                    'company' => 'BSNL'
                ],
                [
                    'name' => 'Vidya Sagar',
                    'age' => 25,
                    'salary' => 15000,
                    'company' => 'Jspiders'
                ],
                [
                    'name' => 'Prahallada',
                    'age' => 26,
                    'salary' => 15000,
                    'company' => 'Qspiders'
                ],
                [
                    'name' => 'Ramesh',
                    'age' => 26,
                    'salary' => 16000,
                    'company' => 'Concentrix'
                ]
            ]
        );


        $employees->each(function($employee){
            employee::insert($employee);
        });

        
    }
                
}
