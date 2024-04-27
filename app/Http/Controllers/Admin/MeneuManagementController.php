<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu\MenuCategory;
use App\Models\Menu\MenuCatalogue;
use App\Models\Menu\OutletMenu;
use App\Models\FoodType;
use App\Models\Outlet;
use File;

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
            $filename = $dataInfo->id.'_'.preg_replace('/[^a-zA-Z0-9_.]/', '-', $file->getClientOriginalName());
            $filePath = public_path('menu/menu_category/');
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $file->move($filePath, $filename);
            // delete File
            $filePath = public_path('menu/menu_category/'.$dataInfo->image);
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
        $dataArray = MenuCatalogue::with('getMenuCategory','getFoodType')->get();
        return view('admin.menu.menu_catalogues_list', compact('dataArray'));
    }

    public function getAddMenuCatalogues(Request $request)
    {
        $menuCategory = MenuCategory::where('active', 1)->get();
        $foodType = FoodType::all();
        return view('admin.menu.menu_catalogues_add', compact('menuCategory', 'foodType'));
    }

    public function postAddMenuCatalogues(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        $insertDataArr['active'] = $request->active ? 1 : 0;
        $dataInfo = MenuCatalogue::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $dataInfo->id.'_'.preg_replace('/[^a-zA-Z0-9_.]/', '-', $file->getClientOriginalName());
            $filePath = public_path('menu/menu_catalogues/');
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $file->move($filePath, $filename);
            // delete File
            $filePath = public_path('menu/menu_catalogues/'.$dataInfo->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $dataInfo->image = $filename;
        }
        $dataInfo->save();
        return redirect()->to('/admin/menu-management/menu-catalogues');
    }

    public function getEditMenuCatalogues(Request $request, $id)
    {
        $dataArray = MenuCatalogue::where('id', $id)->first();
        $menuCategory = MenuCategory::where('active', 1)->get();
        $foodType = FoodType::all();
        return view('admin.menu.menu_catalogues_add', compact('dataArray','menuCategory', 'foodType'));
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
        return view('admin.menu.outlet_menu_add', compact('dataArray','outlets'));
    }
}
