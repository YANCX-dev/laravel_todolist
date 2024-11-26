@extends('layouts.app')

@section('content')
    <main class="main">
        <form class="task-form" data-csrf="{{csrf_token()}}">
            <input type="text" name="taskText" class="task-form__input">
            <button type="submit" class="task-form__button">
                <p class="task-form__btn-text">Создать</p>
            </button>
        </form>

        <!-- Task Cards -->
        <section class="tasks">

            <div class="tabs">
                <button class="tab tab--active">All Todos</button>
                <button class="tab">Upcoming</button>
                <button class="tab">Completed</button>
                <button class="tab">Others</button>
            </div>
            <div class="task-cards">
                @foreach($tasks->ToDoTask() as $task)
                    {{--                <div class="task-card task-card--done">--}}
                    {{--                    <p class="task-card__status">DONE</p>--}}
                    {{--                    <p class="task-card__description">Add eggs & breads for preferably breakfast</p>--}}
                    {{--                    <p class="task-card__date">21 April, 2018 at 4:00am</p>--}}
                    {{--                    <button class="task-card__action">Mark as done</button>--}}
                    {{--                </div>--}}

                        <div class="task-card task-card--{{strtolower($task->status->status)}}">
                            <a href="{{route('taskShow', $task->id)}}" class="task-link">
                            <p class="task-card__status">{{$task->status->status}}</p>
                            <p class="task-card__description">{{$task->text}}</p>
                            <p class="task-card__date">{{$task->created_at}}</p>
                            </a>

                            <div class="task-card__btn-container">
                                <form action="{{route('changeStatus')}}" class="task-card__form">
                                    <button class="task-card__action" name="MarkAsDone" id="{{$task->id}}">Mark as done
                                    </button>
                                </form>
                                <form class="task-card__delete-form">
                                    @method("DELETE")
                                    <button class="task-card__delete delete-button" name="DeleteTheTask"
                                            data-id="{{$task->id}}" data-csrf="{{csrf_token()}}">Delete the task
                                    </button>
                                </form>
                            </div>
                        </div>

                    {{--                <div class="task-card task-card--doing">--}}
                    {{--                    <p class="task-card__status">DOING</p>--}}
                    {{--                    <p class="task-card__description">Try at least one new healthy recipe per week</p>--}}
                    {{--                    <p class="task-card__date">21 April, 2018 at 4:00am</p>--}}
                    {{--                    <button class="task-card__action">Mark as done</button>--}}
                    {{--                </div>--}}
                    {{--                <div class="task-card task-card--done">--}}
                    {{--                    <p class="task-card__status">DONE</p>--}}
                    {{--                    <p class="task-card__description">Eat your fruits instead of junk food</p>--}}
                    {{--                    <p class="task-card__date">21 April, 2018 at 4:00am</p>--}}
                    {{--                    <button class="task-card__action">Mark as done</button>--}}
                @endforeach
            </div>


        </section>
    </main>
@endsection
