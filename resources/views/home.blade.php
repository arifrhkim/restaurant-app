@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="col-md-2 col-md-offset-1">
        @include('includes.sidebar')
      </div>

        <div class="col-md-8">

          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome {{ Auth::user()->name }}, You are logged in as {{ Auth::user()->roles }} !
                </div>
            </div>

            <!-- <form class="form-inline" action="{{ url('query') }}" method="GET">
              <div class="form-group">
                <input type="text" class="validate form-control" name="q" placeholder="Search" value="">
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form> -->

            <!-- @if (count($user)) -->

            <!-- <div class="panel panel-default">
              <div class="panel-heading">
                User list
                <a class="btn btn-default btn-xs pull-right" href="/user/create"><i class="fa fa-plus" aria-hidden="true"></i> Add user</a>
              </div> -->

              <!-- <div class="panel-body"></div> -->

                  <!-- <table class="table table-bordered">
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
            </div> -->

            <!-- @else -->
               <!-- <div class="panel panel-default">
                 <div class="panel-body">
                   Search result for '<b>{{$query}}</b>' not found.
                  </div>
               </div> -->
            <!-- @endif -->

        </div>
    </div>
</div>
@endsection
