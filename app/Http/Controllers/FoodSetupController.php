<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\IngrediantModel;
use App\Models\IngrediantStockModel;
use App\Models\ModifierModel;
use App\Models\ModifiersIngredientModel;
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

    //Modif
    public function Modifiers()
    {
        $ModifierList = ModifierModel::select('modifiers.*', 'outlets.outlet_name')
            ->join('outlets', 'outlets.id', 'modifiers.outlet_id')
            ->get();
        return view('foodsetup.modifiers', compact('ModifierList'));
    }

    public function GetIngrediantByOutletId(Request $request)
    {
        $Query = "SELECT * FROM ingrediant WHERE outlet_id=$request->outlet_id AND deleted_at is null";
        $IngrediantList = DB::select($Query);
        return response()->json($IngrediantList, 200);
    }
    public function AddModifiers(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();

        //$Query = "SELECT * FROM ingrediant WHERE outlet_id=0 AND deleted_at is null";
        $IngrediantList = [];
        $Json_Ingrediant = json_encode($IngrediantList);

        return view('foodsetup.add_modifiers', compact('outlets', 'Json_Ingrediant'));
    }

    public function SaveModifiers(Request $request)
    {
        /*$IngrediantList = $request->except(['_token', 'IngrediantId']);
        ModifierModel::updateOrCreate(['id' => $request->IngrediantId], $IngrediantList);
        return redirect()->to('/foodsetup/modifiers');*/
        $Id = $request->Id;
        if ($Id == 0) {
            $Id = ModifierModel::insertGetId([
                'outlet_id' => $request->OutletId,
                'modifier_name' => $request->Modifiername,
                'created_at' => now()
            ]);
        } else {
            ModifierModel::where('id', $Id)->update(['outlet_id' => $request->OutletId, 'modifier_name' => $request->Modifiername]);
        }

        $IngrediantItem = $request->IngrediantItem;
        ModifiersIngredientModel::where('modifiers_id', $Id)->delete();

        for ($i = 0; $i < count($IngrediantItem); $i++) {
            ModifiersIngredientModel::insert([
                'modifiers_id' => $Id,
                'ingrediant_id' => $IngrediantItem[$i]['IngredientId'],
                'quantity' => $IngrediantItem[$i]['Quantity']
            ]);
        }
        return true;
    }

    public function EditModifiers(Request $request, $id)
    {
        $ModifierList = ModifierModel::where('id', $id)->first();
        $outlets = Outlet::where('active', 1)->get();

        $ModifiersIngredient = ModifiersIngredientModel::where('modifiers_id', $id)->get();

        $Query = "SELECT * FROM ingrediant WHERE outlet_id=$ModifierList->outlet_id AND deleted_at is null";
        $IngrediantList = DB::select($Query);
        $Json_Ingrediant = json_encode($IngrediantList);

        return view('foodsetup.add_modifiers', compact('ModifiersIngredient', 'outlets', 'ModifierList', 'IngrediantList', 'Json_Ingrediant'));
    }

    public function DeleteModifiers(Request $request, $id)
    {
        ModifierModel::where('id', $id)->delete();
        ModifiersIngredientModel::where('modifiers_id', $id)->delete();
        return redirect()->to('/foodsetup/modifiers');
    }

    public function DeleteModifiersIngredient(Request $request)
    {
        ModifiersIngredientModel::where('id', $request->Id)->delete();
        return true;
    }
}
