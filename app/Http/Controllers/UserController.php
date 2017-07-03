<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

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
      $users=User::paginate(10);
      return view('admin/index', ['user'=>$users]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|max:255',
        'username' => 'required|min:6|max:25|unique:users',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'roles' => 'required',
      ]);

      User::create([
          'name' => $request['name'],
          'username' => $request['username'],
          'email' => $request['email'],
          'password' => bcrypt($request['password']),
          'roles' => $request['roles'],
      ]);
      return redirect('home');
    }

    public function show($id)
    {
      $users=User::find($id);
      if (!$users) {
        abort(404);
      }
      // return view('admin/single', array('user' => Auth::user()) );
      return view ('admin/single', ['users'=>$users]);
    }

    public function edit($id)
    {
      $users=User::find($id);
      return view ('admin/edit', ['users'=>$users]);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name' => 'required|max:255',
        'username' => 'required|min:6|max:25|unique:users,id,'.$request->get('id'),
        'email' => 'required|email|max:255|unique:users,id,'.$request->get('id'),
        'roles' => 'required',
      ]);

      $users = User::find($id);
      $users->name = $request->name;
      $users->username = $request->username;
      $users->email = $request->email;
      $users->roles = $request->roles;
      $users->update();
      return redirect('home');
    }

    public function destroy($id)
    {
      User::find($id)->delete();
      return redirect('user');
    }

    public function customers()
    {
      $users=User::where('roles', 'User')->paginate(10);
      return view('admin/customers', ['user'=>$users]);
    }

    public function updatePassword(Request $request)
    {
        // return dd($request->current_password);

        // Check current password
        if (!\Hash::check($request->input('current_password'), Auth::user()->password))
        {
            $error = array('current-password' => trans('Password is different'));
            return redirect()->back()->withErrors($error)->withInput();
        }

        $this->validate($request, [
          'password' => 'required|min:6|confirmed',
        ]);

        // Save new password
        $request->user()->fill([
            'password' => \Hash::make($request->input('password'))
        ])->save();

        return redirect()->action('UserController@show', ['id' => Auth::user()->id])
        ->with('status', 'Password changed!');
    }

    public function showProfile($id)
    {
      $users=User::find($id);
      if (!$users) {
        abort(404);
      }
      return view ('admin/profile', ['users'=>$users]);
    }

    public function updateAvatar(Request $request){

    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view ('admin/single', ['users'=>$user]);

    }

}
