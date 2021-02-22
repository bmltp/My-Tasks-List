<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Tasks</title>

    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>Hi <b>{{$user}}</b>,Your Tasks List.</h2>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-info" href="/"><span>Home</span></a>
                    </div>
                    <div class="col-sm-3">
                        <a onclick="event.preventDefault();addTaskForm();" href="#" class="btn btn-success" data-toggle="modal"><span>Add New Task</span></a>
                    </div>
                    <div class="pull-right col-sm-2">
                        <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->status}}</td>
                        <td>{{$task->dueDate}}</td>
                        <td>
                            <a onclick="event.preventDefault();showTaskForm({{$task->id}});" href="#" class="show open-modal btn btn-success" data-toggle="modal" value="{{$task->id}}">Show</a>
                            <a onclick="event.preventDefault();editTaskForm({{$task->id}});" href="#" class="edit open-modal btn btn-primary" data-toggle="modal" value="{{$task->id}}">Edit</a>
                            <a onclick="event.preventDefault();deleteTaskForm({{$task->id}});" href="#" class="delete btn btn-warning" data-toggle="modal">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b>{{$tasks->count()}}</b> out of <b>{{$tasks->total()}}</b> entries</div>
                {{ $tasks->links() }}
            </div>

        </div>
    </div>
    @include('ajax.create')
    @include('ajax.show')
    @include('ajax.edit')
    @include('ajax.delete')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tasks.js')}}"></script>
</body>

</html>