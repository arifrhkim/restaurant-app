@extends('layouts.app-side')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">Detail information</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/$users->id') }}">
            {{ csrf_field() }}

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <img src="/uploads/avatars/{{ $users->avatar }}" alt="Avatar" class="img-thumbnail avatar">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <a class="btn btn-primary btn-sm" href="/user/{{$users->id}}/profile">Change photo</a>
              </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" value="{{ $users->name }}" required autofocus disabled>

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 control-label">Username</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" value="{{ $users->username }}" required autofocus disabled>

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $users->email }}" required disabled>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Roles</label>

                <div class="col-md-6">
                    <select class="form-control" name="roles" disabled>
                      <option value="{{ $users->roles }}">{{ $users->roles }}</option>
                      <option value="Admin">Admin</option>
                      <option value="Cashier">Cashier</option>
                      <option value="Chef">Chef</option>
                      <option value="Waitress">Waitress</option>
                      <option value="User">User</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <!-- <button type="submit" value="edit" class="btn btn-primary">
                        Register
                    </button> -->
                    <div class=" pull-right">
                      <a class="btn btn-primary" href="edit"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                      @if ( $users->id == Auth::user()->id)
                        <a class="btn btn-default" href="/user/{{$users->id}}/setting">Change password</a>
                      @else
                      <a class="btn btn-danger" href="delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                      @endif
                    </div>
                </div>
            </div>

            <input type="hidden" name="_method" value="PUT">

        </form>
    </div>
</div>
@endsection
