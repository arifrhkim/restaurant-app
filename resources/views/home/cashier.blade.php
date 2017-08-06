<div class="panel panel-default">
  <div class="panel-heading">
    Served list
  </div>

      <table class="table table-bordered table-hover table-condensed" id="response">
        <thead>
          <tr>
            <th>#</th>
            <th class="hidden-xs hidden-sm">Order ID</th>
            <th>Table</th>
            <th class="hidden-xs hidden-sm">Order By</th>
            <th>Status</th>
            <th class="hidden-sm hidden-xs">Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($serveds as $served)
          <tr>
            <td class="counterCell"></td>
            <td class="hidden-xs hidden-sm">{{ $served->id }}</td>
            <td>{{ $served->tableID }}</td>
            <td class="hidden-xs hidden-sm">{{ $served->name }}</td>
            <td>
                <a href="/order/{{ $served->id }}/status" class="btn btn-primary btn-xs">{{ $served->status }}</a>
            </td>
            <td class="hidden-sm hidden-xs">{{ $served->created_at }}</td>
            <td>
              <a href="/order/{{ $served->id }}/show" class="btn btn-xs btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              <a href="#" class="btn btn-xs btn-danger btn-modal" data-toggle="modal" data-id="{{ $served->id }}" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<div class="pull-right">
  {{ $serveds->links() }}
</div>
