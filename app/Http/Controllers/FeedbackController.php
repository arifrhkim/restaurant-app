<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FeedbackController extends Controller
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

    public function store(Request $request)
    {
      $this->validate($request, [
        'feedback' => 'required',
      ]);

      Feedback::create([
          'customerID' => Auth::user()->id,
          'feedback' => $request['feedback'],
      ]);

      return back()->with('status', 'Success!');
    }
}
