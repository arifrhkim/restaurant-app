<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="zwAl1w0bZeFnQRxI8eC9AFhqXrsDqfYs7Z0lnfJc">

    <title>Laravel</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- ETC -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken":"zwAl1w0bZeFnQRxI8eC9AFhqXrsDqfYs7Z0lnfJc"}    </script>
  </head>
  <!-- <body onload="window.print()"> -->
  <body>
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
                  <label for="tableID" class="col-md-4 control-label">Date</label>

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
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($details as $detail)
          <tr>
            <td class="counterCell"></td>
            <td>{{ $detail->name }}</td>
            <td>{{ $detail->price }}</td>
            <td class="quantity">{{ $detail->quantity }}</td>
            <td class="subtotal">{{ $detail->subtotal }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" align="right">TOTAL</td>
            <td id="amount"></td>
            <td id="total" ></td>
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

    $(function(){
        window.print();
        setTimeout(function () {
          window.close();
        }, 100);
    });

    </script>

  </body>
</html>
