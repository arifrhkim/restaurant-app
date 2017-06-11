@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="col-md-2">
        @include('includes.sidebar')
      </div>

        <div class="col-md-8 col-md-offset-1">

            <form class="form-inline" action="{{ url('query-food') }}" method="GET">
              <div class="form-group">
                <input type="text" class="validate form-control" name="q" placeholder="Search" value="">
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form>

            <div class="panel panel-default">
              <div class="panel-heading">
                Food list
                <a class="btn btn-default btn-xs pull-right" href="/food/create"><i class="fa fa-plus" aria-hidden="true"></i> Add menu</a>
              </div>

              <!-- <div class="panel-body"></div> -->

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($food as $foods)
                      <tr>
                        <td class="counterCell"></td>
                        <td>{{ $foods->name }}</td>
                        <td>{{ $foods->price }}</td>
                        <td>{{ $foods->status }}</td>
                        <td>
                          <a href="/food/{{ $foods->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                          <a href="/food/{{ $foods->id }}/edit" class="btn btn-xs btn-info"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                          <a href="/food/{{ $foods->id }}/delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

            </div>

            <div class="pull-right">
              {{ $food->links() }}
            </div>


        </div>
    </div>
</div>
@endsection
