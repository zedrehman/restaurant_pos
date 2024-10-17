<?php

namespace App\Http\Controllers;

use App\Models\UserMenuRightsModel;
use App\Models\UserRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user_role = Auth::user()->user_type;
        $role_id = Auth::user()->role_id;

        $request->session()->put('outlet_id', Auth::user()->outlet_id);
        $request->session()->put('user_role', $user_role);
        if ($user_role == 'admin') {
            $role_id = 0;
            $request->session()->put('UserRoleName', 'Administrator');
        }else{
            $UserRole = UserRoleModel::where('id', $role_id)->first();
            $request->session()->put('UserRoleName', $UserRole->role_name);
        }
        $Query = "
            SELECT 
                DISTINCT m.* 
            FROM 
                `user_menu_rights` umr
                INNER JOIN menus m ON umr.menu_id=m.id
            WHERE umr.role_id=$role_id;";
        $RoleMenuList = DB::select($Query);
        $request->session()->put('RoleMenuList', $RoleMenuList);

        $SBQuery = "
           SELECT 
                DISTINCT sm.* 
            FROM 
                `user_menu_rights` umr
                INNER JOIN sub_menus sm ON umr.sub_menu_id=sm.id
            WHERE umr.role_id=$role_id;";

        $RoleSubMenuList = DB::select($SBQuery);
        $request->session()->put('RoleSubMenuList', $RoleSubMenuList);

        

        if ($user_role == ADMIN_ROLE) {
            return redirect('admin/dashboard');
        } else {
            $RoleMenuList = UserMenuRightsModel::where('role_id', $role_id)->pluck('menu_id')->toArray();
            if (count($RoleMenuList) == 0) {
                return abort(404);
            } else if (count($RoleMenuList) == 1) {
                if ($RoleMenuList[0] == 8) {
                    return redirect()->to('/outlet/order-table');
                } else {
                    return redirect('admin/dashboard');
                }
            } else {
                return redirect('admin/dashboard');
            }
        }
    }
}
