<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //Request class is used to fetch the data submitted through form and to display that data in json formate
    public function addUser(Request $req){
        
        $req->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:6',
            // 'confirmpass' => 'required|alpha_num|min:6',
            // 'age' => 'required|numeric|min:18|max:40',
            'age' => 'required|numeric|between:18,40',
        ],[
            'username.required' => 'Please enter User Name',
            
            'email.required' => 'Please enter Email Id',
            'email.email' => 'Enter valid and Correct Email Id',
            
            'password.required' => 'Enter a Password',
            'password.alpha_num' => 'Password must be Combination of numbers and Characters',
            'password.min' => 'Password must be 6 digits long',
            
            'age.required' => 'Age is Required Field',
            'age.numeric' => 'Age must be in Numbers',
            'age.between:18,40' => 'The age must between 18 and 40',
            
        ]);

        return $req->all();
    }

    // protected $stopOnFirstFailure = true;
}
