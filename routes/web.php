<?php

use App\Http\Controllers\TodoController;
use App\Models\Todo;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('todos.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::controller(TodoController::class)->group(function(){
    Route::get('todos/index', 'index')->name('todos.index');
    Route::get('todos/create', 'create')->name('todos.create');
    Route::post('todos/store', 'store')->name('todos.store');
    Route::get('todos/show/{id}', 'show')->name('todos.show');
    Route::get('update-todo/{id}', 'edit')->name('todos.edit');
    Route::put('update-todo', 'update')->name('todos.update');
    Route::delete('todos/delete', 'destory')->name('todos.delete');
})->middleware(['auth']);