<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index']);
Route::post('/addTask', [TaskController::class, 'store'])->name('addTask');
Route::get('deleteTask/{task}', [TaskController::class, 'destroy'])->name('deleteTask');
