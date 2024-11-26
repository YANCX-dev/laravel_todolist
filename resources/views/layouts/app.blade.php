<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{asset("css/styles.css")}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>

<body>

<div class="task-manager">
    <!-- Sidebar -->
    @include('inc.navbar')

    <!-- Main Content -->
   @yield('content')
</div>

</body>
<script src="{{asset('scripts/deleteTask.js')}}"></script>
<script src="{{asset('scripts/createTask.js')}}"></script>
</html>
