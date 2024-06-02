<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_role = Auth::user()->user_type;
        if ($user_role == ADMIN_ROLE) {
            return redirect('admin/dashboard');
        } elseif( $user_role == WAITER || $user_role == MANAGER) {
            return redirect('oulet/dashboard');
        }
        else {
            return abort(404);
        }
    }
}
