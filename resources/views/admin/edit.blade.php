@extends('layouts.app-side')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit information</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="/user/{{$users->id}}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $users->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 control-label">Username</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" value="{{ $users->username }}" required autofocus>

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
                    <input id="email" type="email" class="form-control" name="email" value="{{ $users->email }}" required>

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
                    <select class="form-control" name="roles">
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
                    <input type="hidden" name="_method" value="PUT">
                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                        <!-- Update -->
                    <!-- </input> -->
                </div>
            </div>


        </form>

    </div>
</div>
@endsection
