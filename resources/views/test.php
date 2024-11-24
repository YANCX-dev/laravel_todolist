<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="task-manager">
    @if(session('success'))
    <p class="task-manager__success-message">{{ session('success') }}</p>
    @endif

    <!-- Форма создания задачи -->
    <form action="{{ route('addTask') }}" method="POST" class="task-manager__form">
        @csrf
        <h3 class="task-manager__form-title">Напишите текст задачи</h3>
        <input type="text" name="taskText" class="task-manager__input">
        <button type="submit" class="button button--primary">Создать задачу</button>
    </form>

    <!-- Новые задачи -->
    <div class="task-manager__section task-manager__section--new">
        <h3 class="task-manager__section-title">Новые задачи</h3>
        <ol class="task-list">
            @if(isset($tasks))
            @foreach($tasks as $task)
            <li class="task-list__item">
                {{ $task->text }} [{{ $task->status->status }}]
                <form action="{{ route('deleteTask', $task->id) }}" method="POST" class="task-list__form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button--delete" id="delete-{{ $task->id }}">&#128465;</button>
                </form>
            </li>
            @endforeach
            @elseif(empty($tasks))
            <p class="task-list__empty">Задача один, написать первую задачу</p>
            @endif
        </ol>
    </div>

    <!-- Задачи в процессе выполнения -->
    <div class="task-manager__section task-manager__section--in-progress">
        <h3 class="task-manager__section-title">Задачи в процессе выполнения</h3>
        <ol class="task-list">
            @if(count($tasks->NewTasks()) > 0)
            @foreach($tasks->NewTasks() as $task)
            <li class="task-list__item">
                {{ $task->text }} [{{ $task->status->status }}]
                <form action="{{ route('deleteTask', $task->id) }}" method="POST" class="task-list__form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button button--delete" id="delete-{{ $task->id }}">&#128465;</button>
                    <button type="button" class="button button--edit" id="edit-{{ $task->id }}">Изменить</button>
                </form>
            </li>
            @endforeach
            @elseif(empty($tasks))
            <p class="task-list__empty">Задача один, написать первую задачу</p>
            @endif
        </ol>
    </div>
</div>
</body>
</html>

