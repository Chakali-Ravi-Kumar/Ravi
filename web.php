<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('students',[App\Http\Controllers\StudentController::class,'index'])->name('index');
Route::get('students/create',[App\Http\Controllers\StudentController::class,'create'])->name('add');
Route::post('students/create',[App\Http\Controllers\StudentController::class,'store'])->name('store');
Route::get('students/view/{id}',[App\Http\Controllers\StudentController::class,'show'])->name('view');
Route::get('students/edit/{id}',[App\Http\Controllers\StudentController::class,'edit'])->name('edit');
Route::post('students/update{id}',[App\Http\Controllers\StudentController::class,'update'])->name('update');
Route::get('students/destroy/{id}',[App\Http\Controllers\StudentController::class,'destroy'])->name('destroy');




// Route::post('students/create',[App\Http\Controllers\StudentController::class,'update'])->name('update');
// Route::get('students/create',[App\Http\Controllers\StudentController::class,'destroy'])->name('destroy');



// Route::get('/', function(){
//     return view('welcome');
// });

Route::get('/',[ProductController::class,'index'])->name('products.index');
Route::get('products/create',[ProductController::class,'create'])->name('products.create');
Route::post('products/store',[ProductController::class,'store'])->name('products.store');
Route::get('products/{id}/edit',[ProductController::class,'edit']);
Route::put('products/{id}/update',[ProductController::class,'update']);   //to update the data use put or patch request
Route::get('products/{id}/delete',[ProductController::class,'destroy']);
Route::get('products/{id}/show',[ProductController::class,'show']);   //To view the data








