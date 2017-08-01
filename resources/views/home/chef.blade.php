<div class="panel panel-default">
  <div class="panel-heading">
    Process list
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
      @foreach($process as $proces)
      <tr>
        <td class="counterCell"></td>
        <td>{{ $proces->name }}</td>
        <td>{{ $proces->quantity }}</td>
        <td>{{ $proces->tableID }}</td>
        <td><a href="/order/{{$proces->id}}/statusDetail" class="btn btn-warning btn-xs">{{ $proces->status }}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="pull-right">
  {{ $process->links() }}
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    Queued list
  </div>

  <table class="table table-bordered table-hover table-condensed">
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
      @foreach($queueds as $queued)
      <tr>
        <td class="counterCell"></td>
        <td>{{ $queued->name }}</td>
        <td>{{ $queued->quantity }}</td>
        <td>{{ $queued->tableID }}</td>
        <td><a href="/order/{{$queued->id}}/statusDetail" class="btn btn-info btn-xs">{{ $queued->status }}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>

<div class="pull-right">
  {{ $process->links() }}
</div>
