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

            @if (Auth::user()->roles != 'User')
            <div class="panel panel-default">
              <div class="panel-heading">
                Customers feedback
              </div>

                  <table class="table">
                    <tbody>
                      @foreach($feedbacks as $feedback)
                      <tr>
                        <td></td>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->feedback }}</td>
                        <td>{{ $feedback->created_at }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>

            <div class="pull-right">
              {{ $feedbacks->links() }}
            </div>
            @endif

            <div class="panel panel-default">
              <div class="panel-heading">Send feedback</div>
              <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/feedback/store">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('feedback') ? ' has-error' : '' }}">
                        <label for="feedback" class="col-md-4 control-label">Feedback</label>

                        <div class="col-md-6">
                            <textarea rows="3" id="feedback" type="text" class="form-control" name="feedback" value="{{ old('description') }}" required></textarea>

                            @if ($errors->has('feedback'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('feedback') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                        </div>
                    </div>
                </form>

              </div>
            </div>

        </div>
    </div>
</div>
@endsection
