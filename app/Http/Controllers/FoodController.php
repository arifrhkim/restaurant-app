<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use App\Models\Food;
use Image;
use Illuminate\Support\Facades\DB;


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
        'description' => 'required',
        'price' => 'required',
        'status' => 'required',
      ]);

      $food = Food::create([
          'name' => $request['name'],
          'description' => $request['description'],
          'price' => $request['price'],
          'status' => $request['status'],
          'foodPic' => $request['foodPic'],
      ]);

      $insertedId = $food->id;

      if($request->hasFile('foodPic')){
    		$foodPic = $request->file('foodPic');
    		$filename = time() . '.' . $foodPic->getClientOriginalExtension();
    		Image::make($foodPic)->resize(300, 300)->save( public_path('/uploads/foods/' . $filename ) );

    		$food2 = Food::find($insertedId);
    		$food2->foodPic = $filename;
        $food2->save();
    	}

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
        'description' => 'required',
        'price' => 'required',
        'status' => 'required',
      ]);

      $foods = Food::find($id);
      $foods->name = $request->name;
      $foods->description = $request->description;
      $foods->price = $request->price;
      $foods->status = $request->status;
      $foods->foodPic = $request->foodPic;
      $foods->save();

      $insertedId = $foods->id;

      if($request->hasFile('foodPic')){
    		$foodPic = $request->file('foodPic');
    		$filename = time() . '.' . $foodPic->getClientOriginalExtension();
    		Image::make($foodPic)->resize(300, 300)->save( public_path('/uploads/foods/' . $filename ) );

    		$food2 = Food::find($insertedId);
    		$food2->foodPic = $filename;
        $food2->save();
    	}

      return redirect('food');
    }

    public function destroy($id)
    {
      Food::find($id)->delete();
      return redirect('food');
    }
}
