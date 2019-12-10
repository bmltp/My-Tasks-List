@extends('layouts.layout')
 
@section('content')
<br> <hr>
   <div class="container ">
        <div class='row justify-content-center'>
            <div class="col-sm-5 col-md-5 col-lg-5">
                    <h2>Hi {{$user}}, Your Task List.</h2>
            </div>
            <div class='col-sm-2 col-md-2 col-lg-2'>
                <a class="btn btn-primary" href="/">Home</a>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3">
                <a class="btn btn-success" href="{{ route('tasks.create') }}">Create New Task</a>
            </div>
            <div class="col-sm-2 offset-md-2 col-lg-2">
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <hr>
        @if ($message = Session::get('OK'))
        <div class="row alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th width="250px">Action</th>
            </tr>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ date('D d M Y', strtotime($task->dueDate)) }}</td>
                <td>
                    <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
    
                        <a class="btn btn-info" href="{{ route('tasks.show',$task->id) }}">Show</a>
        
                        <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>
    
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="row justify-content-center">
            <div class="text-center">
                {!! $tasks->links() !!}
            </div>
        </div>
    </div>
   
@endsection