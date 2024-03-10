<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\ProductGroup;
use App\Models\Master\TaxConfiguration;
use App\Models\Master\KitchenDepartment;
use App\Models\Master\OutletDepartment;
use App\Models\Outlet;

class MasterController extends Controller
{
    public function productGroupList(Request $request)
    {
        $productGroups = ProductGroup::all();
        return view('admin.master.product_group_list', compact('productGroups'));
    }

    public function getAddProductGroup(Request $request)
    {
        return view('admin.master.product_group_add');
    }

    public function postAddProductGroup(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'productGroupId']);
        $dataInfo = ProductGroup::updateOrCreate(['id' => $request->productGroupId], $insertDataArr);
        return redirect()->to('/admin/product-group-list');
    }

    public function getEditProductGroup(Request $request, $id)
    {
        $productGroup = ProductGroup::where('id', $id)->first();
        return view('admin.master.product_group_add', compact('productGroup'));
    }

    public function taxConfigurationList(Request $request)
    {
        $taxConfiguration = TaxConfiguration::select('tax_configuration.*','product_groups.product_group_name')->join('product_groups', 'product_groups.id', 'tax_configuration.product_group_id')->get();
        return view('admin.master.tax_configuration_list', compact('taxConfiguration'));
    }

    public function getAddTaxConfiguration(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        $productGroup = ProductGroup::all();
        return view('admin.master.tax_configuration_add', compact('outlets','productGroup'));
    }

    public function postAddTaxConfiguration(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'taxConfigurationId']);
        $insertDataArr['is_dividable'] = $request->is_dividable ? 1 : 0;
        $insertDataArr['include_in_rate'] = $request->include_in_rate ? 1 : 0;
        $insertDataArr['active'] = $request->active ? 1 : 0;
        $dataInfo = TaxConfiguration::updateOrCreate(['id' => $request->taxConfigurationId], $insertDataArr);
        return redirect()->to('/admin/tax-configuration-list');
    }

    public function getEditTaxConfiguration(Request $request, $id)
    {
        $taxConfiguration = TaxConfiguration::where('id', $id)->first();
        $productGroup = ProductGroup::all();
        $outlets = Outlet::all();
        return view('admin.master.tax_configuration_add', compact('taxConfiguration', 'outlets','productGroup'));
    }

    // Kitchen Department
    public function KitchenDepartmentList(Request $request)
    {
        $dataArray = KitchenDepartment::select('kitchen_department.*','outlets.outlet_name')->join('outlets','outlets.id','kitchen_department.outlet_id')->get();
        return view('admin.master.kitchen_department_list', compact('dataArray'));
    }

    public function getKitchenDepartment(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('admin.master.kitchen_department_add', compact('outlets'));
    }

    public function postKitchenDepartment(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        $insertDataArr['active'] = $request->active ? 1 : 0;
        $dataInfo = KitchenDepartment::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        return redirect()->to('/admin/kitchen-department-list');
    }

    public function getEditKitchenDepartment(Request $request, $id)
    {
        $dataArray = KitchenDepartment::where('id', $id)->first();
        $outlets = Outlet::all();
        return view('admin.master.kitchen_department_add', compact('dataArray', 'outlets'));
    }

}
