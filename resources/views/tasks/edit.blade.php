@extends('layouts.layout')
   
@section('content')
<br>
    <div class="container text-center">
        <div class='row'>
            <a class="btn btn-primary" href="/tasks"> Back</a>
        </div>
        <br>
        <div class='row'>
            <h2>Edit Task</h2>
        </div class="row">   
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Plaase!</strong> enter valid inputs. <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <hr>
        <form action="{{ route('tasks.update',$task->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div class="row">
                <strong>Title:</strong>
                <br>
                <input type="text" name="title" value="{{ $task->title }}" placeholder="Title">
            </div>
            <br>
            <div class="row">
                <strong>Description:</strong>
                <br>
                <textarea style="height:150px" name="description" placeholder="Description">{{ $task->description }}</textarea>
            </div>
            <br>
            <div class="row">
                <strong>Status:</strong>
                <br>
                    <select name="status">
                    <?php
                    $list = array("", "Queue", "In Progress", "Completed");
                    ?>
                    @foreach ($list as $status)
                    @if ($task->status == $status)
                    <option value="{{$task->status}}" selected >{{$task->status}}</option>
                    @else 
                    <option value="{{$status}}">{{$status}}</option>
                    @endif
                    @endforeach
                    </select>
            </div>
            <br>
            <div class="row">
                <strong>Due Date:</strong>
                <br>
                <input class="col-3" type="date" min="<?php echo date('Y-m-d'); ?>" style="height:50px" name="dueDate" value={{ $task->dueDate }} >
            </div>
            <br>
            <div class="row">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection