<div class="panel panel-default">
  <div class="panel-heading">Today's Promo</div>
  <div class="panel-body">
    <a href="/menu">
      <img src="/uploads/foods/promo.jpg" class="img-responsive" alt="Today's promo">
    </a>
  </div>
</div>

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
