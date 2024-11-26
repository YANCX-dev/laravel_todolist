@extends('layouts.app')


@section('content')

    <div class="task-card__opened">
        <h3>Задача</h3>
        <div class="wrapper">
            <p class="">Статус задачи: {{$task->status->status}}</p>
            <p class="">Дата создания:{{$task->created_at}}</p>
            <p>Тест задачи:</p>

            <span>
                {{$task->text}}
            </span>
            <div class="task-card__btn-container">
                <form action="{{route('changeStatus')}}" class="task-card__form">
                    <button class="task-card__action" name="MarkAsDone" id="{{$task->id}}">Mark as done</button>
                </form>
                <form class="task-card__delete-form" action="{{route('deleteTask', $task->id)}}" METHOD="POST">
                    @method("DELETE")
                    @csrf
                    <button class="task-card__delete task-card_button__delete" name="DeleteTheTask">Delete the task</button>
                </form>
            </div>
        </div>
    </div>

@endsection
