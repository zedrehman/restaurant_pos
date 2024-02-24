<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutletDesignation;

class OutletController extends Controller
{
    public function OutletdesignationList()
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
}
