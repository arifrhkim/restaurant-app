<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\detailOrder;
use App\Models\Food;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

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
        if (Auth::user()->roles=='User') {
          $orders=DB::table('users')
            ->join('orders', 'orders.customerID', '=', 'users.id')
            ->where([
                  ['customerID', '=', Auth::user()->id],
                  ['orders.deleted_at', '=', null ],
              ])
            ->paginate(10);
            return view('/order/user', ['orders'=>$orders]);
        } else {
          $orders=DB::table('users')
            ->join('orders', 'orders.customerID', '=', 'users.id')
            ->where('orders.deleted_at', '=', null )
            ->paginate(10);
            return view('/order/index', ['orders'=>$orders]);
        }
    }

    public function status($id)
    {
        $order = Order::find($id);
        switch ($order->status) {
          case 'Queued':
            $order->status = 'Process';
            break;

          case 'Process':
            $order->status = 'Served';
            break;

          case 'Served':
            $order->status = 'Done';
            break;

          case 'Done':
            // dd('Statusnya sudah Done');
            break;

          default:
            // dd('Statusnya sudah Done');
            break;
        }
        $order->save();

        return redirect('/order')->with('status', 'Success!');
    }

    public function statusDetail($id)
    {
        $order = detailorder::find($id);
        switch ($order->status) {
          case 'Queued':
            $order->status = 'Process';
            break;

          case 'Process':
            $order->status = 'Served';
            break;

          case 'Served':
            $order->status = 'Done';
            break;

          case 'Done':
            // dd('Statusnya sudah Done');
            break;

          default:
            // dd('Statusnya sudah Done');
            break;
        }
        $order->save();

        return back()->with('status', 'Success!');
    }

    public function show ($id)
    {
      $details = DB::table('foods')
        ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
        ->where([
          ['orderID', '=', $id],
          // ['orderBy', '=', Auth::user()->id],
          ['detailorders.deleted_at', '=', null],
        ])
        ->get();
        $order = Order::find($id);
        // dd($details);
        if (Auth::user()->roles!='User') {
          return view('/order/detail', ['details' => $details, 'order' => $order]);
        } else {
          return view('/order/userdetail', ['details' => $details, 'order' => $order]);
        }
    }

    public function destroy($id)
    {
      Order::find($id)->delete();
      return redirect('order')->with('status', 'Deleted!');
    }

    public function destroyDtl($id)
    {
      detailOrder::find($id)->delete();
      return back()->with('status', 'Deleted!');
    }

    public function getPDF ($id)
    {
      // dd($id);
      $details = DB::table('foods')
        ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
        ->where([
          ['orderID', '=', $id],
          ['orderBy', '=', Auth::user()->id],
          ['detailorders.deleted_at', '=', null],
        ])
        ->get();
      $order = Order::find($id);

      return view('order.pdf', ['details' => $details, 'order' => $order]);

      // $pdf = PDF::loadView('order.pdf', ['details' => $details, 'order' => $order]);
      // return $pdf->stream();
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        if ($order->status == 'Queued') {
            $order->status = 'Canceled';
        } else {
          dd('Error');
        }
        $order->save();

        return back()->with('status', 'Success!');
    }

    public function cancelDtl($id)
    {
        $order = detailorder::find($id);
        if ($order->status == 'Queued') {
            $order->status = 'Canceled';
        } else {
          dd('Error');
        }
        $order->save();

        return back()->with('status', 'Success!');
    }

}
