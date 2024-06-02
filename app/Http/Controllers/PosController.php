<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\TableManagement;

class PosController extends Controller
{
    public function ouletDashboard()
    {
        return view('pos.dashboard');
    }
    public function OrderTable()
    {
        $tablesArray = TableManagement::all();
        return view('pos.order_table', compact(['tablesArray']));
    }
}
