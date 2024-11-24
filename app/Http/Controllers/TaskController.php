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

        if(isset($user)){

            $tasks = $user->tasks();
//            dd($tasks->get());
            return view('taskpage', compact('tasks'));

        }else{
           return view('taskpage');
        }

    }
    public function store(Request $request)
    {
        $task = $request->string('taskText');
        $tasks = Task::all();
        $user = User::find(1);
        $status = Status::find(1);
        Task::create([
            'user_id'=> $user->id,
            'status_id' => $status->id,
            'name' => null,
            'text'=>$task,
        ]);

        return redirect('/')->with('tasks', $tasks);

    }

    public function destroy(Task $task)
    {
        $deleteStatus = $task->delete();

        if($deleteStatus){
            return redirect('/');
        }else{
            return redirect('/')->with('error', 'Не удалось удалить задачу! Попробуйте еще!');
        }

    }
}
