<?php
use Illuminate\Support\Facades\Auth;
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


Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class,'index'])->name('home');
    //Route::get('/folders/{id}/tasks',[App\Http\Controllers\Taskcontroller::class,'index'])->name('tasks.index');

    //タスク機能作成
    //    Route::get('/folders/{folder}/tasks',[App\Http\Controllers\Taskcontroller::class,'index'])->name('tasks.index');

    //フォルダ作成機能ルーティング
    Route::get('/folders/create',[App\Http\Controllers\FolderController::class,'showCreateForm'])->name('folders.create');
    Route::post('/folders/create',[App\Http\Controllers\FolderController::class,'create']);

    //タスク作成機能ルーティング
//  Route::get('/folders/{id}/tasks/create',[App\Http\Controllers\Taskcontroller::class,'showCreateForm'])->name('tasks.create');
//  Route::post('/folders/{id}/tasks/create', [App\Http\Controllers\Taskcontroller::class,'create']);
    //タスク編集機能ルーティング
//    Route::get('/folders/{id}/tasks/{task_id}/edit', [App\Http\Controllers\Taskcontroller::class,'showEditForm'])->name('tasks.edit');
 //   Route::post('/folders/{id}/tasks/{task_id}/edit', [App\Http\Controllers\Taskcontroller::class,'edit']);


    Route::group(['middleware' => 'can:view,folder'], function() {
        Route::get('/folders/{folder}/tasks',[App\Http\Controllers\Taskcontroller::class,'index'])->name('tasks.index');

        Route::get('/folders/{folder}/tasks/create',[App\Http\Controllers\Taskcontroller::class,'showCreateForm'])->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', [App\Http\Controllers\Taskcontroller::class,'create']);

        Route::get('/folders/{folder}/tasks/{task}/edit', [App\Http\Controllers\Taskcontroller::class,'showEditForm'])->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', [App\Http\Controllers\Taskcontroller::class,'edit']);
    });


});






// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


require __DIR__.'/auth.php';




//laravel8.0からの新しいルーティング設定
//Route::get('/',[App\Http\Controllers\Taskcontroller::class,'index']);

//この記述方法でも通る
//Route::get('/', 'App\Http\Controllers\Taskcontroller@index')->name('index');


