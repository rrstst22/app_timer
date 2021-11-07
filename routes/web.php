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

Route::get('/', function () {
    return view('index');
});


Route::get('get-holidays', [App\Http\Controllers\CountDownController::class, 'getHolidays']);
Route::get('get-holiday', [App\Http\Controllers\CountDownController::class, 'getHoliday']);
Route::get('get-todos', [App\Http\Controllers\ToDoController::class, 'getTodos']);
Route::get('get-todo', [App\Http\Controllers\ToDoController::class, 'getTodo']);
Route::post('vue/register-todo', [App\Http\Controllers\ToDoController::class, 'registerTodo']);
Route::delete('vue/delete-todo', [App\Http\Controllers\ToDoController::class, 'deleteTodo']);