@extends('layouts.app-side')

@section('content')

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
              @if ($order->status == 'Queued')
                <span class="label label-warning">{{ $order->status }}</span>
              @elseif ($order->status == 'Process')
                <span class="label label-info">{{ $order->status }}</span>
              @elseif ($order->status == 'Served')
                <span class="label label-primary">{{ $order->status }}</span>
              @elseif ($order->status == 'Done')
                <span class="label label-default">{{ $order->status }}</span>
              @else
                <p>tes</p>
              @endif
            </td>
            <td class="hidden-sm hidden-xs">{{ $order->created_at }}</td>
            <td>
              <a href="/order/{{ $order->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
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
