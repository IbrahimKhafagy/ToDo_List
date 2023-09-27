<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\services\taskService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todo = Task::get();
        return view('index',compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, taskService $action)
    {
        // dd($request);

        $task = $action->storeTask($request);
        if ($task) {
            return response()->json([
                'success' => 'Task created successfully.',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'error' => 'error',
                'code' => 500
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $html = view('model',compact('task'))->render();
        return response()->json([
            'status' => 200,
            'task' => $task,
            'html'=>$html,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update($id, Request $request) {
    // dd($request->completed);

    $taskService = new taskService();
    $taskService->updateTask($id, $request);

    if ($taskService) {
        return response()->json([
            'success' => 'Task created successfully.',
            'code' => 200
        ]);
    } else {
        return response()->json([
            'error' => 'error',
            'code' => 500
        ]);
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function updateTaskCompleted(Request $request)
{
    $taskId = $request->input('taskId');
    $completed = $request->input('completed');
    if($completed){
    return response()->json([
        'success' => 'Task completed status updated successfully.',
        'code' => 200
    ]);
    }
}
}
