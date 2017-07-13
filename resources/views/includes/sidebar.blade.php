<div class="panel panel-default hidden-xs hidden-sm">
    <ul class="nav nav-stacked ">
      <li role="presentation"><a href="/home">Home</a></li>
      @if (Auth::user()->roles== 'Admin')
        <li role="presentation"><a href="/user">User</a></li>
        <li role="presentation"><a href="/food">Food</a></li>
        <li role="presentation"><a href="/order">Order</a></li>
      @elseif (Auth::user()->roles== 'Cashier' or Auth::user()->roles== 'Waitress')
        <li role="presentation"><a href="/food">Food</a></li>
        <li role="presentation"><a href="/order">Order</a></li>
        <li role="presentation"><a href="/customers">Customers</a></li>
      @elseif (Auth::user()->roles== 'Chef')
        <li role="presentation"><a href="/food">Food</a></li>
        <li role="presentation"><a href="/order">Order</a></li>
      @elseif (Auth::user()->roles== 'User')
        <li role="presentation"><a href="/order">Order</a></li>
      @endif
      <li role="presentation"><a href="/menu">Menu</a></li>
      <li role="presentation"><a href="/cart">Cart
        <span class="label label-primary pull-right">
          {{ DB::table('carts')
          ->join('foods', 'carts.foodID', '=', 'foods.id')
          ->where('orderBy', Auth::user()->id )
          ->count() }}
        </span></a>
      </li>
      <!-- <li role="presentation"><a href="/order/user">Order Customer</a></li> -->
      <li role="presentation"><a href="/user/{{Auth::user()->id}}/show">Setting</a></li>
    </ul>

</div>
