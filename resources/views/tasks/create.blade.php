@extends('layouts.layout')
  
@section('content')
<br>
    <div class="container  text-center">
        <div class='row'>
            <a class="btn btn-primary" href="/tasks">Back</a>
        </div>
        <br>
        <div class='row'>
            <h2>Add New Task</h2>
        </div>
   
        @if ($errors->any())
            <div class="row alert alert-danger">
                <strong>Please!</strong> enter valid inputs.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <hr>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="row">
                <strong>Title:</strong>
                <br>
                <input type="text" name="title" value="{{old('title')}}" placeholder="Title" >
            </div>
            <br>
            <div class="row">
                <strong>Description:</strong>
                <br>
                <textarea style="height:150px" name="description" placeholder="Description">{{old('description')}}</textarea>
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
                @if (old('status') == $status)
                <option value="{{old('status')}}" selected >{{old('status')}}</option>
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
                <input type="date" value="{{old('dueDate')}}" min="<?php echo date('Y-m-d'); ?>" style="height:50px" name="dueDate">
            </div>
            <br>
            <div class="row">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection