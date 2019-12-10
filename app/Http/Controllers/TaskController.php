<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $name = \Auth::user()->name;
        $id = \Auth::user()->id;
        $tasks = Task:://latest()
                // ->
                where('user_id','=',$id)
                ->orderBy('dueDate', 'ASC')
                ->paginate(5);

        // dd($tasks);
        return view('tasks.index', compact('tasks'))
                ->with('i', (request()->input('page', 1) - 1) * 5)
                ->with('user',$name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'dueDate' => 'required',
            'status' => 'required',
        ]);
        
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->dueDate = $request->dueDate;
        $task->user_id = \Auth::user()->id;
        $task->save();
        // Task::create($request->all());
        return redirect()->route('tasks.index')
                        ->with('OK','Task Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('user_id','=',\Auth::user()->id)
                        ->where('id','=',$id)
                        ->firstOrFail();
        

        return view('tasks.show',compact('task'));
        // return view('tasks.show')->with('task',$task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::where('user_id','=',\Auth::user()->id)
                        ->where('id','=',$id)
                        ->firstOrFail();
        return view('tasks.edit',compact('task'));
        // return view('tasks.edit')->with('task',$task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
//            'dueDate' => 'required', //needs review

        ]);

        $task = Task::where('user_id','=',\Auth::user()->id)
                        ->where('id','=',$id)
                        ->firstOrFail();

        if ($request->dueDate != null) {
            $task->dueDate = $request->dueDate;
         }
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        //$task->dueDate = $request->status;//review is necessary
        $task->user_id = \Auth::user()->id;
        $task->update(); 
        return redirect()->route('tasks.index')
                        ->with('OK','Task updated.');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('user_id','=',\Auth::user()->id)
                        ->where('id','=',$id)
                        ->firstOrFail();
        $task->delete();
        return redirect()->route('tasks.index')
                        ->with('OK', 'Task deleted.');
    }
}
