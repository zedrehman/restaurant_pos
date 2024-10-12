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

    public function StockAlertReports(Request $request)
    {

        $EX_Query = "            
                SELECT 
                    stock.*,
                    i.ingrediant_name,
                    o.outlet_name,
                    (totalstock - TotalUsed) avl_stock
                FROM 
                    (
                        SELECT 
                            inst.ingrediant_id,
                            SUM(inst.stock_value) as totalstock,
                            SUM(
                                (
                                    SELECT 
                                        IFNULL(SUM(mci.quantity), 0)
                                    FROM 
                                        menu_catalogues_ingredient mci 
                                        INNER JOIN order_table_menu_items otmi ON mci.menu_id=otmi.menu_id
                                    WHERE
                                        mci.ingrediant_id=inst.ingrediant_id
                                )+
                                (SELECT IFNULL(SUM(quantity), 0) FROM modifiers_ingredient mi WHERE mi.ingrediant_id=inst.ingrediant_id)
                            ) as TotalUsed
                        FROM
                            ingrediant_stock inst
                        GROUP BY inst.ingrediant_id
                    )stock
                    INNER JOIN `ingrediant` i ON I.id=stock.ingrediant_id
                    INNER JOIN outlets o ON i.outlet_id=o.id
                WHERE
                    IFNULL(remind_at,0) <= (totalstock - TotalUsed)
        ";

        $stockDetails = DB::select($EX_Query);

        return view('reports.stock_alert', compact(['stockDetails']));
    }
}
