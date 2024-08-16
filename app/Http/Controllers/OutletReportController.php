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
    public function ReportDashboard(Request $request)
    {
        $outlet_id = $request->session()->get('outlet_id');
        return view('outlet_report.dashboard', compact(['outlet_id']));
    }
}
