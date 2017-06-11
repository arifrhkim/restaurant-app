<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Food;

class SearchController extends Controller
{

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('auth');
      }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function search(Request $request)
      {
          $query = $request->get('q');
          $user = User::where('name', 'LIKE', '%' . $query . '%')
          ->orwhere('username', 'LIKE', '%' . $query . '%')
          ->orwhere('email', 'LIKE', '%' . $query . '%')
          ->orwhere('roles', 'LIKE', '%' . $query . '%')
          ->paginate(10);
          return view('home', compact('user', 'query'));
      }

      public function food(Request $request)
      {
          $query = $request->get('q');
          $food = Food::where('name', 'LIKE', '%' . $query . '%')
          ->orwhere('status', 'LIKE', '%' . $query . '%')
          ->paginate(10);
          return view('food.index', compact('food', 'query'));
      }
}
