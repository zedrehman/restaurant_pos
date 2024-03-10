<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductGroup;
use App\Models\TaxConfiguration;
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
        $taxConfiguration = TaxConfiguration::all();
        return view('admin.master.tax_configuration_list', compact('taxConfiguration'));
    }

    public function getAddTaxConfiguration(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('admin.master.tax_configuration_add', compact('outlets'));
    }

    public function postAddTaxConfiguration(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'taxConfigurationId']);
        $dataInfo = TaxConfiguration::updateOrCreate(['id' => $request->taxConfigurationId], $insertDataArr);
        return redirect()->to('/admin/tax-configuration-list');
    }

    public function getEditTaxConfiguration(Request $request, $id)
    {
        $taxConfiguration = TaxConfiguration::where('id', $id)->first();
        $outlets = Outlet::all();
        return view('admin.master.tax_configuration_add', compact('taxConfiguration', 'outlets'));
    }

}
