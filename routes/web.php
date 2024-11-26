<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get(   '/',                     [TaskController::class,        'index']);
Route::post(  '/addTask',              [TaskController::class,        'store']);
Route::delete('/deleteTask/{task_id}', [TaskController::class,      'destroy']);
Route::get(   '/changeStatus',         [TaskController::class, 'changeStatus'])->name('changeStatus');
Route::get(   '/task/{id}',            [TaskController::class,         'show'])->name('taskShow');

