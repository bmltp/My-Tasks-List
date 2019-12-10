<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Validator;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $name = \Auth::user()->name;
        $id = \Auth::user()->id;
        $tasks = Task:: //latest()
            // ->
            where('user_id', '=', $id)
            ->orderBy('dueDate', 'ASC')
            ->paginate(5);

        // dd($tasks);
        return view('ajax.index', compact('tasks'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('user', $name);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'title' => 'required',
            'description' => 'required',
            'dueDate' => 'required',
            'status' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->dueDate = $request->dueDate;
        $task->user_id = \Auth::user()->id;

        if ($task->save())
            return response()->json([
                'error' => false,
                'task'  => $task,
            ], 200);
        //     'success'=>true,
        //     'message'=>'Task created',
        //     'task'=>$task->toArray()
        // ]);
        else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to add task.'
            ]);
        }

        $task = Task::create($request->all());

        return response()->json([
            'error' => false,
            'task'  => $task,
        ], 200);
    }

    public function show($id)
    {
        $task = auth()->user()->tasks()->find($id);

        if(!$task) {
            return response()->json([
                'error'=>true,
                'message'=>'Task not found.'
            ],400);
            // return response()->json([
            //     'success'=>false,
            //     'message'=>'Task not found.'
            // ],400);
        }
        // return response()->json([
        //     'success'=>true,
        //     'tasks'=> $task
        // ],200);
        return response()->json([
            'error' => false,
            'task'  => $task,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'dueDate' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $task = auth()->user()->tasks()->find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->dueDate = $request->dueDate;
        $task->user_id = \Auth::user()->id;

        $task->update();

        return response()->json([
            'error' => false,
            'task'  => $task,
        ], 200);
    }


    public function destroy($id)
    {
        $task = auth()->user()->tasks()->find($id);
        if (!$task) {
            // return response()->json([
            //     'success'=> false,
            //     'message'=> 'Task not found.'
            // ],400);
            return response()->json([
                'error'=> true,
                'message'=> 'Task not found.'
            ],400);
        }
        else {
            if ($task->delete()) {
                return response()->json([
                    'error' => false,
                    'task'  => $task,
                    // 'success'=>true
                ],200);
                } else {
                    return response()->json([
                        'error'=> true,//'success'=>false,
                    'message'=>'Unable to delete task.'
                    ],500);
            }
        }
    }
}