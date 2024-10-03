<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutletDesignation;
use App\Models\Outlet;
use App\Models\Brand;
use App\Models\City;
use App\Models\EmailModel;
use App\Models\SmsModel;
use App\Models\User;
use App\Models\Master\UserType;
use App\Models\PrinterModel;
use App\Models\UnitMasterModel;
use File;
use Illuminate\Support\Facades\Hash;


class AppSettingController extends Controller
{
    public function UnitMaster()
    {
        $UnitMaster = UnitMasterModel::all();
        return view('appsetting.unitmaster', compact('UnitMaster'));
    }

    public function AddUnitMaster(Request $request)
    {
        return view('appsetting.add_unitmaster');
    }

    public function PostAddUnitMaster(Request $request)
    {
        $UnitMasterArray = $request->except(['_token', 'unitemasterId']);
        UnitMasterModel::updateOrCreate(['id' => $request->unitemasterId], $UnitMasterArray);
        return redirect()->to('/appsetting/unitmaster');
    }

    public function EditUnitMaster(Request $request, $id)
    {
        $UnitMaster = UnitMasterModel::where('id', $id)->first();
        return view('appsetting.add_unitmaster', compact('UnitMaster'));
    }
    public function DeleteUnitMaster(Request $request, $id)
    {
        UnitMasterModel::where('id', $id)->delete();
        return redirect()->to('/appsetting/unitmaster');
    }

    //sms
    public function SMS()
    {
        $SMSList = SmsModel::select('sms_setup.*', 'outlets.outlet_name')
            ->join('outlets', 'outlets.id', 'sms_setup.outlet_id')
            ->get();
        return view('appsetting.sms', compact('SMSList'));
    }

    public function AddSMS(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('appsetting.add_sms', compact('outlets'));
    }

    public function PostAddSMS(Request $request)
    {
        $SMSList = $request->except(['_token', 'smsId']);
        SmsModel::updateOrCreate(['id' => $request->smsId], $SMSList);
        return redirect()->to('/appsetting/sms');
    }

    public function EditSMS(Request $request, $id)
    {
        $SMSList = SmsModel::where('id', $id)->first();
        $outlets = Outlet::where('active', 1)->get();
        return view('appsetting.add_sms', compact('SMSList', 'outlets'));
    }
    public function DeleteSMS(Request $request, $id)
    {
        SmsModel::where('id', $id)->delete();
        return redirect()->to('/appsetting/sms');
    }

    //Email
    public function Email()
    {
        $EmailList = EmailModel::select('email_setup.*', 'outlets.outlet_name')
            ->join('outlets', 'outlets.id', 'email_setup.outlet_id')
            ->get();
        return view('appsetting.email', compact('EmailList'));
    }

    public function AddEmail(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('appsetting.add_email', compact('outlets'));
    }

    public function PostAddEmail(Request $request)
    {
        $EmailList = $request->except(['_token', 'emailId']);
        EmailModel::updateOrCreate(['id' => $request->emailId], $EmailList);
        return redirect()->to('/appsetting/email');
    }

    public function EditEmail(Request $request, $id)
    {
        $EmailList = EmailModel::where('id', $id)->first();
        $outlets = Outlet::where('active', 1)->get();
        return view('appsetting.add_email', compact('EmailList', 'outlets'));
    }
    public function DeleteEmail(Request $request, $id)
    {
        EmailModel::where('id', $id)->delete();
        return redirect()->to('/appsetting/email');
    }

    //Printers
    public function Printer()
    {
        $PrinterList = PrinterModel::select('printer_setup.*', 'outlets.outlet_name')
            ->join('outlets', 'outlets.id', 'printer_setup.outlet_id')
            ->get();
        return view('appsetting.printer', compact('PrinterList'));
    }

    public function AddPrinter(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('appsetting.add_printer', compact('outlets'));
    }

    public function PostAddPrinter(Request $request)
    {
        $PrinterList = $request->except(['_token', 'PrinterId']);
        PrinterModel::updateOrCreate(['id' => $request->PrinterId], $PrinterList);
        return redirect()->to('/appsetting/printer');
    }

    public function EditPrinter(Request $request, $id)
    {
        $PrinterList = PrinterModel::where('id', $id)->first();
        $outlets = Outlet::where('active', 1)->get();
        return view('appsetting.add_printer', compact('PrinterList', 'outlets'));
    }
    public function DeletePrinter(Request $request, $id)
    {
        PrinterModel::where('id', $id)->delete();
        return redirect()->to('/appsetting/printer');
    }
}
