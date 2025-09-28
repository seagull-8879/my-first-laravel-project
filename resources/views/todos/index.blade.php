<!DOCTYPE html>
<html>
<head>
    <title>Simple To-Do App</title>
</head>
<body>
    <h1>My To-Do List 📝</h1>

    <form method="POST" action="{{ route('todo.store') }}">
        @csrf
        <input type="text" name="title" placeholder="New To-Do Item" required>
        <button type="submit">Add Item</button>
    </form>

    <hr>

    <ul>
        @forelse ($todos as $todo)
            <li>
                <form method="POST" action="{{ route('todo.complete', $todo->id) }}" style="display:inline;">
                    @csrf

                    <span style="text-decoration: {{ $todo->is_completed ? 'line-through' : 'none' }};">
                        {{ $todo->title }}
                    </span>

                    @if ($todo->is_completed) - **(DONE)** @else - (Pending) @endif

                    <button type="submit">
                        {{ $todo->is_completed ? 'Mark Pending' : 'Mark Complete' }}
                    </button>
                </form>

                <form method="POST" action="{{ route('todo.destroy', $todo->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE') 
                    <button type="submit" style="color: red;">Delete</button>
                </form>
            </li>
        @empty
            <li>No tasks yet! Add one above.</li>
        @endforelse
    </ul>
</body>
</html>