<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assign Plan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-center flex-nowrap">
        <div class=" mx-2 p-2">
            @if(count($tasks) <= 0)
                <a href="{{route('assignTask')}}" class="btn btn-danger" >Make a Plan</a>
            @endif
        </div>
    </div>
    <br>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
        <tr>
            <th nowrap>Week</th>
            <th nowrap>Developer Name</th>
            <th nowrap>Tasks</th>
            <th nowrap>Total Time</th>
            <th nowrap>Rate</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $key => $task)
            <tr>
                <td>{{$task->week}}</td>
                <td>{{$task->developer->name}}</td>
                <td>{{$task->tasks}}</td>
                <td>{{$task->time}}</td>
                <td>{{round($task->time / ($task->developer->level * $task->developer->weekly_capacity), 2)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable( {
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
        } )
    });
</script>
</body>
</html>