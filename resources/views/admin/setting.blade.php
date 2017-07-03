@extends('layouts.app-side')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit information</div>
    <div class="panel-body">

      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif

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
                  <a href="" data-toggle="modal" data-target="#myModal">Forgot password?</a>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Password reset request</h4>
      </div>
      <div class="modal-body">
        <p>You're going to reset your password. Are you sure? </p>
        <p>We will send password reset link to your email.</p>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}" hidden>
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" id="primaryButton">
                        Send Password Reset Link
                    </button>
                </div>
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="document.getElementById('primaryButton').click()">Send reset link</button>
      </div>
    </div>
  </div>
</div>

@endsection
