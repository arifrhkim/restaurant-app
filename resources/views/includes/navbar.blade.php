<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav hidden-md hidden-lg">
                <!-- &nbsp; -->
                @if (Auth::check())
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
                  @else
                  <li>error</li>
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
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="avatar-top">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/home">Home</a></li>
                            <li><a href="/user/{{Auth::user()->id}}/show">Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
