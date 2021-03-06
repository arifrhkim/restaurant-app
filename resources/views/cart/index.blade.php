@extends('layouts.app-side')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    Cart list
  </div>

      <table class="table table-bordered table-hover table-condensed" id="cartTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Food</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub-total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cart as $carts)
          <tr>
            <td class="counterCell"></td>
            <td>{{ $carts->name }}</td>
            <td class="price">{{ $carts->price }}</td>
            <td class="quantity">{{ $carts->quantity }}
              <!-- <input type="number" class="quantity" name="quantity" min="0" value="{{ $carts->quantity }}" style="width:5em"> -->
            </td>
            <td class="subtotal"></td>
            <td>
              <a href="/cart/{{ $carts->id }}/delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" align="right">TOTAL</td>
            <td id="amount"></td>
            <td id="total" ></td>
            <td></td>
          </tr>
        </tfoot>
      </table>

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
                <input id="nameOrder" type="text" class="form-control" name="nameOrder" value="{{ old('nameOrder') }}" required autofocus>

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
                <input id="tableID" type="text" class="form-control" name="tableID" value="{{ old('tableID') }}" required>

                @if ($errors->has('tableID'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tableID') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <input id="customerID" name="customerID" value="{{ Auth::user()->id }}" hidden="true">
                <button type="submit" class="btn btn-primary">
                    Confirm
                </button>
            </div>
        </div>
    </form>
  </div>
</div>


<div class="pull-right">
  <a class="btn btn-danger" href="/cart/destroy">Empty cart</a>
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
        var price = $(this).find('.price').text();
        var qty = $(this).find('.quantity').text();
        var subtotal = (qty*price);
        sum+=subtotal;
        sums+=parseFloat(qty);
        $(this).find('.subtotal').text(''+subtotal);
    });
     $("#total").text(sum);
     $("#amount").text(sums);
}
</script>

@endsection
