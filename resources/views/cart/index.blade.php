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
              <a href="#" class="btn btn-xs btn-danger btn-modal" data-toggle="modal" data-id="{{ $carts->id }}" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                <input id="nameOrder" type="text" class="form-control" name="nameOrder" value="{{ Auth::user()->name }}" required autofocus>

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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
        <form action="/cart/delete">
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
