<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\IngrediantModel;
use App\Models\IngrediantStockModel;
use App\Models\UnitMasterModel;
use Illuminate\Support\Facades\DB;


class FoodSetupController extends Controller
{
    // Ingrediant
    public function Ingrediant()
    {
        $Query = "
            SELECT 
                i.*,
                o.outlet_name,
                u.unit_name,
                (select SUM(stock_value) FROM ingrediant_stock stock WHERE stock.outlet_id=i.outlet_id AND stock.ingrediant_id=i.id) as total_stock
            FROM
                ingrediant i
                INNER JOIN outlets o ON o.id=i.outlet_id
                INNER JOIN unit_master u ON u.id=i.unit_id
            WHERE 
                i.deleted_at is null
        ";
        $IngrediantList = DB::select($Query);
        $outlets = Outlet::where('active', 1)->get();
        return view('foodsetup.ingrediant', compact('IngrediantList', 'outlets'));
    }

    public function AddIngrediant(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        $UnitList = UnitMasterModel::all();
        return view('foodsetup.add_ingrediant', compact('outlets', 'UnitList'));
    }

    public function PostAddIngrediant(Request $request)
    {
        $IngrediantList = $request->except(['_token', 'IngrediantId']);
        IngrediantModel::updateOrCreate(['id' => $request->IngrediantId], $IngrediantList);
        return redirect()->to('/foodsetup/ingrediant');
    }

    public function EditIngrediant(Request $request, $id)
    {
        $IngrediantList = IngrediantModel::where('id', $id)->first();
        $outlets = Outlet::where('active', 1)->get();
        $UnitList = UnitMasterModel::all();
        return view('foodsetup.add_ingrediant', compact('IngrediantList', 'outlets', 'UnitList'));
    }
    public function DeleteIngrediant(Request $request, $id)
    {
        IngrediantModel::where('id', $id)->delete();
        return redirect()->to('/foodsetup/ingrediant');
    }

    public function IngrediantStock(Request $request, $id)
    {
        $IngrediantList = IngrediantModel::select('ingrediant.*',  'unit_master.unit_name')
            ->where('outlet_id', $id)
            ->join('unit_master', 'unit_master.id', 'ingrediant.unit_id')
            ->get();

        return view('foodsetup.ingrediantstock', compact('IngrediantList'));
    }

    public function SaveIngrediantStock(Request $request)
    {
        $stock_date = now();
        $IngrediantStock = $request->IngrediantStock;

        for ($i = 0; $i < count($IngrediantStock); $i++) {

            $outlet_id = $IngrediantStock[$i]['outlet_id'];
            $ingrediant_id = $IngrediantStock[$i]['ingrediant_id'];
            $stock_value = $IngrediantStock[$i]['stock_value'];
            $ingrediant_price = $IngrediantStock[$i]['ingrediant_price'];


            IngrediantStockModel::insert([
                'outlet_id' => $outlet_id,
                'ingrediant_id' => $ingrediant_id,
                'stock_value' => $stock_value,
                'ingrediant_price' => $ingrediant_price,
                'stock_date' => $stock_date
            ]);
        }
        return redirect()->to('/foodsetup/ingrediant');
    }
}
