<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\User;


class UserController extends Controller
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

    public function index()
    {

    }

    public function create()
    {
      return view ('/admin/create');
    }

    public function store(Request $users)
    {
      User::create([
          'name' => $users['name'],
          'username' => $users['username'],
          'email' => $users['email'],
          'password' => bcrypt($users['password']),
          'roles' => $users['roles'],
      ]);
      return redirect('home');
    }

    public function cashier()
    {
      $users=User::where('roles', 'cashier')->get();
      return view ('admin/index', ['users'=>$users]);
    }

    public function show($id)
    {
      $users=User::find($id);
      if (!$users) {
        abort(404);
      }
      return view ('admin/single', ['users'=>$users]);
    }

    public function edit($id)
    {
      $users=User::find($id);
      return view ('admin/edit', ['users'=>$users]);
    }

    public function update(Request $request, $id)
    {
      $users = User::find($id);
      $users->name = $request->name;
      $users->username = $request->username;
      $users->email = $request->email;
      $users->roles = $request->roles;
      $users->save();
      return redirect('home');
    }

    public function destroy($id)
    {
      User::find($id)->delete();
      return redirect('home');
    }

}
