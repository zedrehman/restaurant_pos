<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use File;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand_list', compact('brands'));
    }

    public function getAddBrand(Request $request)
    {
        return view('admin.addBrand');
    }

    public function postAddBrand(Request $request)
    {
        $brandInfoArr = $request->except(['_token', 'brandId']);
        $brandInfo = Brand::updateOrCreate(['id' => $request->brandId], $brandInfoArr);
        if ($request->file('logoImage')) {
            $file = $request->file('logoImage');
            $filename = preg_replace('/[^a-zA-Z0-9_.]/', '-', $file->getClientOriginalName());
            $filePath = public_path('brand/' . $brandInfo->id . '/');
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $file->move($filePath, $filename);
            // delete File
            $filePath = public_path('brand/' . $brandInfo->id . '/' . $brandInfo->logo);
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
        //dd($brand);
        return view('admin.addBrand', compact('brand'));
    }
}
