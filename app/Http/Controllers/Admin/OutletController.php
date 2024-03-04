<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutletDesignation;
use App\Models\Outlet;
use App\Models\Brand;
use App\Models\City;
use File;

class OutletController extends Controller
{
    public function designationList()
    {
        $designation = Outletdesignation::all();
        return view('admin.outlet.designation_list', compact('designation'));
    }

    public function getAddDesignation(Request $request)
    {
        return view('admin.outlet.addDesignation');
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
        return view('admin.outlet.addDesignation', compact('designation'));
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
        return view('admin.outlet.addoutlet', compact('brands', 'cities'));
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
        return view('admin.outlet.addoutlet', compact('outlet', 'brands', 'cities'));
    }
}
