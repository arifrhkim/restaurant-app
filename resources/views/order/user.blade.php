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

      <table class="table table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Table</th>
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
            <td>{{ $order->id }}</td>
            <td>{{ $order->tableID }}</td>
            <td>{{ $order->nameOrder }}</td>
            <td>
              @if ($order->status == 'Waiting' or $order->status == 'Request')
                <span class="label label-default">{{ $order->status }}</span>
              @elseif ($order->status == 'Queued')
                <span class="label label-warning">{{ $order->status }}</span>
              @elseif ($order->status == 'Process')
                <span class="label label-info">{{ $order->status }}</span>
              @elseif ($order->status == 'Served')
                <span class="label label-primary">{{ $order->status }}</span>
              @elseif ($order->status == 'Done' or $order->status == 'Canceled')
                <span class="label label-default">{{ $order->status }}</span>
              @else
                <p>Error</p>
              @endif
            </td>
            <td class="hidden-sm hidden-xs">{{ $order->created_at }}</td>
            <td>
              <a href="/order/{{ $order->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              @if ( $order->status == 'Queued' )
              <a href="#" class="btn btn-xs btn-danger btn-modal" data-toggle="modal" data-id="{{ $order->id }}" data-target="#myModal">Cancel Order</a>
              @endif
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
        Are you sure you want to cancel?
        <form action="/order/cancel">
          <input type="text" name="id" class="id" hidden>
          <input id="delete" type="submit" value="Submit" hidden>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('delete').click()">Cancel Order</button>
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
