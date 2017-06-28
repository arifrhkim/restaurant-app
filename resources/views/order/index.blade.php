@extends('layouts.app-side')

@section('content')

<form>
  <a class="btn btn-default" href="/order/create"><i class="fa fa-plus" aria-hidden="true"></i> Add order</a>
</form>
<br>

@if (Auth::user()->roles != 'User' and count($orders))
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
            <th>Order By</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td class="counterCell"></td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->tableID }}</td>
            <td>{{ $order->name }}
              @if ($order->roles!='User')
              ({{ $order->roles }})
              @endif
            </td>
            <td>{{ $order->total }}</td>
            <td><a href="#" class="btn btn-warning btn-xs">{{ $order->status }}</a></td>
            <td>
              <a href="/order/{{ $order->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              <a href="/order/{{ $order->id }}/edit" class="btn btn-xs btn-info"><i class="fa fa-wrench" aria-hidden="true"></i></a>
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
@endif


@endsection
