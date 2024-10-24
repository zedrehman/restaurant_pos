<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutletDesignation;
use App\Models\Outlet;
use App\Models\Brand;
use App\Models\City;
use App\Models\User;
use App\Models\Master\UserType;
use App\Models\UserRoleModel;
use File;
use Illuminate\Support\Facades\Hash;


class OutletController extends Controller
{
    public function getBrandList()
    {
        $brands = Brand::all();
        return view('admin.outlet.brand_list', compact('brands'));
    }

    public function getAddBrand(Request $request)
    {
        return view('admin.outlet.brand_add');
    }

    public function postAddBrand(Request $request)
    {
        $brandInfoArr = $request->except(['_token', 'brandId']);
        $brandInfo = Brand::updateOrCreate(['id' => $request->brandId], $brandInfoArr);
        if ($request->file('logoImage')) {
            $file = $request->file('logoImage');
            $filename = $brandInfo->id.'_'.preg_replace('/[^a-zA-Z0-9_.]/', '-', $file->getClientOriginalName());
            $filePath = public_path('brand/');
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $file->move($filePath, $filename);
            // delete File
            $filePath = public_path('brand/'.$brandInfo->logo);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $brandInfo->logo = $filename;
        }
        $brandInfo->save();
        return redirect()->to('/admin/brand');
    }

    public function getEditBrand(Request $request, $id)
    {
        $brand = Brand::where('id', $id)->first();
        return view('admin.outlet.brand_add', compact('brand'));
    }

    public function designationList()
    {
        $designation = Outletdesignation::all();
        return view('admin.outlet.designation_list', compact('designation'));
    }

    public function getAddDesignation(Request $request)
    {
        return view('admin.outlet.designation_add');
    }

    public function postAddDesignation(Request $request)
    {
        $designationInfoArr = $request->except(['_token', 'designationId']);
        $designationInfo = OutletDesignation::updateOrCreate(['id' => $request->designationId], $designationInfoArr);
        return redirect()->to('/admin/outlet-designation');
    }

    public function getEditDesignation(Request $request, $id)
    {
        $designation = Outletdesignation::where('id', $id)->first();
        return view('admin.outlet.designation_add', compact('designation'));
    }

    public function outletList()
    {
        $outlets = Outlet::with('getBrand')->get();
        return view('admin.outlet.outlet_list', compact('outlets'));
    }

    public function getAddOutlet(Request $request)
    {
        $brands = Brand::all();
        $cities = City::all();
        return view('admin.outlet.outlet_add', compact('brands', 'cities'));
    }

    public function postAddOutlet(Request $request)
    {
        $outletsInfoArr = $request->except(['_token', 'outletId']);
        $outletInfo = Outlet::updateOrCreate(['id' => $request->outletId], $outletsInfoArr);
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = $outletInfo->id.'_'.preg_replace('/[^a-zA-Z0-9_.]/', '-', $file->getClientOriginalName());
            $filePath = public_path('outlet/');
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $file->move($filePath, $filename);
            // delete File
            $filePath = public_path('outlet/'.$outletInfo->logo);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $outletInfo->logo = $filename;
        }
        $outletInfo->save();
        return redirect()->to('/admin/outlet-list');
    }

    public function getEditOutlet(Request $request, $id)
    {
        $outlet = Outlet::where('id', $id)->first();
        $brands = Brand::all();
        $cities = City::all();
        return view('admin.outlet.outlet_add', compact('outlet', 'brands', 'cities'));
    }

    public function outletUserList()
    {
        $users = User::with(['getOutlet','getCity','getRole'])->where('user_type', '!=', 'admin')->get();
        return view('admin.outlet.user_list', compact('users'));
    }

    public function getAddUser(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        $cities = City::all();
        $userType = UserRoleModel::all();//[ WAITER, MANAGER];
        return view('admin.outlet.user_add', compact('outlets', 'cities', 'userType'));
    }

    public function postAddUser(Request $request)
    {
        $insertDataArr = $request->except(['_token', 'tableId']);
        if($request->password != '') {
            $insertDataArr['password'] =  Hash::make($request->password);
        } else {
            unset($insertDataArr['password']);
        }

        $insertDataArr['active'] = $request->active ? 1 : 0;
        $outletInfo = User::updateOrCreate(['id' => $request->tableId], $insertDataArr);
        return redirect()->to('/admin/outlet-user');
    }

    public function getEditUser(Request $request, $id)
    {
        $outlets = Outlet::where('active', 1)->get();
        $user = User::where('id', $id)->where('user_type', '!=', 'admin')->first();
        $cities = City::all();
        $userType = UserRoleModel::all();
        return view('admin.outlet.user_add', compact('outlets', 'user', 'cities', 'userType'));
    }

    public function DeleteUser(Request $request, $id)
    {
        
        User::where('id', $id)->delete();        
        return redirect()->to('/admin/outlet-user');
    }
}
