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
              @if ($order->status == 'Queued')
                <a href="/order/{{ $order->id }}/status" class="btn btn-warning btn-xs">{{ $order->status }}</a>
              @elseif ($order->status == 'Process')
                <a href="/order/{{ $order->id }}/status" class="btn btn-info btn-xs">{{ $order->status }}</a>
              @elseif ($order->status == 'Served')
                <a href="/order/{{ $order->id }}/status" class="btn btn-primary btn-xs">{{ $order->status }}</a>
              @elseif ($order->status == 'Done' or 'Canceled' )
                <span href="/order/{{ $order->id }}/status" class="label label-default">{{ $order->status }}</span>
              @else
                <p>Error</p>
              @endif
            </td>
            <td class="hidden-sm hidden-xs">{{ $order->created_at }}</td>
            <td>
              <a href="/order/{{ $order->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              <!-- <a href="/order/{{ $order->id }}/edit" class="btn btn-xs btn-info"><i class="fa fa-wrench" aria-hidden="true"></i></a> -->
              <a href="/order/{{ $order->id }}/delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<div class="pull-right">
  {{ $orders->links() }}
</div>

@endsection
