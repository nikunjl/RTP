<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use Validator;

use Hash;

use Auth;

use DB;



class LoginController extends Controller

{

    public function index()
    {
        if (!empty(auth()->user()) && auth()->user()) {
            return redirect()->route('dashboard');
        }
        $title = 'RTP | Login';
        return view('admin.login', compact('title'));
    }



    public function dologin(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'email'   => 'required|email|unique:users,email',

            'password'   => 'required',

        ]);

        $user_data = User::where('email', $request->email)->first();

        $credentials = [

            'email' => $request->email,

            'password' => $request->password,

        ];



        if ($user_data != '') {

            if (!Hash::check($request->password, $user_data->password)) {

                return \Redirect::back()->with('error', 'Password not match');
            } else {
                if ($user_data->status == 1) {
                    Auth::login($user_data);
                    return redirect()->route('dashboard');
                } else {

                    return \Redirect::back()->with('error', 'Your Account was disable. please Contact Admin for support.');
                }
            }
        } else {

            return \Redirect::back()->with('error', 'Please enter valid login details.!');
        }
    }



    public function logout(Request $request)
    {

        Auth::logout();

        return redirect('/');
    }
}
