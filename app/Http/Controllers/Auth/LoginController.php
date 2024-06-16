<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postUserLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/home');
        }
        return redirect()->back()->with("error", "User Name and password incorrect");
    }

    public function register()
    {
        if (isset(Auth::user()->id)) {
            return redirect('/home');
        } else {
            return view('auth.login');
        }
    }

    public function getUserLogin(Request $request)
    {
        if (isset(Auth::user()->id)) {
            return redirect('/home');
        } else {
            return view('auth.user_login');
        }
    }

    public function logout(Request $request)
    {
        $userType = Auth::user()->user_type;
        Auth::logout();
        session()->flush();
        $redirectUrl = url('/');
        if ($userType == ADMIN_ROLE) {
            $redirectUrl = url('/login');
        } elseif ($userType == WAITER || $userType  == MANAGER) {
            $redirectUrl = url('/outlet/login');
        }
        return redirect($redirectUrl);
    }

}
