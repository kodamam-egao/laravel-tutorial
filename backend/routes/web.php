<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/folders/{id}/tasks', 'Taskcontroller@index')->name('index');


Route::get('/{id}',[App\Http\Controllers\Taskcontroller::class,'index'])->name('tasks.index');

Route::get('/folders/create',[App\Http\Controllers\FolderController::class,'showCreateForm'])->name('folders.create');
Route::post('/folders/create',[App\Http\Controllers\FolderController::class,'create']);



//laravel8.0からの新しいルーティング設定
//Route::get('/',[App\Http\Controllers\Taskcontroller::class,'index']);

//この記述方法でも通る
//Route::get('/', 'App\Http\Controllers\Taskcontroller@index')->name('index');


