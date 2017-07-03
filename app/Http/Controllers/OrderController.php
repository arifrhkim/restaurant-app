<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\detailOrder;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    //
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=DB::table('users')
          ->join('orders', 'orders.customerID', '=', 'users.id')
          ->paginate(5);
        return view('/order/index', ['orders'=>$orders]);
    }

    public function create()
    {
        $foods=Food::where('status', 'Available')->get();
        $cart = DB::table('detailorders')
          ->join('foods', 'detailorders.foodID', '=', 'foods.id')
          ->paginate(5);
        return view('/order/create', ['food'=>$foods, 'cart' => $cart]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'tableID' => 'required',
        'customerID' => 'required',
      ]);

      dd($request);
    }

    public function show ($id)
    {
      dd($id);
    }

    // public function addCart($id)
    // {
    //   $foods=Food::where('status', 'Available')->paginate(10);
    //   $order = Food::find($id);
    //
    //   DB::table('detailorder')->insert([
    //     'foodID' => $order['id'],
    //     'orderID' => (Auth::user()->id),
    //     'quantity' => 1,
    //     'subtotal' => 1,
    //   ]);
    //
    //   // dd($id);
    //   $cart= DB::table('detailorder')->get();
    //
    //   return view('/order/index', ['food'=>$foods, 'cart' => $cart ]);
    // }

}
