@extends('layouts.app-side')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

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
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($menu as $menus)
          <tr>
            <td class="counterCell"></td>
            <td>{{ $menus->name }}</td>
            <td>{{ $menus->price }}</td>
            <td>
              <a href="#" class="btn btn-xs btn-default btn-modal" data-toggle="modal" data-id="{{ $menus->id }}" data-description="{{ $menus->description }}" data-name="{{ $menus->name }}" data-price="{{ $menus->price }}" data-pic="{{ $menus->foodPic }}" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add to Order</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Food Description</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-4">
            <img id="pic" src="/uploads/foods/default.png" alt="menu" class="img-responsive">
          </div>
          <div class="col-xs-8">
            <h3 class="menuName"></h3>
            <p class="menuDesc"></p>
            <h4 class="menuPrice"></h4>

            <form action="/cart/store">
              <input type="text" name="menuId" class="menuId" hidden>
              <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                  <label for="quantity" class="col-xs-6 col-md-3 control-label">Quantity</label>

                  <div class="col-xs-6 col-md-4">
                      <input id="quantity" type="number" min="1" class="form-control" name="quantity" value="1" required autofocus>

                      @if ($errors->has('quantity'))
                          <span class="help-block">
                              <strong>{{ $errors->first('quantity') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
              <input id="addCartBtn" type="submit" value="Submit" hidden>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('addCartBtn').click()">Add to Cart</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).on("click", ".btn-modal", function () {
     var myMenuId = $(this).data('id');
     var myMenuName = $(this).data('name');
     var myMenuDesc = $(this).data('description');
     var myMenuPrice = $(this).data('price');
     var myMenuPic = $(this).data('pic');
     $(".modal-body .menuName").text( myMenuName );
     $(".modal-body .menuDesc").text( myMenuDesc );
     $(".modal-body .menuPrice").text("Rp. " + myMenuPrice +",00" );
     $(".modal-body .menuPic").text( myMenuPic );
     $("#pic").attr('src', '/uploads/foods/'+myMenuPic);
     $(".modal-body .menuId").val( myMenuId );
  });
</script>

@endsection
