<ul class="nav" style="margin-top: 10px !important;">
    <li class="nav-item" id="lnkDashboard">
        <a class="nav-link" href="{{url('/outlet/dashboard')}}">
            <i class="ti-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item" id="lnkProductsCategoryList">
        <a class="nav-link" href="{{url('/outlet/order-table')}}">
            <i class="fa fa-spoon menu-icon" style="rotate: 180deg;"></i><i class="fa fa-glass menu-icon"></i>
            <span class="menu-title">Order Table</span>
        </a>
    </li>
    
    <li class="nav-item" id="lnkAllBills">
        <a class="nav-link" href="{{url('/outlet/all-bills')}}">
            <i class="fa fa-file-text-o menu-icon"></i>
            <span class="menu-title">All Bills</span>
        </a>
    </li>
    <li class="nav-item" id="lnkReports">
        <a class="nav-link" href="{{url('/outlet/report')}}">
            <i class="fa fa-bar-chart-o menu-icon"></i>
            <span class="menu-title">Reports</span>
        </a>
    </li>
    <li class="nav-item" id="lnkSupplierList">
        <a class="nav-link" href="">
            <i class="ti-user menu-icon"></i>
            <span class="menu-title">Supplier</span>
        </a>
    </li>
    <li class="nav-item" id="lnkLogout">
        <a class="nav-link" href="{{ url('/logout') }}">
            <i class="ti-power-off menu-icon"></i>
            <span class="menu-title">Logout</span>
        </a>
    </li>
    <li class="nav-item" id="lnkHelpAndSupport" style="display: none;">
        <a class="nav-link" data-bs-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
            <i class="ti-help-alt menu-icon"></i>
            <span class="menu-title">Help & Support</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/feedback')}}" id="lnkFeedback">Feedback</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/general-inquiry')}}" id="lnkGeneralInquiry">General Inquiry</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/partner')}}" id="lnkPartnerRequest">Partner Request</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/contact-us')}}" id="lnkContactUs">Contact Us</a></li>
            </ul>
        </div>
    </li>
</ul>