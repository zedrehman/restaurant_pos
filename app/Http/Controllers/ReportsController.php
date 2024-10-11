<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\IngrediantModel;
use App\Models\IngrediantStockModel;
use App\Models\ModifierModel;
use App\Models\ModifiersIngredientModel;
use App\Models\UnitMasterModel;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function OverAllReports(Request $request)
    {
        $PD_Query = "
            SELECT 
                ot.* 
            FROM 
                order_table ot 
                INNER JOIN outlets o ON ot.outlet_id=o.id
            WHERE 
                ot.is_settled=1  
            ORDER BY ot.id DESC
        ";
        $OrderTable = DB::select($PD_Query);
        return view('reports.over_all_reports', compact(['OrderTable']));
    }

    public function ExpensesReports(Request $request)
    {
        /*$PD_Query = "
            SELECT 
                SUM(expense_amount),
                expense_date,
                outlet_id,
                o.outlet_name
            FROM 
                outlet_expenses oe
                INNER JOIN outlets o ON oe.outlet_id=o.id
            GROUP BY 
                expense_date,oe.outlet_id,o.outlet_name
            ORDER BY expense_date DESC
            ;
        ";*/
        $PD_Query = "
            SELECT 
                SUM(expense_amount) as total_amount,
                expense_date,
                outlet_id
            FROM 
                outlet_expenses oe
            GROUP BY 
                expense_date,oe.outlet_id
            ORDER BY expense_date DESC;
        ";
        $ExpensesTable = DB::select($PD_Query);

        $ExpensesDetailsTable = [];
        if (count($ExpensesTable) > 0) {
            $EX_Query = "
                SELECT 
                    oe.*,
                    o.outlet_name,
                    et.type_name
                FROM 
                    outlet_expenses oe
                    INNER JOIN outlets o ON oe.outlet_id=o.id
                    INNER JOIN expense_type et ON oe.expense_type_id=et.id
                WHERE 
                    expense_date='" . $ExpensesTable[0]->expense_date . "'
            ";

            $ExpensesDetailsTable = DB::select($EX_Query);
        }

        return view('reports.expenses_report', compact(['ExpensesTable', 'ExpensesDetailsTable']));
    }

    public function GetExpensesDetailsReportsByDate(Request $request)
    {
        $EX_Query = "
                SELECT 
                    oe.*,
                    o.outlet_name,
                    et.type_name
                FROM 
                    outlet_expenses oe
                    INNER JOIN outlets o ON oe.outlet_id=o.id
                    INNER JOIN expense_type et ON oe.expense_type_id=et.id
                WHERE 
                    expense_date='" . $request->expense_date . "'
            ";

        $ExpensesDetailsTable = DB::select($EX_Query);
        
        return response()->json($ExpensesDetailsTable, 200);
    }
}
