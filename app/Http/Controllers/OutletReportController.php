<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\TableManagement;
use App\Models\Menu\MenuCatalogue;
use App\Models\Menu\MenuCategory;
use App\Models\OrderTable;
use App\Models\OrderTableMenuItems;
use Illuminate\Support\Facades\DB;

class OutletReportController extends Controller
{
    public function AllBills(Request $request)
    {
        $outlet_id = $request->session()->get('outlet_id');

        $PD_Query = "SELECT * FROM order_table ot WHERE ot.is_settled=1 AND ot.outlet_id=$outlet_id ORDER BY ot.id DESC";
        $OrderTable = DB::select($PD_Query);
        return view('outlet_report.all-bills', compact(['outlet_id', 'OrderTable']));
    }

    public function ReportDashboard(Request $request)
    {
        $outlet_id = $request->session()->get('outlet_id');
        return view('outlet_report.dashboard', compact(['outlet_id']));
    }
}
