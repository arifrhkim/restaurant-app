<div class="panel panel-default">
  <div class="panel-heading">
    Waiting list
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

<div class="panel panel-default">
  <div class="panel-heading">
    Cooked list
  </div>

  <table class="table table-bordered table-hover table-condensed" id="cartTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Food</th>
        <th>Quantity</th>
        <th>Table</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cookeds as $cooked)
      <tr>
        <td class="counterCell"></td>
        <td>{{ $cooked->name }}</td>
        <td>{{ $cooked->quantity }}</td>
        <td>{{ $cooked->tableID }}</td>
        <td><a href="/order/{{$cooked->id}}/statusDetail" class="btn btn-success btn-xs">{{ $cooked->status }}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="pull-right">
  {{ $cookeds->links() }}
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    Process list
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
          @foreach($ordersprocess as $orderprocess)
          <tr>
            <td class="counterCell"></td>
            <td class="hidden-xs hidden-sm">{{ $orderprocess->id }}</td>
            <td>{{ $orderprocess->tableID }}</td>
            <td class="hidden-xs hidden-sm">{{ $orderprocess->name }} ({{ $orderprocess->roles }})</td>
            <td>{{ $orderprocess->nameOrder }}</td>
            <td>
                <a href="/order/{{ $orderprocess->id }}/status" class="btn btn-info btn-xs">{{ $orderprocess->status }}</a>
            </td>
            <td class="hidden-sm hidden-xs">{{ $orderprocess->created_at }}</td>
            <td>
              <a href="/order/{{ $orderprocess->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              <a href="#" class="btn btn-xs btn-danger btn-modal" data-toggle="modal" data-id="{{ $orderprocess->id }}" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<div class="pull-right">
  {{ $ordersprocess->links() }}
</div>
