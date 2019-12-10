@extends('layouts.layout')
@section('content')
    <br>
    <div class="container  text-center">
        <div class='row'>
            <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back</a>
        </div>
        <br>
        <div class='row'>
            <h2>Task Details</h2>
        </div>
        <hr>
        <div class="row">
            <strong>Title:</strong>
                <br>
                {{ $task->title }}
        </div>
        <br>
        <div class="row">
            <strong>Description:</strong>
                <br>
                {{ $task->description }}
        </div>
        <br>
        <div class="row">
                <strong>Status:</strong>
                <br>
                {{ $task->status }}
        </div>
        <br>
        <div class="row">
                <strong>Due Date</strong>
                    <br>
                {{ date('D d M Y', strtotime($task->dueDate)) }}
        </div>
        <br>
        <div class="row ">
        <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>
        </div>
        <br>
        <div class='row '>
            <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection