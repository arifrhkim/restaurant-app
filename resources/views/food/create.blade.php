@extends('layouts.app-side')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Detail information</div>
  <div class="panel-body">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="/food/store">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>

            <div class="col-md-6">
                <textarea rows="3" id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus></textarea>

                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label for="price" class="col-md-4 control-label">Price</label>

            <div class="col-md-6">
                <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required >

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
                  <option value="Available">Available</option>
                  <option value="Not Available">Not Available</option>
                </select>
            </div>
        </div>

        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <input type="file" name="foodPic">
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
@endsection
