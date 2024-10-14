<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutletDesignation;
use App\Models\Outlet;
use App\Models\Brand;
use App\Models\City;
use App\Models\CustomerModel;
use App\Models\User;
use App\Models\UserRoleModel;
use App\Models\Master\UserType;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserSetupController extends Controller
{
    public function OutletList()
    {
        $outlets = Outlet::all();
        return view('usersetup.outletlist', compact('outlets'));
    }

    public function AddOutlet(Request $request)
    {
        $cities = City::all();
        return view('usersetup.outlet_add', compact('cities'));
    }

    public function EditOutlet(Request $request, $id)
    {
        $outlet = Outlet::where('id', $id)->first();
        $cities = City::all();
        return view('usersetup.outlet_add', compact('outlet', 'cities'));
    }

    public function PostAddOutlet(Request $request)
    {
        $outletsInfoArr = $request->except(['_token', 'outletId']);
        $outletInfo = Outlet::updateOrCreate(['id' => $request->outletId], $outletsInfoArr);
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = $outletInfo->id . '_' . preg_replace('/[^a-zA-Z0-9_.]/', '-', $file->getClientOriginalName());
            $filePath = public_path('outlet/');
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $file->move($filePath, $filename);
            // delete File
            $filePath = public_path('outlet/' . $outletInfo->logo);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $outletInfo->logo = $filename;
        }
        $outletInfo->save();
        return redirect()->to('/usersetup/outletlist');
    }

    public function UserRole(Request $request)
    {
        $Query = "
            SELECT 
                *,
                (select COUNT(1) FROM users WHERE role_id=ur.id) As total_users
            FROM 
                user_role ur             
            ORDER BY ur.role_name ASC
        ";
        $UserRole = DB::select($Query);

        return view('usersetup.user_role', compact('UserRole'));
    }

    public function AddUserRole(Request $request, $id)
    {
        $UserRole = UserRoleModel::where('id', $id)->first();
        return view('usersetup.add_user_role', compact('UserRole'));
    }

    public function SaveUserRole(Request $request)
    {
        $UserRoleModel = $request->except(['_token', 'user_role_id']);
        UserRoleModel::updateOrCreate(['id' => $request->user_role_id], $UserRoleModel);
        return redirect()->to('/usersetup/userrole');
    }

    public function DeleteUserRole(Request $request, $id)
    {
        UserRoleModel::where('id', $id)->delete();
        return redirect()->to('/usersetup/userrole');
    }

    public function Customer(Request $request)
    {
        $CustomerList = CustomerModel::with('getOutlet')->get();
        return view('usersetup.customer', compact('CustomerList'));
    }

    public function AddCustomer(Request $request, $id)
    {
        $Customer = CustomerModel::where('id', $id)->first();
        $outlets = Outlet::where('active', 1)->get();
        return view('usersetup.add_customer', compact('Customer', 'outlets'));
    }
    public function SaveCustomer(Request $request)
    {
        $CustomerModel = $request->except(['_token', 'customer_id']);
        CustomerModel::updateOrCreate(['id' => $request->customer_id], $CustomerModel);
        return redirect()->to('/usersetup/customer');
    }

    public function DeleteCustomer(Request $request, $id)
    {
        CustomerModel::where('id', $id)->delete();
        return redirect()->to('/usersetup/customer');
    }
}
