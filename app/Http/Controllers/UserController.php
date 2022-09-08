<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register()
    {
        return view('users.register');
    }

    public function signup()
    {
        return view('users.signup');
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'gender' => 'required',
            'phone' => 'required|min:10|max:10',
            'address' => 'required',
            'dob' => 'required',
        ]);

        $user = new Users();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->dob = $request->input('dob');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->route('user.signup');
    }

    public function login(Request $request)
    {

        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = Users::where('email', $email)->first();
        // select * from users where email = $email;

        if (!empty($user)) {

            if (Hash::check($password, $user->password)) {

                /// valid username and password
                //      return view('users.profile');

                //  session(['user_id'=> $user->id]);
                Session::put('user_id', $user->id);

                return redirect()->route('user.home');
            } else {
                return view('users.signup', [
                    'msg' => 'Invalid username and password.',
                ]);
            }
        } else {
            return view('users.signup', [
                'msg' => 'User does not exist.',
            ]);
        }
    }

    public function home()
    {
        $userId = Session::get('user_id');

        $user = Users::find($userId);

        //  User::where('id',$userId)->get();

        //select * from users where id = $userid

        return view('users.profile', ['user' => $user]);
    }

    public function logout(){
       Session::flush();//it destroy session
       return redirect()->route('user.signup');
    }

    public function passwordform(){

        return view('users.password_form');
    }

    public function resetpassword(Request $request){


     $userId= Session::get('user_id');
     $user =Users::find($userId);
      $request ->validate([
       'password' => 'required|min:8',
       'confirm_password' => 'same:password',
      ]);
      $user ->password = Hash::make($request->password);
      $user->save();
      return view('users.password_form', [
        'msg'=>'password changed successfully .','user.resetpassword'

      ]);

    



        //validate min length 6
        // password and cpassword must be same
        // update user password
        // show message after password update

    }
}
