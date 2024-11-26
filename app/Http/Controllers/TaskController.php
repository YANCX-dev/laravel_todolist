<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use http\Header;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

/**
 *
 */
class TaskController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $user = User::find(1);

        if (isset($user)) {

            $tasks = $user->tasks();
            return view('task.index', compact('tasks'));

        }

        return view('task.index');
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'taskText' => 'required|string|max:255',
        ]);

        $task = Task::create([
            'user_id' => 1, // в будущем использвать Auth::id();
            'status_id' => 1,
            'name' => null,
            'text' => $request->taskText,
        ]);

        if (!$task) {
            return response()->json(data: [
                'success' => false,
                'validate' => $validated,
                'message' => 'Ошибка создания задачи'
            ]);
        }

        return response()->json(data: [
            'success' => true,
            'message' => 'Задача успешно создана!',
            'task' => [
                'text' => $task->text,
                'status' => $task->status->status,
                'id' => $task->id,
                'date' => $task->created_at,
            ]
        ]);
    }


    /**
     * @param int $task_id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(int $task_id): JsonResponse|RedirectResponse
    {
        $task = Task::find($task_id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена',
            ], 404);
        }

//        $ajax = !request()->ajax();
//
//        if (!request()->ajax()) {
//            $task?->delete();
//            return redirect('/');
//        }


        $task->delete();

        return response()->json([
            'success' => true,
//            'ajax' => $ajax,
            'message' => 'Задача успешно удалена',
        ]);

    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function changeStatus(Request $request): void
    {
        dd($request);
    }

    /**
     * @param $id
     *
     * @return View
     */
    public function show(int $id): View
    {
        $task = Task::find($id);

        return view('task.show', compact('task'));
    }
}
