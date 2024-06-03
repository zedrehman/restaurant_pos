<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\TableManagement;
use App\Models\Menu\MenuCatalogue;
use App\Models\Menu\MenuCategory;

class PosController extends Controller
{
    public function ouletDashboard()
    {
        return view('pos.dashboard');
    }

    public function OrderTable()
    {
        $tablesArray = TableManagement::all();
        $MenuCategory = MenuCategory::where('active', 1)->get();
        //dd($MenuCategory);
        return view('pos.order_table', compact(['tablesArray', 'MenuCategory']));
    }

    public function MenuListByCategoryId(Request $request, $CategoryId)
    {
        $MenuList = MenuCatalogue::where('menu_categories_id', $CategoryId)->get();
        return response()->json($MenuList, 200);
    }
}
