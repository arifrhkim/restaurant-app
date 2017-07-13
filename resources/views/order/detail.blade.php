@extends('layouts.app-side')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="form-group">
  <a href="/order" class="btn btn-default">Back</a>
  <form class="pull-right">
    <a href="/order/{{$order->id}}/print" class="btn btn-success" target="_blank">Print</a>
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
                <input id="customerID" name="customerID" value="{{ Auth::user()->id }}" hidden="true">
                <!-- <button type="submit" class="btn btn-primary">
                    Confirm
                </button> -->
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
          @if ($detail->status == 'Queued')
            <a href="/order/{{$detail->id}}/statusDetail" class="label label-warning">{{ $detail->status }}</a>
          @elseif ($detail->status == 'Process')
            <a href="/order/{{$detail->id}}/statusDetail" class="label label-info">{{ $detail->status }}</a>
          @elseif ($detail->status == 'Served')
            <a href="/order/{{$detail->id}}/statusDetail" class="label label-primary">{{ $detail->status }}</a>
          @elseif ($detail->status == 'Done')
            <span class="label label-default">{{ $detail->status }}</span>
          @else
            <p>Error</p>
          @endif
        </td>
        <td>{{ $detail->price }}</td>
        <td class="quantity">{{ $detail->quantity }}</td>
        <td class="subtotal">{{ $detail->subtotal }}</td>
        <td>
          <a href="/orderDtl/{{ $detail->id }}/delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<script type="text/javascript">
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
