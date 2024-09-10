<?php

use App\Http\Controllers\Halo\HaloController;
use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;
//mengganti index ke todo
Route::get('/', [TodoController::class,'index'])->name('todo'));


// Route::get('/halo',function(){
//     return view('coba.halo');
// });
//
Route::get('/halo',[HaloController::class,'index']);

//membuat routing yang akan ergi ke todokontroller dengan nama fungsi 'index'
Route::get('/todo',[TodoController::class,'index'])->name('todo');
//membuat routing yang akan ergi ke todokontroller dengan nama fungsi 'store'
Route::post('/todo',[TodoController::class,'store'])->name('todo.post');
//membuat routing yang akan ergi ke todokontroller dengan nama fungsi 'update'
Route::put('/todo/{id}',[TodoController::class,'update'])->name('todo.update');
//membuat routing yang akan ergi ke todokontroller dengan nama fungsi 'delete'
Route::delete('/todo/{id}',[TodoController::class,'destroy'])->name('todo.delete');