<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Cart;
use App\Models\Order;
use App\Models\detailOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MenuController extends Controller
{
    //
    public function indexMenu ()
    {
      $menu = Food::where('status', 'Available')->get();
      return view('/menu/index', ['menu' => $menu]);
    }

    public function storeCart (Request $request)
    {
      Cart::create([
          'orderBy' => Auth::user()->id,
          'foodID' => $request['menuId'],
          'quantity' => $request['quantity'],
      ]);

      return redirect('menu')->with('status', 'Success! Added to  cart.');
    }

    public function indexCart ()
    {
      $cart = DB::table('foods')
        ->join('carts', 'foods.id', '=', 'carts.foodID')
        ->where('orderBy', Auth::user()->id )
        ->get();
      return view('/cart/index', ['cart' => $cart]);
    }

    public function destroyCart ($id)
    {
      Cart::find($id)->delete();
      return redirect('cart')->with('status', 'Deleted!');
    }

    public function removeCart ()
    {
      Cart::where('orderBy', Auth::user()->id)->delete();
      return redirect('cart')->with('status', 'Cart is empty!');
    }

    public function storeOrder (Request $request)
    {
      $this->validate($request, [
        'nameOrder' => 'required',
        'tableID' => 'required',
        'customerID' => 'required',
      ]);

      $order = Order::create([
          'nameOrder' => $request['nameOrder'],
          'tableID' => $request['tableID'],
          'customerID' => $request['customerID'],
      ]);

      $insertedId = $order->id;
      // dd($insertedId);

      $carts = DB::table('foods')
        ->join('carts', 'foods.id', '=', 'carts.foodID')
        ->where('orderBy', Auth::user()->id )
        ->get()->toArray();

      foreach ($carts as $cart) {
        DB::table('detailorders')->insert([
          'orderID' => $insertedId,
          'foodID' => $cart->foodID,
          'orderBy' => $cart->orderBy,
          'quantity' => $cart->quantity,
          'subtotal' => $cart->price*$cart->quantity,
          'created_at'=> date('Y-m-d H:i:s'),
          'updated_at'=> date('Y-m-d H:i:s')
        ]);
      }

      Cart::where('orderBy', Auth::user()->id)->delete();

      return redirect('order')->with('status', 'Success!');
    }

    public function orderShow ()
    {
      $orders = DB::table('orders')
        ->where('customerID', Auth::user()->id)
        ->paginate(10);

      return view('/menu/order', ['orders' => $orders]);
    }

    public function showDetail ($id)
    {
      $details = DB::table('detailorders')
        ->where([
          ['orderID', '=', $id],
          ['orderBy', '=', Auth::user()->id],
        ])
        ->get();

        return view('/menu/detail', ['details' => $details]);
    }

}
