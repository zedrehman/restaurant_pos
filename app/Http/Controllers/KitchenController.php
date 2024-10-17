<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\IngrediantModel;
use App\Models\IngrediantStockModel;
use App\Models\ModifierModel;
use App\Models\ModifiersIngredientModel;
use App\Models\OrderTableMenuItems;
use App\Models\UnitMasterModel;
use Illuminate\Support\Facades\DB;


class KitchenController extends Controller
{

    public function OrderList(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('kitchen.orderlist', compact('outlets'));
    }

    public function GetOrderListByOutletId(Request $request)
    {
        $Query = "
            SELECT 
                ot.*,
                tm.table_name
            FROM 
                order_table ot 
                INNER JOIN table_management tm ON tm.id=ot.table_id
            WHERE
                ot.outlet_id=$request->outlet_id
                AND ot.id IN (select oti.order_id from order_table_menu_items oti WHERE ot.id=oti.order_id AND IFNULL(oti.item_status,'') NOT IN ('Ready','Cancel'))
            ORDER BY ot.id DESC
        ";
        $OrderTable = DB::select($Query);
        return response()->json($OrderTable, 200);
    }

    public function GetKitchenOrderDetails(Request $request)
    {
        $Query = "
            SELECT 
                om.*,
                mc.menu_name,
                mc.ready_in,
                kd.kitchen_department_name,
                ot.created_at
            FROM 
                order_table ot
                INNER JOIN order_table_menu_items om ON ot.id=om.order_id
                INNER JOIN menu_catalogues mc ON mc.id=om.menu_id
                INNER JOIN kitchen_department kd ON kd.id=mc.kitchen_department_id
            WHERE
                om.order_id=$request->OrderId
        ";
        $OrderTableMenu = DB::select($Query);
        return response()->json($OrderTableMenu, 200);
    }

    public function UpdateItemStatus(Request $request)
    {
        OrderTableMenuItems::where('id', $request->id)->update(['item_status' => $request->item_status]);
        return true;
    }

    public function DepartmentOrder()
    {
        $outlets = Outlet::where('active', 1)->get();
        return view('kitchen.department_order', compact('outlets'));
    }

    public function GetDepartmentDetailsByOutlet(Request $request)
    {
        $kd = "SELECT * FROM `kitchen_department` WHERE outlet_id=$request->outlet_id ORDER BY `kitchen_department_name` ASC ";
        $kitchen_department = DB::select($kd);

        $Query = "
            SELECT 
                om.*,
                ot.id as order_id,
                ot.kot,
                ot.table_id,
                ot.quick_bill_type,
                ot.bill_type,
                mc.menu_name,
                mc.ready_in,
                ot.created_at
            FROM 
                order_table ot
                INNER JOIN order_table_menu_items om ON ot.id=om.order_id
                INNER JOIN menu_catalogues mc ON mc.id=om.menu_id
            WHERE
                ot.outlet_id=$request->outlet_id AND mc.kitchen_department_id=" . $kitchen_department[0]->id;

        $order_table_menu_items = DB::select($Query);

        $ResponseArray = [];
        $ResponseArray['kitchen_department'] = $kitchen_department;
        $ResponseArray['order_table_menu_items'] = $order_table_menu_items;

        return response()->json($ResponseArray, 200);
    }

    public function GetDepartmentOrderDetailsId(Request $request)
    {
        $Query = "
            SELECT 
                om.*,
                ot.id as order_id,
                ot.kot,
                ot.table_id,
                ot.quick_bill_type,
                ot.bill_type,
                mc.menu_name,
                mc.ready_in,
                ot.created_at
            FROM 
                order_table ot
                INNER JOIN order_table_menu_items om ON ot.id=om.order_id
                INNER JOIN menu_catalogues mc ON mc.id=om.menu_id
            WHERE
                ot.outlet_id=$request->outlet_id AND mc.kitchen_department_id=$request->id";

        $order_table_menu_items = DB::select($Query);

        return response()->json($order_table_menu_items, 200);
    }
}
