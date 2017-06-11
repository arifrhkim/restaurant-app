@extends('layouts.app-side')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Casier List</div>

  <!-- <div class="panel-body"></div> -->

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $users)
          <tr>
            <td class="counterCell"></td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->username }}</td>
            <td>{{ $users->email }}</td>
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
@endsection
