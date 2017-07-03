@extends('layouts.app-side')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="form-inline" action="{{ url('query') }}" method="GET">
  <div class="form-group pull-right">
    <input type="text" class="validate form-control" name="q" placeholder="Search" value="">
    <button type="submit" class="btn btn-default">Search</button>
  </div>
  <a class="btn btn-default" href="/user/create"><i class="fa fa-plus" aria-hidden="true"></i> Add user</a>
</form> <br>

@if (count($user))

<div class="panel panel-default">
  <div class="panel-heading">
    User list
  </div>

      <table class="table table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user as $users)
          <!-- <tr onclick="document.location = '/user/{{ $users->id }}/show';" style="cursor: pointer;"> -->
          <tr>
            <td class="counterCell"></td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->username }}</td>
            <td>{{ $users->email }}</td>
            <td>{{ $users->roles }}</td>
            <td>
              <a href="user/{{ $users->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              <a href="user/{{ $users->id }}/edit" class="btn btn-xs btn-info"><i class="fa fa-wrench" aria-hidden="true"></i></a>
              <a href="user/{{ $users->id }}/delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<div class="pull-right">
  {{ $user->links() }}
</div>

@else
   <div class="panel panel-default">
     <div class="panel-body">
       Search result for '<b>{{$query}}</b>' not found.
      </div>
   </div>
@endif


@endsection
