<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTaskController;


Route::get('/tasks', [ApiTaskController::class, 'index'])->name('tasks.index');
Route::post('tasks', [ApiTaskController::class, 'store'])->name('tasks.store');

Route::get('/create', [ApiTaskController::class, 'create'])->name('tasks.create');
Route::get('tasks/{task}/edit', [ApiTaskController::class, 'edit'])->name('tasks.edit');
Route::put('task/{task}', [ApiTaskController::class, 'update'])->name('tasks.update');

Route::delete('task/{task}', [ApiTaskController::class, 'destroy'])->name('tasks.destroy');

