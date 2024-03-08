<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StartupController extends Controller
{
    public function showStartups(){
        $startups = DB::table('startups')->whereNotBetween('id',[7,10])->get();
       

        // $startups = DB::table('startups')->find(4);

        // return $startups;
        // dd($startups);

        // foreach($startups as $startup){
        //     echo $startup->name."<br>";
        // }

        return view('allstartups',['data' => $startups]);
    }

    public function addStartup(Request $req){
        // return $req;
        $startup = DB::table('startups')->insert([
            [
                'name' => $req->name,   
                'location' => $req->location,
                'ceo' => $req->ceo,
                'type' => $req->type,
                'noofworkers' => $req->noofworkers,
                'created_at' => now(),
                'updated_at' => now()
    
            ]
        ]);

        // dd($startup);
        if($startup){

            return redirect()->route('home');
        }else{
            echo "<h1>Data Not added</h1>";
        }
    }


    public function updatePage(string $id){
        // $startup = DB::table('startups')->where('id',$id)->get();
        $data = DB::table('startups')->find($id);   
        return view('updatestartup',compact('data'));


        // return $startup;
    }

    public function updateStartup(){
        $startup = DB::table('startups')->where('id',52)
                                        ->decrement('noofworkers',5,['location' => 'Chenni']);

                                        if($startup){
                                            echo "<h1>Data updated successfully</h1>";    
                                        }else{
                                            echo "<h1>Data Not Updated </h1>";    
                                        }
    }

    public function viewStartup(string $id){
        $startup = DB::table('startups')->where('id',$id)->first();
    }


    

    public function deleteStartup(string $id){  
        $startup = DB::table('startups')->where('id',$id)->delete();

        if($startup){
            return redirect()->route('home');  
        }
        else{
            echo "<h1>Data Not Deleted </h1>";
        }
    }
}
