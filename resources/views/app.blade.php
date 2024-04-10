<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <title>My TODO</title>

    <style>

        body{
            background-color: whitesmoke;
        }


        /* Custom CSS for Task Management Application */
        .container {
            margin-top: 50px;
        }

        /* Style for table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .actions-btn-group {
            display: flex;
        }

        .actions-btn-group button {
            margin-right: 5px;
        }

        /* Style for completed tasks list */
        .completed-tasks {
            list-style-type: none;
            padding: 0;
        }

        .completed-task-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .completed-task-item button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Todos</h1>
        <hr>
        
        <h2>Add your Tasks</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('/todos') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="task" placeholder="Add new task">
            </div>
            <button class="btn btn-primary" type="submit">Store</button>
        </form>
        <hr>
        @if (session('status'))
        <div class="alert alert-success">
           {{ session('status') }}
        </div>
    @endif
    <hr>

        <h2>Pending Tasks</h2>
       
        <table class="table">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todos as $todo)
                    <tr>
                        <td>{{ $todo->task }}</td>
                        <td class="actions-btn-group">
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                                Edit
                            </button>
                            <form action="{{ url('todos/'.$todo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            <form action="{{ route('todos.complete', $todo->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method to indicate task completion -->
                                <button class="btn btn-success" type="submit">
                                    <i class="fas fa-check"></i> <!-- Font Awesome check icon -->
                                    Complete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="collapse" id="collapse-{{ $loop->index }}">
                                <div class="card card-body">
                                    <form action="{{ url('todos/'.$todo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="form-control" name="task" value="{{ $todo->task }}">
                                        <button class="btn btn-secondary mt-2" type="submit">Update</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        
        <!-- Completed tasks section -->
        <h2>Completed Tasks</h2>
        <ul class="completed-tasks">
            @foreach($completedTasks as $completedTask)
                <li class="completed-task-item">
                    <span>{{ $completedTask->task }}</span>
                    <form action="{{ url('todos/'.$completedTask->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <hr>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
