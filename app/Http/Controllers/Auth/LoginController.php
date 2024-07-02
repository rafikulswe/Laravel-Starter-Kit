<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:8'
        ]);
        $data = array(
            'email'          => $request->email,
            'password'       => $request->password
        );
        if (Auth::attempt($data)) {
            return redirect()->route('systemDestination');
        } else {
            return redirect()->route('login')->with('error', 'Email or password is not correct.');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function home()
    {
        $data['userInfo'] = Auth::user();
        // $data['userInfo'] = User::find($authId);
        return view('auth.home');
    }

    public function systemDestination()
    {
        return view('systemDestination');
    }
}
