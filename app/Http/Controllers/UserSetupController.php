<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutletDesignation;
use App\Models\Outlet;
use App\Models\Brand;
use App\Models\City;
use App\Models\User;
use App\Models\Master\UserType;
use File;
use Illuminate\Support\Facades\Hash;


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

    public function UserRole()
    {
        $outlets = Outlet::all();
        return view('usersetup.outletlist', compact('outlets'));
    }

    public function Customer()
    {
        $outlets = Outlet::all();
        return view('usersetup.outletlist', compact('outlets'));
    }
}
