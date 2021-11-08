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

//VueのAxios用
Route::get('vue/get-holiday', [App\Http\Controllers\HolidayController::class, 'getHoliday']);
Route::get('vue/get-holidays', [App\Http\Controllers\HolidayController::class, 'getHolidays']);

Route::get('vue/get-todo', [App\Http\Controllers\TodoController::class, 'getTodo']);
Route::get('vue/get-todos', [App\Http\Controllers\TodoController::class, 'getTodos']);
Route::post('vue/register-todo', [App\Http\Controllers\TodoController::class, 'registerTodo']);
Route::delete('vue/delete-todo', [App\Http\Controllers\TodoController::class, 'deleteTodo']);