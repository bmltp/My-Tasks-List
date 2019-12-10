<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function react()
    {
        return view('react');
    }

    
    public function index()
    {
        $name = \Auth::user()->name;
        $id = \Auth::user()->id;
        $tasks = Task:://latest()
                // ->
                where('user_id','=',$id)
                ->orderBy('dueDate', 'ASC')
                ->paginate(50);

        return response()->json([
            'success' => true,
            'tasks'=> $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'description'=>'required',
            'dueDate'=>'required',
            'status'=>'required',
            'user_id'=> 'required'

        ]);
        if ($request->user_id != \Auth::user()->id) {
            return response()->json([
                'success'=>false,
                'message'=>'Invalid User'
            ]);
        } 
        
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->dueDate = $request->dueDate;
        $task->user_id = \Auth::user()->id;
        
        if ($task->save())
            return response()->json([
                'success'=>true,
                'message'=>'Task created',
                'task'=>$task->toArray()
            ]);
        else {
            return response()->json([
                'success'=>false,
                'message'=>'Unable to add task.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = auth()->user()->tasks()->find($id);
        if(!$task) {
            return response()->json([
                'success'=>false,
                'message'=>'Task not found.'
            ],400);
        }

        return response()->json([
            'success'=>true,
            'tasks'=> $task
        ],200);
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
        $task = auth()->user()->tasks->find($id);

        if (!$task) 
            return response()->json([
                'success'=>false,
                'message'=>'Task not found.'
            ],400);
         else {
            $request->all();
            if ($request->dueDate) {
                $task->dueDate = $request->dueDate;
             }
            if ($request->title) {
                $task->title = $request->title;
             }
            if ($request->description) {
                $task->description = $request->description;
             }
             if ($request->status) {
                $task->status = $request->status;
             }
         
            $task->user_id = \Auth::user()->id;
            if ($task->update())
                return response()->json([
                    'success'=>true,
                    'message'=>'Task updated'
                ],200);
            else {
                return response()->json([
                    'success'=>false,
                    'message'=>'Unable to update.'
                ],500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = auth()->user()->tasks()->find($id);
        if (!$task) {
            return response()->json([
                'success'=> false,
                'message'=> 'Task not found.'
            ],400);
        }
        else {
            if ($task->delete()) {
                return response()->json([
                    'success'=>true
                ],200);
                } else {
                    return response()->json([
                    'success'=>false,
                    'message'=>'Unable to delete task.'
                    ],500);
            }
        }
    }
}
