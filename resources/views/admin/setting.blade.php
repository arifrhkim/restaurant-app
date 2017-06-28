@extends('layouts.app-side')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit information</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="/user/{{ Auth::user()->id }}/change">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Old Password</label>

                <div class="col-md-6">
                    <input id="current-password" type="password" class="form-control" name="current_password" required>

                    @if ($errors->has('current-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current-password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <a class="" href="#">Forgot password?</a>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">New Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
