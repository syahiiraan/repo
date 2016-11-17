<!-- ni extend app.blade.php tadi, dia mcm ko include la, untuk guna  -->
@extends('layouts.app')

<!-- section ni tempat ko set component ko, kalau nak guna ni kat page yg
ko nak, paggil @yield('contect') -->
@section('content')
    <!-- Create Task Form... -->
    <div class="panel panel-default">
      <div class="panel-body">
      @include('common.errors')
      <!-- form akan di post ke route task -->
        <form action="{{url('task')}}" method="post" class="form-horizontal">
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Task</label>
            <div class="col-sm-6">
              <input type="text" name="name" class="form-control">
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
              <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
          </div>
          {{csrf_field()}}
        </form>
      </div>
    </div>

    <!-- ni dia check sama ada $tasks collection ada value atau x, kalau ada, proceed -->
    @if($tasks->count())
      <div class="panel panel-default">
        <div class="panel-heading">
          Current Task
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <th>Task</th>
              <th>&nbsp;</th>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
                <tr>
                  <td>{{ $task->name }}</td>
                  <td>
                     <form action="/task/{{ $task->id }}" method="POST">
                        {{ csrf_field() }}
                        <!-- ni mcm biasa la, kalau form kena ada token -->
                        {{ method_field('DELETE') }} 
                        <!-- ni untuk spoof method post ke method delete -->

                        <button type="submit" class="btn btn-danger">Delete Task</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif
@endsection
