<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class User extends Model
{
    use HasFactory;

    public function post(){
        return $this->hasMany(Post::class);
    }


    // booted() is a model event which is used when if want to delete the records which are connected with one to many relation if any id is deleted
    // all the details should be automatically deleted from another table which is related
    // protected static function booted() :void{

    //     //       deleted() is an event which is used to delete 
    //     //          |
    //     //          |
    //     static::deleted(function($user){
    //         $user->post()->delete();    
    //     });
    // }
}

