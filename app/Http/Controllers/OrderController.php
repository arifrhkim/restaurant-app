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

    public function indeks()
    {
        $orders=DB::table('users')
          ->join('orders', 'orders.customerID', '=', 'users.id')
          ->where('orders.deleted_at', '=', null )
          ->paginate(10);
          return ['orders'=>$orders];
          // return dd($orders);
          // return view('/order/index', ['orders'=>$orders]);
    }

    public function status($id)
    {
        $order = Order::find($id);
        $detailorder = DB::table('detailorders')
          ->where([
            ['orderID', '=', $id],
            ['detailorders.deleted_at', '=', null],
          ]);

        switch ($order->status) {
          case 'Waiting':
            $detailorder->update(['status' => 'Queued']);
            $order->status = 'Queued';
            break;

          case 'Queued':
            $order->status = 'Process';
            break;

          case 'Process':
            $order->status = 'Served';
            break;

          case 'Served':
            $order->status = 'Done';
            break;

          case 'Request':
            $order->status = 'Canceled';
            break;

          case 'Done':
            // dd('Statusnya sudah Done');
            break;

          default:
            // dd('Statusnya sudah Done');
            break;
        }
        $order->save();

        // return redirect('/order')->with('status', 'Success!');
        return back()->with('status', 'Success!');
    }

    public function statusDetail($id)
    {
        $order = detailorder::find($id);
        $ordr = Order::find($order->orderID);

        switch ($order->status) {
          case 'Queued':
            $ordr->status = 'Process';
            $ordr->save();
            $order->status = 'Process';
            break;

          case 'Process':
            $order->status = 'Cooked';
            break;

          case 'Cooked':
            $order->status = 'Served';
            break;

          case 'Served':
            $order->status = 'Done';
            break;

          case 'Request':
            $order->status = 'Canceled';
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

    public function edit ($id)
    {
      $order = Order::find($id);

      return view('/order/editdetail', ['order' => $order]);
    }

    public function update (Request $request)
    {
      $this->validate($request, [
        'nameOrder' => 'required',
        'tableID' => 'required',
      ]);

      $order = Order::find($request->id);
      $order->nameOrder = $request->nameOrder;
      $order->tableID = $request->tableID;
      $order->save();

      return redirect('/home');
    }

    public function destroy(Request $request)
    {
      Order::find($request->id)->delete();
      return redirect('order')->with('status', 'Deleted!');
    }

    public function destroyDtl(Request $request)
    {
      detailOrder::find($request->id)->delete();
      return back()->with('status', 'Deleted!');
    }

    public function getPDF ($id)
    {
      // dd($id);
      if (Auth::user()->roles== 'User') {
        $details = DB::table('foods')
          ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
          ->where([
            ['orderID', '=', $id],
            ['detailorders.status', '=', 'Served'],
            ['orderBy', '=', Auth::user()->id ],
            ['detailorders.deleted_at', '=', null],
          ])
          ->get();
      } else {
        $details = DB::table('foods')
          ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
          ->where([
            ['orderID', '=', $id],
            ['detailorders.status', '=', 'Served'],
            // ['orderBy', '=', Auth::user()->id ],
            ['detailorders.deleted_at', '=', null],
          ])
          ->get();
          // dd($details);
      }

      $order = Order::find($id);
      // dd($details);
      return view('order.pdf', ['details' => $details, 'order' => $order]);

      // $pdf = PDF::loadView('order.pdf', ['details' => $details, 'order' => $order]);
      // return $pdf->stream();
    }

    public function cancel(Request $request)
    {
        $order = Order::find($request->id);
        if ($order->status == 'Queued') {
            $order->status = 'Request';
        } else {
          dd('Error');
        }
        $order->save();

        return back()->with('status', 'Success!');
    }

    public function cancelDtl(Request $request)
    {
        $order = detailorder::find($request->id);
        if ($order->status == 'Queued') {
            $order->status = 'Request';
        } else {
          dd('Error');
        }
        $order->save();

        return back()->with('status', 'Success!');
    }

}
