<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <title>Tasks App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container mt-2">
      <div class="row">
        <div class="col-lg-12 margin-tb">
          <div class="pull-left">
            <h2> Home</h2>
          </div>
          <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create Task</a>
          </div>
        </div>
      </div> @if ($message = Session::get('success')) <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div> @endif <table class="table table-bordered">
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Description</th>
          <th>Author</th>
          <th width="280px">Action</th>
        </tr> @foreach ($tasks as $task) <tr>
          <td>{{ $task->id }}</td>
          <td>{{ $task->task_name }}</td>
          <td>{{ $task->description }}</td>
          <td>{{ $task->author }}</td>
          <td>
            <form action="{{ route('tasks.destroy',$task->id) }}" method="Post">
              <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr> @endforeach
      </table> {!! $tasks->links() !!}
  </body>
</html>