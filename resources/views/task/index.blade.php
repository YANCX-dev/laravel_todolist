@extends('layouts.app')

@section('content')
<main class="main">
    {{--        <header class="main__header">--}}
    {{--            <h1 class="main__title">Health & food diet</h1>--}}
    {{--            <div class="main__actions">--}}
    {{--                <input type="text" class="search-input" placeholder="Search Here">--}}
    {{--                <button class="add-task-button">+</button>--}}
    {{--            </div>--}}
    {{--        </header>--}}

    <!-- Task Categories -->
    {{--        <div class="categories">--}}
    {{--            <div class="category category--personal">--}}
    {{--                <h3 class="category__title">Personal</h3>--}}
    {{--                <ul class="category__list">--}}
    {{--                    <li>Fitness</li>--}}
    {{--                    <li class="category__active">Health & food diet</li>--}}
    {{--                    <li>Meetings</li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--            <div class="category category--learning">--}}
    {{--                <h3 class="category__title">Learning</h3>--}}
    {{--                <ul class="category__list">--}}
    {{--                    <li>Reading blogs</li>--}}
    {{--                    <li>Meetups</li>--}}
    {{--                    <li>Analysis design</li>--}}
    {{--                    <li>Design revisit</li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--            <div class="category category--project">--}}
    {{--                <h3 class="category__title">Project</h3>--}}
    {{--                <ul class="category__list">--}}
    {{--                    <li>Client Calls</li>--}}
    {{--                    <li>Pending Works</li>--}}
    {{--                    <li>Completed Works</li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        </div>--}}

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
                <a href="{{route('taskShow', $task->id)}}" class="task-link">
                <div class="task-card task-card--{{strtolower($task->status->status)}}">
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
                </a>
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
