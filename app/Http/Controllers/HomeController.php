<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks=Feedback::join('users', 'users.id', '=', 'feedbacks.customerID')
          ->paginate(10);

        $orders=DB::table('users')
          ->join('orders', 'orders.customerID', '=', 'users.id')
          ->where([
            ['orders.status', '=', 'Waiting'],
            ['orders.deleted_at', '=', null],
          ])
          ->paginate(10);

        $cookeds = DB::table('foods')
          ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
          ->join('orders', 'detailorders.orderID', '=', 'orders.id')
          ->where([
            ['detailorders.status', '=', 'Cooked'],
            ['detailorders.deleted_at', '=', null],
          ])->select('detailorders.*', 'foods.name as name', 'orders.tableID as tableID')
          ->paginate(10);

        $process = DB::table('foods')
          ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
          ->join('orders', 'detailorders.orderID', '=', 'orders.id')
          ->where([
            ['detailorders.status', '=', 'Process'],
            ['detailorders.deleted_at', '=', null],
          ])->select('detailorders.*', 'foods.name as name', 'orders.tableID as tableID')
          ->paginate(10);

        $queueds = DB::table('foods')
          ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
          ->join('orders', 'detailorders.orderID', '=', 'orders.id')
          ->where([
            ['detailorders.status', '=', 'Queued'],
            ['detailorders.deleted_at', '=', null],
          ])->select('detailorders.*', 'foods.name as name', 'orders.tableID as tableID')
          ->paginate(10);

        return view('home', ['feedbacks'=>$feedbacks, 'orders'=>$orders, 'process'=>$process, 'queueds'=>$queueds, 'cookeds'=>$cookeds ]);
    }

    public function test () {

      if (Auth::user()->roles== 'Waitress') {
        $q = DB::table('users')
          ->join('orders', 'orders.customerID', '=', 'users.id')
          ->where([
            ['orders.status', '=', 'Waiting'],
            ['orders.deleted_at', '=', null],
          ])->count();
      } elseif (Auth::user()->roles== 'Chef') {
        // $q = DB::table('users')
        //   ->join('orders', 'orders.customerID', '=', 'users.id')
        //   ->where([
        //     ['orders.status', '=', 'Queued'],
        //     ['orders.deleted_at', '=', null],
        //   ])->count();
        $q = DB::table('foods')
          ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
          ->where([
            ['detailorders.status', '=', 'Queued'],
            ['detailorders.deleted_at', '=', null],
          ])
          ->count();
      }

        return $q;
    }

    public function testcooked () {

        $c =  DB::table('foods')
            ->join('detailorders', 'foods.id', '=', 'detailorders.foodID')
            ->where([
              ['detailorders.status', '=', 'Cooked'],
              ['detailorders.deleted_at', '=', null],
            ])->count();

        return $c;
    }

}
