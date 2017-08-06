@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="col-md-2 col-md-offset-1">
        @include('includes.sidebar')
      </div>

        <div class="col-md-8">

          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

            <!-- <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome {{ Auth::user()->name }}, You are logged in as {{ Auth::user()->roles }} !
                </div>
            </div> -->

            @if (Auth::user()->roles == 'Waitress')
              @include('home.waitress')
            @endif

            @if (Auth::user()->roles == 'Chef')
              @include('home.chef')
            @endif

            @if (Auth::user()->roles == 'Admin')
              @include('home.admin')
            @endif

            @if (Auth::user()->roles == 'User')
              @include('home.user')
            @endif

            @if (Auth::user()->roles == 'Cashier')
              @include('home.cashier')
            @endif

        </div>
    </div>
</div>
@endsection
