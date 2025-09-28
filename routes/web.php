<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController; // <-- ESSENTIAL: Imports your Controller

// 1. READ: Shows the list of all todos on the homepage (GET /)
Route::get('/', [TodoController::class, 'index'])->name('todo.index');

// 2. CREATE: Handles the form submission to add a new todo (POST /todos)
Route::post('/todos', [TodoController::class, 'store'])->name('todo.store');

// 3. UPDATE/COMPLETE: Toggles the completion status (POST /todos/{id}/complete)
Route::post('/todos/{todo}/complete', [TodoController::class, 'complete'])->name('todo.complete');

// 4. DELETE: Permanently removes a task (DELETE /todos/{id})
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');