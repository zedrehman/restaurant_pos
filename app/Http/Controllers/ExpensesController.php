<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpenseTypeModel;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\IngrediantModel;
use App\Models\IngrediantStockModel;
use App\Models\OutletExpensesModel;
use App\Models\UnitMasterModel;
use Illuminate\Support\Facades\DB;


class ExpensesController extends Controller
{
    // ExpenseType
    public function ExpenseType()
    {
        $ExpenseType = ExpenseTypeModel::all();
        return view('expenses.expensetype', compact('ExpenseType'));
    }

    public function AddExpenseType(Request $request)
    {
        return view('expenses.add_expensetype');
    }

    public function PostAddExpenseType(Request $request)
    {
        $ExpenseType = $request->except(['_token', 'TypeId']);
        ExpenseTypeModel::updateOrCreate(['id' => $request->TypeId], $ExpenseType);
        return redirect()->to('/expenses/expensetype');
    }

    public function EditExpenseType(Request $request, $id)
    {
        $ExpenseType = ExpenseTypeModel::where('id', $id)->first();
        return view('expenses.add_expensetype', compact('ExpenseType'));
    }
    public function DeleteExpenseType(Request $request, $id)
    {
        ExpenseTypeModel::where('id', $id)->delete();
        return redirect()->to('/expenses/expensetype');
    }

    //Outlet Expenses
    public function OutletExpenses()
    {
        //$Expenses = OutletExpensesModel::all();
        $Query = "
            SELECT 
                oe.*,
                o.outlet_name,
                et.type_name
            FROM
                outlet_expenses oe
                INNER JOIN outlets o ON o.id=oe.outlet_id
                INNER JOIN expense_type et ON et.id=oe.expense_type_id
            WHERE 
                oe.deleted_at is null
        ";
        $Expenses = DB::select($Query);
        return view('expenses.outletexpenses', compact('Expenses'));
    }

    public function AddOutletExpenses(Request $request)
    {
        $outlets = Outlet::where('active', 1)->get();
        $ExpenseType = ExpenseTypeModel::all();
        return view('expenses.add_outletexpenses', compact('outlets', 'ExpenseType'));
    }

    public function PostAddOutletExpenses(Request $request)
    {
        $Expenses = $request->except(['_token', 'ExpensesId']);
        OutletExpensesModel::updateOrCreate(['id' => $request->ExpensesId], $Expenses);
        return redirect()->to('/expenses/outletexpenses');
    }

    public function EditOutletExpenses(Request $request, $id)
    {
        $Expenses = OutletExpensesModel::where('id', $id)->first();
        $outlets = Outlet::where('active', 1)->get();
        $ExpenseType = ExpenseTypeModel::all();
        return view('expenses.add_outletexpenses', compact('Expenses', 'outlets', 'ExpenseType'));
    }
    public function DeleteOutletExpenses(Request $request, $id)
    {
        OutletExpensesModel::where('id', $id)->delete();
        return redirect()->to('/expenses/outletexpenses');
    }
}
