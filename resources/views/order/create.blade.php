@extends('layouts.app-side')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">Add order</div>
  <div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="/order/store">

        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('tableID') ? ' has-error' : '' }}">
            <label for="tableID" class="col-md-4 control-label">Table</label>

            <div class="col-md-6">
                <input id="tableID" type="text" class="form-control" name="tableID" value="{{ old('tableID') }}" required autofocus>

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
                <!-- <button type="submit" class="btn btn-primary">
                    Add
                </button> -->
            </div>
        </div>
    </form>

  </div>
</div>

<form>
  <a class="btn btn-default" href="#" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-plus" aria-hidden="true"></i> Add order
  </a>
</form> <br>

<div class="panel panel-default">
  <div class="panel-heading">
    Order list
  </div>

      <table class="table table-bordered table-hover table-condensed" id="orderTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Food</th>
            <th>Price</th>
            <th class="col-xs-1">Quantity</th>
            <th>Sub-total</th>
            <th>Action</th>
          </tr>
        </thead>

        <form class="form-horizontal" method="post"  action="/order/resume">

        <tbody>
          @if (count($cart))
          @foreach ($cart as $cart)
          <tr>
            <td class="counterCell"></td>
            <td>{{ $cart->name }}</td>
            <td class="price">{{ $cart->price }}</td>
            <td class="quantity">{{ $cart->quantity }}</td>
            <td class="amount"></td>
            <td>
              <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
          @endif

        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" align="right">TOTAL</td>
            <td id="total" class="total"></td>
            <td></td>
          </tr>
        </tfoot>
      </table>

</div>

<form>
  <button class="btn btn-primary pull-right" href="#"> Confirm </button>
</form>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">

        <div class="panel panel-default">
          <div class="panel-heading">
            Food list
          </div>

              <table class="table table-bordered table-hover table-condensed">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($food as $foods)
                  <tr>
                    <td class="counterCell"></td>
                    <td>{{ $foods->name }}</td>
                    <td>{{ $foods->price }}</td>
                    <td>
                      <a href="#" class="btn btn-xs btn-default"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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
    $('#orderTable > tbody  > tr').each(function() {
        var price = $(this).find('.price').text();
        var qty = $(this).find('.quantity').text();
        var amount = (qty*price);
        sum+=amount;
        $(this).find('.amount').text(''+amount);
    });
     $("#total").text(sum);
}
</script>

@endsection
