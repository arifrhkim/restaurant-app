@extends('layouts.app-side')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Profile picture</div>
    <div class="panel-body">
      <div class="col-md-10 col-md-offset-1">
          <img src="/uploads/avatars/{{ $users->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
          <h2>{{ $users->name }}'s Profile</h2>
          <form enctype="multipart/form-data" action="/profile" method="POST">
              <label>Update Profile Image</label>
              <input type="file" name="avatar">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <br>
              <input type="submit" class="btn btn-primary">
          </form>
      </div>
    </div>
</div>


<div class="container">
    <div class="row">

    </div>
</div>
@endsection
