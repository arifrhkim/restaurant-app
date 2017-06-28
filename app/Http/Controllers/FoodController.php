<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use App\Models\Food;

class FoodController extends Controller
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
        $foods=Food::paginate(10);
        return view('food/index', ['food'=>$foods]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required',
        'price' => 'required',
        'status' => 'required',
      ]);

      Food::create([
          'name' => $request['name'],
          'price' => $request['price'],
          'status' => $request['status'],
      ]);
      return redirect('food');
    }

    public function show($id)
    {
      $foods=Food::find($id);
      if (!$foods) {
        abort(404);
      }
      return view ('food/single', ['foods'=>$foods]);
    }

    public function edit($id)
    {
      $foods=Food::find($id);
      return view ('food/edit', ['foods'=>$foods]);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name' => 'required',
        'price' => 'required',
        'status' => 'required',
      ]);

      $foods = Food::find($id);
      $foods->name = $request->name;
      $foods->price = $request->price;
      $foods->status = $request->status;
      $foods->save();
      return redirect('food');
    }

    public function destroy($id)
    {
      Food::find($id)->delete();
      return redirect('food');
    }
}
