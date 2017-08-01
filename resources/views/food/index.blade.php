@extends('layouts.app-side')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="form-inline" action="{{ url('query-food') }}" method="GET">
  <!-- <div class="form-group pull-right">
    <input type="text" class="validate form-control" name="q" placeholder="Search" value="{{ old('q') }}">
    <button type="submit" class="btn btn-default">Search</button>
  </div> -->
  <a class="btn btn-default" href="/food/create"><i class="fa fa-plus" aria-hidden="true"></i> Add food</a>
</form> <br>

@if (count($food))

<div class="panel panel-default">
  <div class="panel-heading">
    Food list
  </div>

  <!-- <div class="panel-body"></div> -->

      <table class="table table-bordered table-hover table-condensed">
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
              <a href="#" class="btn btn-xs btn-danger btn-modal" data-toggle="modal" data-id="{{ $foods->id }}" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<div class="pull-right">
  {{ $food->links() }}
</div>

@else
   <div class="panel panel-default">
     <div class="panel-body">
       Search result for '<b>{{$query}}</b>' not found.
      </div>
   </div>
@endif

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
        <form action="food/delete">
          <input type="text" name="id" class="id" hidden>
          <input id="delete" type="submit" value="Submit" hidden>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('delete').click()">Delete</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).on("click", ".btn-modal", function () {
     var myMenuId = $(this).data('id');
     $(".modal-body .id").val( myMenuId );
  });
</script>

@endsection
