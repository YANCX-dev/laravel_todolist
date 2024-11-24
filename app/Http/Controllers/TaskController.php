<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $user = User::find(1);

        if (isset($user)) {

            $tasks = $user->tasks();
//            dd($tasks->get());
            return view('taskpage', compact('tasks'));

        } else {
            return view('taskpage');
        }

    }

    public function store(Request $request)
    {
        $text = $request->string('taskText');

        $task = Task::create([
            'user_id' => 1, // в будущем использвать Auth::id();
            'status_id' => 1,
            'name' => null,
            'text' => $request->taskText,
        ]);

        return response()->json(data: [
            'success' => true,
            'message'=> 'Задача успешно создана!',
            'task'=> [
                'text' =>  $task->text,
                'status'=> $task->status->status,
                'id' =>    $task->id,
                'date' =>  $task->created_at,
            ]
        ]);

    }

//    public function destroy(Task $task)
//    {
//        $deleteStatus = $task->delete();
//
//        if ($deleteStatus) {
//            return redirect('/');
//        } else {
//            return redirect('/')->with('error', 'Не удалось удалить задачу! Попробуйте еще!');
//        }
//
//    }

    public function destroy($task_id)
    {
        $task = Task::find($task_id);

        if ($task) {
            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Задача успешно удалена',
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Задача не найдена',
        ], 404);
    }
    public function changeStatus(Request $request)
    {
        dd($request);
    }
}
