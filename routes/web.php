<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [Todo::class, 'index']);
Route::post('/todos', [Todo::class, 'store']);
Route::put('/todos/{id}', [Todo::class, 'update']);
Route::delete('/todos/{id}', [Todo::class, 'destroy']);
Route::put('/todos/{id}/complete', [Todo::class, 'complete'])->name('todos.complete');
// Route::get('/tasks/completed', [TaskController::class, 'completedTasks'])->name('tasks.completed');

