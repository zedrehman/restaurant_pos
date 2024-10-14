<ul class="metismenu" id="menu">
    <li class="mm-active" id="lnkDashboard" data-id="1">
        <a href="{{url('/admin/dashboard')}}" aria-expanded="false">
            <i class="flaticon-381-networking"></i>
            <span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li id="lnkUserSetup" data-id="2">
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-user"></i>
            <span class="nav-text">User Setup</span>
        </a>
        <ul aria-expanded="false" id="ulUserSetup">
            <li><a href="{{url('/usersetup/outletlist')}}">Outlets</a></li>
            <li><a href="{{url('/usersetup/userrole')}}">User Role</a></li>
            <li><a href="{{url('/admin/outlet-user')}}">Users</a></li>
            <li><a href="{{url('/usersetup/customer')}}">Customers</a></li>
        </ul>
    </li>
    <li id="lnkAppsSetting" data-id="3">
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-television"></i>
            <span class="nav-text">Apps Setting</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{url('/appsetting/unitmaster')}}">Unit Master</a></li>
            <li><a href="{{url('/admin/table-management-list')}}">Service Tables</a></li>
            <li><a href="{{url('/appsetting/printer')}}">Printers</a></li>
            <li><a href="{{url('/appsetting/email')}}">Email Setup</a></li>
            <li><a href="{{url('/appsetting/sms')}}">SMS Setup</a></li>
            <li><a href="{{url('/admin/tax-configuration-list')}}">Tax</a></li>
        </ul>
    </li>
    <li id="lnkFoodSetup" data-id="4">
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-layer-1"></i>
            <span class="nav-text">Food Setup</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{url('/admin/kitchen-department-list')}}">Kitchen Department</a></li>
            <li><a href="{{url('/foodsetup/ingrediant')}}">Ingrediant</a></li>
            <li><a href="{{url('/foodsetup/modifiers')}}">Modifier</a></li>
            <li><a href="{{url('/admin/menu-management/menu-categories')}}">Category</a></li>
            <li><a href="{{url('/admin/menu-management/menu-catalogues')}}">Items</a></li>
            <!--<li><a href="{{url('/admin/menu-management/outlet-menu')}}">Outlet Items</a></li>-->
        </ul>
    </li>
    <li id="lnkExpenses" data-id="5">
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa fa-dollar"></i>
            <span class="nav-text">Expenses</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{url('/expenses/expensetype')}}">Expense type</a></li>
            <li><a href="{{url('/expenses/outletexpenses')}}">Expense</a></li>
        </ul>
    </li>
    <li id="lnkKitchen" data-id="6">
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-menu"></i>
            <span class="nav-text">Kitchen</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{url('/kitchen/orderlist')}}">Order List</a></li>
            <li><a href="{{url('/kitchen/departmentorder')}}">Department Orders</a></li>
        </ul>
    </li>
    <li id="lnkReports" data-id="7">
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-network"></i>
            <span class="nav-text">Reports</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{url('/reports/overallreports')}}">Overall Reports</a></li>
            <li><a href="{{url('/reports/expensesreports')}}">Expense Reports</a></li>
            <li><a href="{{url('/reports/stockalertreports')}}">Stock Alert</a></li>
        </ul>
    </li>
    <li id="lnkPOS" data-id="8">
        <a href="{{url('/outlet/pos')}}" class="ai-icon" aria-expanded="false">
            <i class="flaticon-381-networking"></i>
            <span class="nav-text">POS</span>
        </a>
    </li>
</ul>
<!--<ul class="nav">
    
    <li class="nav-item" >
       
        <div class="collapse" >
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/brand')}}" id="lnkBrands">Brands</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/outlet-designation')}}" id="lnkVedioGallery">Outlet Designation</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item" id="lnkMasterConfiguration">
        <a class="nav-link" data-bs-toggle="collapse" href="#MasterConfiguration" aria-expanded="false" aria-controls="MasterConfiguration">
            <i class="ti-gallery menu-icon"></i>
            <span class="menu-title">Master Configuration</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="MasterConfiguration">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/product-group-list')}}">Product Group</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/outlet-department-list')}}">Outlet Department</a></li>
                <li class="nav-item"><a class="nav-link" href="">Table Management</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/coupon-list')}}">Coupons</a></li>
            </ul>
        </div>
    </li>

    
</ul>-->