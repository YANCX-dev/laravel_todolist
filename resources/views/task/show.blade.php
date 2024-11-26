@extends('layouts.app')


@section('content')

    <div class="task-card">
        <p class="task-card__status">{{$task->status->status}}</p>
        <p class="task-card__description">{{$task->text}}</p>
        <p class="task-card__date">{{$task->created_at}}</p>
        <div class="task-card__btn-container">
            <form action="{{route('changeStatus')}}" class="task-card__form">
                <button class="task-card__action" name="MarkAsDone" id="{{$task->id}}">Mark as done</button>
            </form>
            <form class="task-card__delete-form">
                @method("DELETE")
                <button class="task-card__delete delete-button" name="DeleteTheTask" data-id="{{$task->id}}" data-csrf="{{csrf_token()}}">Delete the task</button>
            </form>
        </div>
    </div>

@endsection
