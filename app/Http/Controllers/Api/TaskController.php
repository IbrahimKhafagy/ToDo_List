<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
// use Tymon\JWTAuth\Validators\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::orderBy('created_at','DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newTask= new Task;
        $newTask ->title =$request->task["title"];
        $newTask ->notes =$request->task["notes"];
        $newTask ->date =$request->task["date"];

        $newTask->save();

        return $newTask;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $existingtask = Task::find($id);

        if( $existingtask ){
            $existingtask->completed = $request->task['completed'] ? true : false;
            $existingtask->date = $request->task['completed'] ? Carbon::now()  : null ;
            $existingtask->save();

            return $existingtask;
        }
        return "Task not found";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $existingtask =Task::find($id);

        if($existingtask){
            $existingtask->delete();
            return "Task deleted successfully";
        }
        return "Task not found";
    }


}
