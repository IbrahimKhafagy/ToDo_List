<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TodolistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});




Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/{page}', [AdminController::class,'index']);

Route::get('/home', [TodolistController::class,'index']);

Route::post('/create/task',[TodolistController::class,'create'])->name('create.task');

Route::get('/edit-task/{id}',[TodolistController::class,'edit'])->name('edit-task');

Route::post('update-task/{id}',[TodolistController::class,'update'])->name('update-task');

Route::post('/update-task-completed',[TodolistController::class,'updateTaskCompleted']);
