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
            return view('task.index', compact('tasks'));

        } else {
            return view('task.index');
        }

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'taskText'=>'required|string|max:255',
        ]);

        $task = Task::create([
            'user_id' => 1, // в будущем использвать Auth::id();
            'status_id' => 1,
            'name' => null,
            'text' => $request->taskText,
        ]);

        if($task){
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

        return response()->json(data: [
            'success' => false,
            'validate'=> $validated,
            'message' => 'Ошибка создания задачи'
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

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('task.show', compact('task'));
    }
}
