<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu\MenuCategory;
use App\Models\Menu\MenuCatalogue;
use App\Models\Menu\OutletMenu;
use App\Models\Menu\MenuDetail;
use App\Models\FoodType;
use App\Models\Master\KitchenDepartment;
use App\Models\Outlet;
use File;
use App\Models\Master\ProductGroup;
use App\Models\MenuIngredientModel;
use Illuminate\Support\Facades\DB;

class MeneuManagementController extends Controller
{
    public function menuCategoriesList(Request $request)
    {
        $dataArray = MenuCategory::all();
        return view('admin.menu.menu_category_list', compact('dataArray'));
    }

    public function getAddMenuCategories(Request $request)
    {
        return view('admin.menu.menu_category_add');
    }

    public function postAddMenuCategories(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        $insertDataArr['active'] = $request->active ? 1 : 0;
        $dataInfo = MenuCategory::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $dataInfo->id . '_' . preg_replace('/[^a-zA-Z0-9_.]/', '-', $file->getClientOriginalName());
            $filePath = public_path('menu/menu_category/');
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $file->move($filePath, $filename);
            // delete File
            $filePath = public_path('menu/menu_category/' . $dataInfo->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $dataInfo->image = $filename;
        }
        $dataInfo->save();
        return redirect()->to('/admin/menu-management/menu-categories');
    }

    public function getEditMenuCategories(Request $request, $id)
    {
        $dataArray = MenuCategory::where('id', $id)->first();
        return view('admin.menu.menu_category_add', compact('dataArray'));
    }

    public function menuCataloguesList(Request $request)
    {
        $dataArray = MenuCatalogue::with('getMenuCategory', 'getFoodType', 'getOutlet')->get();
        return view('admin.menu.menu_catalogues_list', compact('dataArray'));
    }

    public function getAddMenuCatalogues(Request $request)
    {
        $menuCategory = MenuCategory::where('active', 1)->get();
        $foodType = FoodType::all();
        $outlets = Outlet::where('active', 1)->get();
        $Json_Ingrediant = json_encode([]);
        $KitchenDepartment = KitchenDepartment::where('outlet_id', 0)->get();
        return view('admin.menu.menu_catalogues_add', compact('menuCategory', 'foodType', 'outlets', 'Json_Ingrediant', 'KitchenDepartment'));
    }

    public function postAddMenuCatalogues(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId', 'IngrediantItem']);
        $insertDataArr['active'] = $request->active ? 1 : 0;

        $dataInfo = MenuCatalogue::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        $tableId = $dataInfo->id;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $tableId . '_' . preg_replace('/[^a-zA-Z0-9_.]/', '-', $file->getClientOriginalName());
            $filePath = public_path('menu/menu_catalogues/');
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $file->move($filePath, $filename);
            // delete File
            $filePath = public_path('menu/menu_catalogues/' . $dataInfo->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $dataInfo->image = $filename;
        }
        $dataInfo->save();

        $IngrediantItem = json_decode($request->IngrediantItem);
        MenuIngredientModel::where('menu_id', $tableId)->delete();
        foreach ($IngrediantItem as $item) {
            MenuIngredientModel::insert([
                'menu_id' => $tableId,
                'ingrediant_id' => $item->IngredientId,
                'quantity' => $item->Quantity
            ]);
        }
        /*return redirect()->to('/admin/menu-management/menu-catalogues');*/
        return true;
    }

    public function getEditMenuCatalogues(Request $request, $id)
    {
        $dataArray = MenuCatalogue::where('id', $id)->first();
        $menuCategory = MenuCategory::where('active', 1)->get();
        $foodType = FoodType::all();
        $outlets = Outlet::where('active', 1)->get();
        $MenuIngredient = MenuIngredientModel::where('menu_id', $id)->get();

        $Query = "SELECT * FROM ingrediant WHERE outlet_id=$dataArray->outlet_id AND deleted_at is null";
        $IngrediantList = DB::select($Query);
        $Json_Ingrediant = json_encode($IngrediantList);

        $KitchenDepartment = KitchenDepartment::where('outlet_id', $dataArray->outlet_id)->get();

        return view('admin.menu.menu_catalogues_add', compact('dataArray', 'menuCategory', 'foodType', 'outlets', 'MenuIngredient', 'IngrediantList', 'Json_Ingrediant', 'KitchenDepartment'));
    }

    public function DeleteMenuIngredient(Request $request)
    {
        MenuIngredientModel::where('id', $request->Id)->delete();
        return true;
    }

    public function GetKitchenDepartmentByOutletId(Request $request)
    {
        $KitchenDepartment = KitchenDepartment::where('outlet_id', $request->outlet_id)->get();
        return response()->json($KitchenDepartment, 200);
    }

    public function outletMenuList(Request $request)
    {
        $dataArray = OutletMenu::with('getOutlet')->get();
        return view('admin.menu.outlet_menu_list', compact('dataArray'));
    }

    public function getAddOutletMenu(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('admin.menu.outlet_menu_add', compact('outlets'));
    }

    public function postAddOutletMenu(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        $dataInfo = OutletMenu::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        return redirect()->to('/admin/menu-management/outlet-menu');
    }

    public function getEditOutletMenu(Request $request, $id)
    {
        $dataArray = OutletMenu::where('id', $id)->first();
        $outlets = Outlet::where('active', 1)->get();
        return view('admin.menu.outlet_menu_add', compact('dataArray', 'outlets'));
    }

    public function getAddItem(Request $request, $id)
    {
        $MenuCatalogueList = MenuCatalogue::where('active', 1)->get();
        $menuDetail = MenuDetail::where('outlets_menu_id', $id)->pluck('menu_catalogue_id')->toArray(); //json_encode();
        $dataArray = OutletMenu::where('id', $id)->first();
        //dd($menuDetail);
        return view('admin.menu.add_menu', compact('dataArray', 'MenuCatalogueList', 'menuDetail'));
    }

    public function postAddItem(Request $request)
    {
        $menuItems = $request->chkMenuName;
        //dd($menuItems,$request->tableId);
        if (count($menuItems) > 0) {
            $insertDataArray = [];
            for ($i = 0; $i < count($menuItems); $i++) {
                $insertData = [
                    'outlets_menu_id' => $request->tableId,
                    'menu_catalogue_id' => $menuItems[$i],
                ];
                array_push($insertDataArray, $insertData);
            }
            if (count($insertDataArray) > 0) {
                MenuDetail::where('outlets_menu_id', $request->tableId)->forceDelete();
                MenuDetail::insert($insertDataArray);
            }
        }
        return redirect()->to('/admin/menu-management/outlet-menu');
    }
}
