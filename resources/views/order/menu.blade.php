@extends('layouts.app-side')

@section('content')

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
        <td>{{ $cart }}</td>
        <td>harga</td>
        <td>2</td>
        <td>subtotal</td>
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

        <table class="table table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($food as $foods)
            <tr>
              <td class="counterCell"></td>
              <td>{{ $foods->name }}</td>
              <td>{{ $foods->price }}</td>
              <td>{{ $foods->status }}</td>
              <td>
                <a data-toggle="modal" href="#" class="btn btn-xs btn-success">
                  <i class="fa fa-info-circle" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">

  $(window).on('load',function(){
    $('#myModal').modal('show');
  });

</script>

@endsection
