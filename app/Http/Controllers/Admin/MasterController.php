<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\ProductGroup;
use App\Models\Master\TaxConfiguration;
use App\Models\Master\KitchenDepartment;
use App\Models\Master\OutletDepartment;
use App\Models\Master\TableManagement;
use App\Models\Master\Coupon;
use App\Models\Outlet;
use App\Models\Master\UserType;

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
        $productGroup = ProductGroup::all();
        return view('admin.master.tax_configuration_add', compact('outlets', 'productGroup'));
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
        return view('admin.master.tax_configuration_add', compact('taxConfiguration', 'outlets', 'productGroup'));
    }

    public function DeleteTaxConfiguration(Request $request, $id)
    {
        TaxConfiguration::where('id', $id)->delete();
        return redirect()->to('/admin/tax-configuration-list');
    }

    // Kitchen Department
    public function KitchenDepartmentList(Request $request)
    {
        $dataArray = KitchenDepartment::select('kitchen_department.*', 'outlets.outlet_name')->join('outlets', 'outlets.id', 'kitchen_department.outlet_id')->get();
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

    // Outlet Department
    public function OutletDepartmentList(Request $request)
    {
        $dataArray = OutletDepartment::select('outlet_department.*', 'outlets.outlet_name')->join('outlets', 'outlets.id', 'outlet_department.outlet_id')->get();
        return view('admin.master.outlet_department_list', compact('dataArray'));
    }

    public function getOutletDepartment(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        $productGroup = ProductGroup::all();
        return view('admin.master.outlet_department_add', compact('outlets', 'productGroup'));
    }

    public function postOutletDepartment(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        $insertDataArr['active'] = $request->active ? 1 : 0;
        $dataInfo = OutletDepartment::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        return redirect()->to('/admin/outlet-department-list');
    }

    public function getEditOutletDepartment(Request $request, $id)
    {
        $dataArray = OutletDepartment::where('id', $id)->first();
        $outlets = Outlet::all();
        $productGroup = ProductGroup::all();
        return view('admin.master.outlet_department_add', compact('dataArray', 'outlets', 'productGroup'));
    }

    // table management 
    public function TableManagementList(Request $request)
    {
        /*$dataArray = TableManagement::select('table_management.*', 'outlets.outlet_name', 'outlet_department.outlet_department_name')
            ->join('outlets', 'outlets.id', 'table_management.outlet_id')
            ->join('outlet_department', 'outlet_department.id', 'table_management.outlet_department_id')
            ->get();*/

        $dataArray = TableManagement::select('table_management.*', 'outlets.outlet_name')
            ->join('outlets', 'outlets.id', 'table_management.outlet_id')
            ->get();

        return view('admin.master.table_management_list', compact('dataArray'));
    }

    public function getTableManagement(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('admin.master.table_management_add', compact('outlets'));
    }

    public function postTableManagement(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        $insertDataArr['active'] = $request->active ? 1 : 0;
        $dataInfo = TableManagement::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        return redirect()->to('/admin/table-management-list');
    }

    public function getEditTableManagement(Request $request, $id)
    {
        $dataArray = TableManagement::where('id', $id)->first();
        $outlets = Outlet::all();
        return view('admin.master.table_management_add', compact('dataArray', 'outlets'));
    }

    public function DeleteTableManagement(Request $request, $id)
    {
        TableManagement::where('id', $id)->delete();
        return redirect()->to('/admin/table-management-list');
    }

    public function getOutletDepartmentData(Request $request, $id)
    {
        $outletDepartment = OutletDepartment::where('outlet_id', $id)->get();
        return response()->json($outletDepartment, 200);
    }

    // Outlet Department
    public function couponList(Request $request)
    {
        $dataArray = Coupon::all();
        return view('admin.master.coupon_list', compact('dataArray'));
    }

    public function getCoupon(Request $request)
    {
        return view('admin.master.coupon_add');
    }

    public function postCoupon(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        $insertDataArr['active'] = $request->active ? 1 : 0;
        $dataInfo = Coupon::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        return redirect()->to('/admin/coupon-list');
    }

    public function getEditCoupon(Request $request, $id)
    {
        $dataArray = Coupon::where('id', $id)->first();
        return view('admin.master.coupon_add', compact('dataArray'));
    }

    //  User Type
    public function userTypeList(Request $request)
    {
        $dataArray = UserType::all();
        return view('admin.master.usertype_list', compact('dataArray'));
    }

    public function getuserType(Request $request)
    {
        return view('admin.master.usertype_add');
    }

    public function postuserType(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        $dataInfo = UserType::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        return redirect()->to('/admin/usertype-list');
    }

    public function getEdituserType(Request $request, $id)
    {
        $dataArray = UserType::where('id', $id)->first();
        return view('admin.master.usertype_add', compact('dataArray'));
    }
}
