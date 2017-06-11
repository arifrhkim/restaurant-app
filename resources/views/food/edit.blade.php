@extends('layouts.app-side')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Detail information</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="/food/{{$foods->id}}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $foods->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                <label for="price" class="col-md-4 control-label">Price</label>

                <div class="col-md-6">
                    <input id="price" type="number" class="form-control" name="price" value="{{ $foods->price }}" required autofocus>

                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Status</label>

                <div class="col-md-6">
                    <select class="form-control" name="status">
                      <option value="{{ $foods->status }}">{{ $foods->name }}</option>
                      <option value="Available">Available</option>
                      <option value="Not Available">Not Available</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="submit" name="submit" value="Update" class="btn btn-primary">
                </div>
            </div>

            <input type="hidden" name="_method" value="PUT">

        </form>

    </div>
</div>
@endsection
