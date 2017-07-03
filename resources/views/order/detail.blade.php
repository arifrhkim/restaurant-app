@extends('layouts.app-side')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Add order</div>
  <div class="panel-body">

  <form class="form-horizontal" >

    <div class="form-group">
      <label for="orderID" class="col-md-4 control-label">Order ID</label>
      <div class="col-md-6">
          <input id="orderID" type="text" class="form-control" name="orderID" value="{{ $order->orderID }}" required autofocus readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="orderID" class="col-md-4 control-label">Table</label>
      <div class="col-md-6">
          <input id="tableID" type="text" class="form-control" name="tableID" value="{{ $order->tableID }}" required autofocus readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="orderID" class="col-md-4 control-label">Customer</label>
      <div class="col-md-6">
          <input id="customerID" type="text" class="form-control" name="customerID" value="{{ $order->customerID }}" required autofocus readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="orderID" class="col-md-4 control-label">Detail Order</label>
      <div class="col-md-6">
          <input id="detailOrderID" type="text" class="form-control" name="detailOrderID" value="{{ $order->detailOrderID }}" required autofocus readonly>
      </div>
    </div>

  </form>

  </div>
</div>



<div class="panel panel-default">
  <div class="panel-heading">
    Food list
  </div>


      <table class="table table-bordered table-hover table-condensed" id="orderTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th class="col-xs-1">Quantity</th>
            <th>Sub-total</th>
          </tr>
        </thead>

        <form class="form-horizontal" method="post"  action="/order/resume">

        <tbody>
          @foreach($food as $foods)
          <tr>
            <td class="counterCell"></td>
            <td>{{ $foods->name }}</td>
            <td class="price">{{ $foods->price }}</td>
            <td><input type="number" class="quantity" min="0" /></td>
            <td class="amount"></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" align="right">TOTAL</td>
            <td id="total" class="total"></td>
          </tr>
        </tfoot>
      </table>

</div>

<button type="submit" class="btn btn-primary pull-right">
    Add
</button>

</form>



<script type="text/javascript">
$(document).ready(function(){
    update_amounts();
    $('.quantity').change(function() {
        update_amounts();
    });
});
function update_amounts()
{
    var sum = 0;
    $('#orderTable > tbody  > tr').each(function() {
        var price = $(this).find('.price').text();
        var qty = $(this).find('.quantity').val();
        var amount = (qty*price);
        sum+=amount;
        $(this).find('.amount').text(''+amount);
    });
     $("#total").text(sum);
}
</script>

@endsection
