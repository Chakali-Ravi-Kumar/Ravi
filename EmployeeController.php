<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    public function showEmployees(){
        //Raw SQL Queries.
        // $employees = DB::select("select name,age,salary from employees where salary < ? and name like ?",[17000,"R%"]);
        // $employees = DB::select("select name,age,salary from employees where id = :id",['id' => 3]);
        //                                                                       col-name.  col-name and key in the array must be same

        // $employees = DB::insert("insert into employees (name,age,salary,company) values (?,?,?,?)",["Basha",24,16000,"Unisoc Solutions"]);
        // $employees = DB::update("update employees set company = 'JPMorgan' where id = ?",[7]);
        // $employees = DB::delete("delete from employees where id = ?",[7]);
        // $employees = DB::unprepared("update employees set company = 'Py spiders' where id = 5");

        $employees = DB::table('employees')
                        // ->selectRaw('name,age,salary,company')
                        // ->selectRaw('count(*),age')
                        ->select(DB::raw('count(*) as employee_count'),'age')
                        // ->whereRaw('salary > ? and name like ?',[15000,'R%'])  //secure way
                        // ->orderByRaw('age,name,company')
                        ->groupByRaw('age')
                        ->havingRaw('age > ?',[23])
                        ->get();

                        // ->toSql(); it is used to check whether the sql query is correct? it returns the sql query. 


        return $employees;

        // foreach($employees as $employee){
        //     echo $employee->name."<br>";
        // }
    }
}
