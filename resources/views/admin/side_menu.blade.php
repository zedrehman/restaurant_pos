<ul class="nav">
    <li class="nav-item" id="lnkDashboard">
        <a class="nav-link" href="{{url('/admin/dashboard')}}">
            <i class="ti-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item" id="lnkConfiguration">
        <a class="nav-link" data-bs-toggle="collapse" href="#Configuration" aria-expanded="false" aria-controls="Configuration">
            <i class="ti-gallery menu-icon"></i>
            <span class="menu-title">Configuration</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="Configuration">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/brand')}}" id="lnkBrands">Brands</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/outlet-designation')}}" id="lnkVedioGallery">Outlet Designation</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/outlet-list')}}" id="lnkVedioGallery">Outlet</a></li>
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
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/tax-configuration-list')}}">Tax Configuration</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/kitchen-department-list')}}">Kitchen Department</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/outlet-department-list')}}">Outlet Department</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item" id="lnkProductsCategoryList">
        <a class="nav-link" href="{{url('/admin/products/category')}}">
            <i class="ti-layers menu-icon"></i>
            <span class="menu-title">Category</span>
        </a>
    </li>
    <li class="nav-item" id="lnkProductsList">
        <a class="nav-link" href="{{url('/admin/products')}}">
            <i class="ti-shopping-cart menu-icon"></i>
            <span class="menu-title">Products</span>
        </a>
    </li>
    <li class="nav-item" id="lnkSupplierList">
        <a class="nav-link" href="{{url('/admin/suppliers')}}">
            <i class="ti-user menu-icon"></i>
            <span class="menu-title">Supplier</span>
        </a>
    </li>
    <li class="nav-item" id="lnkSetting">
        <a class="nav-link" href="{{url('/admin/dashboard/setting')}}">
            <i class="ti-settings menu-icon"></i>
            <span class="menu-title">Setting</span>
        </a>
    </li>
    <li class="nav-item" id="lnkWebContent">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
            <i class="ti-view-list menu-icon"></i>
            <span class="menu-title">Web Content</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-advanced">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/about-us')}}" id="lnkAboutsUs">Abouts Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/announcement')}}" id="lnkAnnouncement">Announcement</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/blogs')}}" id="lnkBlogs">Blogs</a></li>
                <!--<li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/careers')}}" id="lnkCareers">Careers</a></li>-->
                <li class="nav-item"><a class="nav-link" href="{{url('/admin/webcontent/testimonial')}}" id="lnkTestimonial">Testimonial</a></li>
            </ul>
        </div>
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