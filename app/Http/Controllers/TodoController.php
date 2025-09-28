<?php

namespace App\Http\Controllers;

use App\Models\Todo; // Required for database interaction (the Model)
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // READ: Displays the list of all todos on the homepage
    public function index()
    {
        // Fetch ALL records from the 'todos' table
        $todos = Todo::all();
        
        // Pass the data to the view
        return view('todos.index', compact('todos'));
    }

    // CREATE: Handles form submission to save a new todo
    public function store(Request $request)
    {
        // Validation: ensures the title field is present
        $request->validate(['title' => 'required|max:255']);

        // Save a new record
        Todo::create(['title' => $request->title]);

        // Redirect back to the list
        return redirect()->route('todo.index');
    }

    // UPDATE (Complete/Pending Toggle): Changes the status of a specific todo
    public function complete(Todo $todo)
    {
        // Route Model Binding finds the correct $todo item automatically
        
        // Toggle the 'is_completed' status
        $todo->is_completed = !$todo->is_completed;
        
        // Save the change back to the database
        $todo->save();
        
        return redirect()->route('todo.index');
    }
    
    // DELETE: Permanently removes a specific todo item
    public function destroy(Todo $todo)
    {
        // Route Model Binding finds the correct $todo item
        $todo->delete();
        
        return redirect()->route('todo.index');
    }
}