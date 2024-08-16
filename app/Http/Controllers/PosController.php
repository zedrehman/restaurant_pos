<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\TableManagement;
use App\Models\Menu\MenuCatalogue;
use App\Models\Menu\MenuCategory;
use App\Models\OrderTable;
use App\Models\OrderTableMenuItems;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function ouletDashboard(Request $request)
    {
        $outlet_id = $request->session()->get('outlet_id');
        return view('pos.dashboard');
    }
    public function MenuListByCategoryId(Request $request, $CategoryId, $outlet_id)
    {
        //
        $Query = "
            SELECT 
                mc.* 
            FROM 
                `outlets_menu` om 
                INNER JOIN menu_details md ON om.id=md.outlets_menu_id
                INNER JOIN menu_catalogues mc ON md.menu_catalogue_id=mc.id
            WHERE 
                om.outlet_id=$outlet_id AND mc.menu_categories_id=$CategoryId;
        ";
        $MenuList = DB::select($Query);
        //$MenuList = MenuCatalogue::where('menu_categories_id', $CategoryId)->get();
        return response()->json($MenuList, 200);
    }

    public function OrderTable(Request $request)
    {
        $amount = 0;
        $outlet_id = $request->session()->get('outlet_id');

        $Query = "
            SELECT 
                tm.*,
                IFNULL((
                    SELECT 
                        ot.table_id 
                    FROM 
                        order_table ot 
                    WHERE 
                        ot.table_id=tm.id AND ot.is_settled=0 AND bill_type='Dine In' 
                        AND ot.outlet_id=$outlet_id
                ),0) as selectedTableId,
                IFNULL((
                    SELECT 
                        ot.total_bill_amount 
                    FROM 
                        order_table ot 
                    WHERE 
                        ot.table_id=tm.id AND ot.is_bill_saved=1 AND ot.is_settled=0 AND bill_type='Dine In' 
                        AND ot.outlet_id=$outlet_id
                ),0) as SavedTableId
            FROM 
                `table_management` tm
            WHERE tm.outlet_id=$outlet_id
        ";
        $tablesArray = DB::select($Query);


        $PD_Query = "
            SELECT 
                ot.id,
                ot.kot,
                ot.total_bill_amount,
                is_bill_saved
            FROM 
                order_table ot 
            WHERE 
                ot.table_id=0 AND ot.is_settled=0 AND bill_type='Pick Up / Delivery' 
                AND ot.outlet_id=$outlet_id
        ";
        $PD_KOTArray = DB::select($PD_Query);


        $MLQuery="
                SELECT 
                    mcat.id,
                    mcat.category_name,
                    COUNT(mc.id) as MenuCount
                FROM 
                    `outlets_menu` om 
                    INNER JOIN menu_details md ON om.id=md.outlets_menu_id
                    INNER JOIN menu_catalogues mc ON md.menu_catalogue_id=mc.id
                    INNER JOIN Menu_categories mcat ON mcat.id=mc.menu_categories_id

                WHERE 
                    om.outlet_id=$outlet_id AND mcat.active=1
                GROUP BY mcat.id, mcat.category_name;";

        //dd($PD_KOTArray);
        //$MenuCategory = MenuCategory::where('active', 1)->get();
        $MenuCategory = DB::select($MLQuery);

        return view('pos.order_table', compact(['tablesArray', 'MenuCategory', 'outlet_id', 'PD_KOTArray']));
    }

    public function GetOrderTableDetails(Request $request, $tableId)
    {
        $OrderTable = OrderTable::where('is_settled', 0)->where('table_id', $tableId)->first();
        return response()->json($OrderTable, 200);
    }

    public function GetOrderDetailsByOrderId(Request $request, $OrderId)
    {
        $OrderTable = OrderTable::where('id', $OrderId)->first();
        $Query = "
            SELECT 
                om.*,
                mc.menu_name
            FROM 
                order_table_menu_items om
                INNER JOIN menu_catalogues mc ON mc.id=om.menu_id
            WHERE
                om.order_id=$OrderId
        ";
        $OrderTableMenu = DB::select($Query);

        $ResponseArray = [];
        $ResponseArray['order_table'] = $OrderTable;
        $ResponseArray['order_table_menu_items'] = $OrderTableMenu;

        return response()->json($ResponseArray, 200);
    }

    public function GetOrderTableMenu(Request $request, $OrderId)
    {
        $Query = "
            SELECT 
                om.*,
                mc.menu_name
            FROM 
                order_table_menu_items om
                INNER JOIN menu_catalogues mc ON mc.id=om.menu_id
            WHERE
                om.order_id=$OrderId
        ";
        $OrderTableMenu = DB::select($Query);

        return response()->json($OrderTableMenu, 200);
    }


    public function SavePrintKOT(Request $request)
    {
        $KOTId = 1;
        $customer_id = 0;
        $OrderId = 0;
        $total_bill_amount = 0;
        $outlet_id = $request->session()->get('outlet_id');
        $MenuItem = $request->MenuItem;
        $CustomerName = $request->CustomerName;
        $MobileNo = $request->MobileNo;
        $Address = $request->Address;
        $KotNote = $request->KotNote;
        $TableId = $request->TableId;
        $BillType = $request->BillType;
        $Pd_kOT_ID = $request->Pd_kOT_ID;
        //dd($MenuItem, $CustomerName, $MobileNo, $Address, $KotNote, $TableId);

        $OrderTable = OrderTable::orderBy('id', 'DESC')->first();
        if ($OrderTable != null) {
            $KOTId = $OrderTable->kot + 1;
        }


        if ($BillType == 'Dine In') {
            $OrderDetails = OrderTable::where('is_settled', 0)
                ->where('bill_type', 'Dine In')
                ->where('table_id', $TableId)
                ->first();
        }
        if ($BillType == 'Pick Up / Delivery') {
            $OrderDetails = OrderTable::where('is_settled', 0)
                ->where('bill_type', 'Pick Up / Delivery')
                ->where('kot', $Pd_kOT_ID)
                ->first();
        }

        if ($OrderDetails != null) {
            $OrderId = $OrderDetails->id;
            $KOTId = $OrderDetails->kot;
        }


        if ($OrderId) {
            for ($i = 0; $i < count($MenuItem); $i++) {

                $total = $MenuItem[$i]['qty'] * $MenuItem[$i]['price'];
                $OrderMenuDetails = OrderTableMenuItems::where('order_id', $OrderId)->where('menu_id', $MenuItem[$i]['id'])->first();
                if ($OrderMenuDetails != null) {
                    $Quantity = $MenuItem[$i]['qty'] + $OrderMenuDetails->quantity;
                    $newtotal = $Quantity * $MenuItem[$i]['price'];
                    OrderTableMenuItems::where('id', $OrderMenuDetails->id)->update(['quantity' => $Quantity, 'total' => $newtotal]);
                } else {
                    OrderTableMenuItems::insert([
                        'order_id' => $OrderId,
                        'menu_id' => $MenuItem[$i]['id'],
                        'quantity' => $MenuItem[$i]['qty'],
                        'amount' => $MenuItem[$i]['price'],
                        'total' => $total,
                        'created_at' => now()
                    ]);
                }
            }
        } else {
            $OrderId = OrderTable::insertGetId([
                'outlet_id' => $outlet_id,
                'kot' => $KOTId,
                'table_id' => $TableId,
                'customer_id' => $customer_id,
                'kot_note' => $KotNote,
                'bill_type' => $BillType,
                'created_at' => now()
            ]);

            for ($i = 0; $i < count($MenuItem); $i++) {
                $total = $MenuItem[$i]['qty'] * $MenuItem[$i]['price'];
                OrderTableMenuItems::insert([
                    'order_id' => $OrderId,
                    'menu_id' => $MenuItem[$i]['id'],
                    'quantity' => $MenuItem[$i]['qty'],
                    'amount' => $MenuItem[$i]['price'],
                    'total' => $total,
                    'created_at' => now()
                ]);
            }
        }
        $Query = "SELECT SUM(quantity*amount) As total_bill_amount FROM `order_table_menu_items` WHERE order_id=$OrderId";
        $TotalCots = DB::select($Query);
        if ($TotalCots != null) {
            $total_bill_amount = $TotalCots[0]->total_bill_amount;
        }
        OrderTable::where('id', $OrderId)->update(['total_bill_amount' => $total_bill_amount]);

        $ResponseArray = [];
        $ResponseArray['OrderId'] = $OrderId;
        $ResponseArray['KOTId'] = $KOTId;

        return response()->json($ResponseArray, 200);
    }

    public function SavePrintBill(Request $request)
    {
        $OrderId = $request->OrderId;
        $TableId = $request->TableId;
        $OrderType = $request->OrderType;
        OrderTable::where('id', $OrderId)->update(['is_bill_saved' => 1]);
        return $OrderId;
    }

    public function SavePaymentAndSettleBill(Request $request)
    {
        $OrderId = $request->OrderId;
        $TableId = $request->TableId;
        $PaymentMode = $request->PaymentMode;
        OrderTable::where('id', $OrderId)->update(['is_bill_saved' => 1, 'payment_mode' => $PaymentMode, 'is_settled' => 1]);
        return $OrderId;
    }

    public function SettleBill(Request $request)
    {
        $OrderId = $request->OrderId;
        $TableId = $request->TableId;
        OrderTable::where('id', $OrderId)->update(['is_bill_saved' => 1, 'is_settled' => 1]);
        return $OrderId;
    }

    public function SaveQuickBill(Request $request)
    {
        $KOTId = 1;
        $customer_id = 0;
        $OrderId = 0;
        $total_bill_amount = 0;
        $outlet_id = $request->session()->get('outlet_id');
        $MenuItem = $request->MenuItem;
        $CustomerName = $request->CustomerName;
        $MobileNo = $request->MobileNo;
        $Address = $request->Address;
        $KotNote = $request->KotNote;

        $QuickBillType = $request->QuickBillType;

        $PaymentMode = $request->PaymentMode;


        $OrderTable = OrderTable::orderBy('id', 'DESC')->first();
        if ($OrderTable != null) {
            $KOTId = $OrderTable->kot + 1;
        }

        $OrderId = OrderTable::insertGetId([
            'outlet_id' => $outlet_id,
            'kot' => $KOTId,
            'table_id' => 0,
            'customer_id' => $customer_id,
            'kot_note' => $KotNote,
            'bill_type' => 'Quick Bill',
            'quick_bill_type' => $QuickBillType,
            'is_bill_saved' => 1,
            'is_settled' => 1,
            'payment_mode' => $PaymentMode,
            'created_at' => now()
        ]);

        for ($i = 0; $i < count($MenuItem); $i++) {
            $total = $MenuItem[$i]['qty'] * $MenuItem[$i]['price'];
            OrderTableMenuItems::insert([
                'order_id' => $OrderId,
                'menu_id' => $MenuItem[$i]['id'],
                'quantity' => $MenuItem[$i]['qty'],
                'amount' => $MenuItem[$i]['price'],
                'total' => $total,
                'created_at' => now()
            ]);
        }

        $Query = "SELECT SUM(quantity*amount) As total_bill_amount FROM `order_table_menu_items` WHERE order_id=$OrderId";
        $TotalCots = DB::select($Query);
        if ($TotalCots != null) {
            $total_bill_amount = $TotalCots[0]->total_bill_amount;
        }
        OrderTable::where('id', $OrderId)->update(['total_bill_amount' => $total_bill_amount]);

        $ResponseArray = [];
        $ResponseArray['OrderId'] = $OrderId;
        $ResponseArray['KOTId'] = $KOTId;

        return response()->json($ResponseArray, 200);
    }
}
