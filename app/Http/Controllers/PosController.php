<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function Dashboard()
    {
        return view('pos.dashboard');
    }
    public function OrderTable()
    {
        return view('pos.order_table');
    }
}
