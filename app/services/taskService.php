<?php

namespace App\services;

use App\Models\Task;

class taskService {

    public function storeTask($request) {

        $task = Task::create([
            'title' => $request['title'],
            'notes' => $request['notes'],
            'date' => $request['date'],
           ]);
        $task->save();
        return $task;
    }



    public function updateTask($id, $request) {
        $task = Task::findOrFail($id);
        $data = $request->only('title', 'notes', 'date', 'completed');
        $task->update($data);
        return $task;
    }
}

