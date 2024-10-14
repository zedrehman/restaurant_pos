<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuModel;
use App\Models\SubMenuModel;

class MenuList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MenuData = [
            [
                'id' => 1,
                'id_name' => 'lnkDashboard',
                'menu_name' => 'Dashboard',
                'menu_url' => '/admin/dashboard',
                'icon' => 'flaticon-381-networking',
                'is_has_sub_menu' => 0
            ],
            [
                'id' => 2,
                'id_name' => 'lnkUserSetup',
                'menu_name' => 'User Setup',
                'icon' => 'flaticon-381-user',
                'is_has_sub_menu' => 1
            ],
            [
                'id' => 3,
                'id_name' => 'lnkAppsSetting',
                'menu_name' => 'Apps Setting',
                'icon' => 'flaticon-381-television',
                'is_has_sub_menu' => 1
            ],
            [
                'id' => 4,
                'id_name' => 'lnkFoodSetup',
                'menu_name' => 'Food Setup',
                'icon' => 'flaticon-381-layer-1',
                'is_has_sub_menu' => 1
            ],
            [
                'id' => 5,
                'id_name' => 'lnkExpenses',
                'menu_name' => 'Expenses',
                'icon' => 'fa fa-dollar',
                'is_has_sub_menu' => 1
            ],
            [
                'id' => 6,
                'id_name' => 'lnkKitchen',
                'menu_name' => 'Kitchen',
                'icon' => 'flaticon-381-menu',
                'is_has_sub_menu' => 1
            ],
            [
                'id' => 7,
                'id_name' => 'lnkReports',
                'menu_name' => 'Reports',
                'icon' => 'flaticon-381-network',
                'is_has_sub_menu' => 1
            ],
            [
                'id' => 8,
                'id_name' => 'lnkPOS',
                'menu_name' => 'POS',
                'icon' => 'flaticon-381-networking',
                'is_has_sub_menu' => 0
            ]

        ];
        MenuModel::insert($MenuData);

        $SubMenuData = [
            [
                'id' => 1,
                'menu_id' => 2,
                'id_name' => '',
                'menu_name' => 'Outlets',
                'menu_url' => '/usersetup/outletlist',
                'icon' => ''
            ],
            [
                'id' => 2,
                'menu_id' => 2,
                'id_name' => '',
                'menu_name' => 'User Role',
                'menu_url' => '/usersetup/userrole',
                'icon' => ''
            ],
            [
                'id' => 3,
                'menu_id' => 2,
                'id_name' => '',
                'menu_name' => 'Users',
                'menu_url' => '/admin/outlet-user',
                'icon' => ''
            ],
            [
                'id' => 4,
                'menu_id' => 2,
                'id_name' => '',
                'menu_name' => 'Customers',
                'menu_url' => '/usersetup/customer',
                'icon' => ''
            ],
            [
                'id' => 5,
                'menu_id' => 3,
                'id_name' => '',
                'menu_name' => 'Unit Master',
                'menu_url' => '/appsetting/unitmaster',
                'icon' => ''
            ],
            [
                'id' => 6,
                'menu_id' => 3,
                'id_name' => '',
                'menu_name' => 'Service Tables',
                'menu_url' => '/admin/table-management-list',
                'icon' => ''
            ],
            [
                'id' => 7,
                'menu_id' => 3,
                'id_name' => '',
                'menu_name' => 'Printers',
                'menu_url' => '/appsetting/printer',
                'icon' => ''
            ],
            [
                'id' => 8,
                'menu_id' => 3,
                'id_name' => '',
                'menu_name' => 'Email Setup',
                'menu_url' => '/appsetting/email',
                'icon' => ''
            ],
            [
                'id' => 9,
                'menu_id' => 3,
                'id_name' => '',
                'menu_name' => 'SMS Setup',
                'menu_url' => '/appsetting/sms',
                'icon' => ''
            ],
            [
                'id' => 10,
                'menu_id' => 3,
                'id_name' => '',
                'menu_name' => 'Tax',
                'menu_url' => '/admin/tax-configuration-list',
                'icon' => ''
            ],
            [
                'id' => 11,
                'menu_id' => 4,
                'id_name' => '',
                'menu_name' => 'Kitchen Department',
                'menu_url' => '/admin/kitchen-department-list',
                'icon' => ''
            ],
            [
                'id' => 12,
                'menu_id' => 4,
                'id_name' => '',
                'menu_name' => 'Ingrediant',
                'menu_url' => '/foodsetup/ingrediant',
                'icon' => ''
            ],
            [
                'id' => 13,
                'menu_id' => 4,
                'id_name' => '',
                'menu_name' => 'Modifier',
                'menu_url' => '/foodsetup/modifiers',
                'icon' => ''
            ],
            [
                'id' => 14,
                'menu_id' => 4,
                'id_name' => '',
                'menu_name' => 'Category',
                'menu_url' => '/admin/menu-management/menu-categories',
                'icon' => ''
            ],
            [
                'id' => 15,
                'menu_id' => 4,
                'id_name' => '',
                'menu_name' => 'Items',
                'menu_url' => '/admin/menu-management/menu-catalogues',
                'icon' => ''
            ],
            [
                'id' => 16,
                'menu_id' => 5,
                'id_name' => '',
                'menu_name' => 'Expense type',
                'menu_url' => '/expenses/expensetype',
                'icon' => ''
            ],
            [
                'id' => 17,
                'menu_id' => 5,
                'id_name' => '',
                'menu_name' => 'Expense',
                'menu_url' => '/expenses/outletexpenses',
                'icon' => ''
            ],
            [
                'id' => 18,
                'menu_id' => 2,
                'id_name' => '',
                'menu_name' => '',
                'menu_url' => '',
                'icon' => ''
            ],
            [
                'id' => 19,
                'menu_id' => 2,
                'id_name' => '',
                'menu_name' => '',
                'menu_url' => '',
                'icon' => ''
            ],
            [
                'id' => 20,
                'menu_id' => 2,
                'id_name' => '',
                'menu_name' => '',
                'menu_url' => '',
                'icon' => ''
            ]

        ];
        SubMenuModel::insert($SubMenuData);
    }
}
