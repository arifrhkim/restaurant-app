@extends('layouts.app-side')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="panel panel-default">
  <div class="panel-heading">
    Order list
  </div>

      <table class="table table-bordered table-hover table-condensed" id="response">
        <thead>
          <tr>
            <th>#</th>
            <th class="hidden-xs hidden-sm">Order ID</th>
            <th>Table</th>
            <th class="hidden-xs hidden-sm">Order By</th>
            <th>Order Name</th>
            <th>Status</th>
            <th class="hidden-sm hidden-xs">Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td class="counterCell"></td>
            <td class="hidden-xs hidden-sm">{{ $order->id }}</td>
            <td>{{ $order->tableID }}</td>
            <td class="hidden-xs hidden-sm">{{ $order->name }} ({{ $order->roles }})</td>
            <td>{{ $order->nameOrder }}</td>
            <td>
              @if ($order->status == 'Waiting' or $order->status == 'Request')
                <a href="/order/{{ $order->id }}/status" class="btn btn-default btn-xs">{{ $order->status }}</a>
              @elseif ($order->status == 'Queued')
                <a href="/order/{{ $order->id }}/status" class="btn btn-warning btn-xs">{{ $order->status }}</a>
              @elseif ($order->status == 'Process')
                <a href="/order/{{ $order->id }}/status" class="btn btn-info btn-xs">{{ $order->status }}</a>
              @elseif ($order->status == 'Served')
                <a href="/order/{{ $order->id }}/status" class="btn btn-primary btn-xs">{{ $order->status }}</a>
              @elseif ($order->status == 'Done' or $order->status == 'Canceled' )
                <span href="/order/{{ $order->id }}/status" class="label label-default">{{ $order->status }}</span>
              @else
                <p>Error</p>
              @endif
            </td>
            <td class="hidden-sm hidden-xs">{{ $order->created_at }}</td>
            <td>
              <a href="/order/{{ $order->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              <a href="#" class="btn btn-xs btn-danger btn-modal" data-toggle="modal" data-id="{{ $order->id }}" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<div class="pull-right">
  {{ $orders->links() }}
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
        <form action="order/delete">
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

  // var refreshId = setInterval(function() {
  // $('#response').load('{{ url('/orders') }}');
  // }, 1000);

  $(document).on("click", ".btn-modal", function () {
     var myMenuId = $(this).data('id');
     $(".modal-body .id").val( myMenuId );
  });


</script>

@endsection
