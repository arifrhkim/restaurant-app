@extends('layouts.app-side')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="form-group">
  <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
  <form class="pull-right">
    @if (Auth::user()->roles == 'Chef')
    <a href="/order/{{$order->id}}/print" class="btn btn-success" target="_blank">Print</a>
    @endif
    @if ( $order->id =='Done')
    <a href="/order/{{$order->id}}/status" class="btn btn-warning">Done</a>
    @endif
  </form>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    Order information
  </div>
  <div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="/cart/storeOrder">

        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('nameOrder') ? ' has-error' : '' }}">
            <label for="nameOrder" class="col-md-4 control-label">Name Order</label>

            <div class="col-md-6">
                <input id="nameOrder" type="text" class="form-control" name="nameOrder" value="{{ $order->nameOrder }}" required disabled>

                @if ($errors->has('nameOrder'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nameOrder') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('tableID') ? ' has-error' : '' }}">
            <label for="tableID" class="col-md-4 control-label">Table</label>

            <div class="col-md-6">
                <input id="tableID" type="text" class="form-control" name="tableID" value="{{ $order->tableID }}" required disabled>

                @if ($errors->has('tableID'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tableID') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
            <label for="created_at" class="col-md-4 control-label">Date</label>

            <div class="col-md-6">
                <input id="created_at" type="text" class="form-control" name="created_at" value="{{ $order->created_at }}" required disabled>

                @if ($errors->has('created_at'))
                    <span class="help-block">
                        <strong>{{ $errors->first('created_at') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class=" pull-right">
                  <a class="btn btn-primary" href="/order/{{ $order->id }}/edit"><i class="fa fa-wrench" aria-hidden="true"></i> Edit</a>
                </div>
                <input id="customerID" name="customerID" value="{{ Auth::user()->id }}" hidden="true">
            </div>
        </div>
    </form>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    Detail Order list
  </div>

  <table class="table table-bordered table-hover table-condensed" id="cartTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Food</th>
        <th>Status</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $detail)
      <tr>
        <td class="counterCell"></td>
        <td>{{ $detail->name }}</td>
        <td>
          @if ($detail->status == 'Waiting')
            <span class="label label-default">{{ $detail->status }}</span>
          @elseif ($detail->status == 'Queued')
            <a href="/order/{{$detail->id}}/statusDetail" class="label label-warning">{{ $detail->status }}</a>
          @elseif ($detail->status == 'Request')
            <a href="/order/{{$detail->id}}/statusDetail" class="label label-default">{{ $detail->status }}</a>
          @elseif ($detail->status == 'Process')
            <a href="/order/{{$detail->id}}/statusDetail" class="label label-info">{{ $detail->status }}</a>
          @elseif ($detail->status == 'Cooked')
            <a href="/order/{{$detail->id}}/statusDetail" class="label label-success">{{ $detail->status }}</a>
          @elseif ($detail->status == 'Served')
            <span class="label label-primary">{{ $detail->status }}</span>
          @elseif ($detail->status == 'Canceled')
            <span class="label label-danger">{{ $detail->status }}</span>
          @else
            <p>Error</p>
          @endif
        </td>
        <td>{{ $detail->price }}</td>
        <td class="quantity">{{ $detail->quantity }}</td>
        <td class="subtotal">{{ $detail->subtotal }}</td>
        <td>
          <a href="#" class="btn btn-xs btn-danger btn-modal" data-toggle="modal" data-id="{{ $detail->id }}" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" align="right">TOTAL</td>
        <td id="amount"></td>
        <td id="total" ></td>
        <td></td>
      </tr>
    </tfoot>
  </table>

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
        <form action="/orderDtl/delete">
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

$(document).ready(function(){
    update_amounts();
    $('.quantity').change(function() {
        update_amounts();
    });
});
function update_amounts(){
    var sum = 0;
    var sums = 0;
    $('#cartTable > tbody  > tr').each(function() {
        var qty = $(this).find('.quantity').text();
        var subtotal = $(this).find('.subtotal').text();
        sum+=parseFloat(subtotal);
        sums+=parseFloat(qty);
    });
     $("#total").text(sum);
     $("#amount").text(sums);
}
</script>

@endsection
