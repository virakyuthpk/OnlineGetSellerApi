<!-- brand -->
<div class="logo">
    <a href="#" class="logo-expanded">
       <!-- <img src="{!! url('backEnd/img/logo.png') !!}" alt="logo">-->
        <span class="nav-label">Onlineget</span>
    </a>
</div>
<!-- / brand -->
<nav class="navigation">
    <ul class="list-unstyled">
        @if(Auth::user()->role == 'admin')
        <li class="has-submenu {{ Request::is('admin/dashboard')?'active':''}}"><a href="{{route('dashboard')}}"><i class="ion-home"></i> <span class="nav-label">Dashboard</span></a></li>
        <li class="has-submenu {{ Request::is('admin/users') || Request::is('admin/users-create') || Request::is('admin/edit-user/*') ? "active" : '' }}"><a href="#"><i class="ion-android-social-user "></i> <span class="nav-label">User Management</span></a>
            <ul class="list-unstyled">
                <li class="has-submenu {{ Request::is('admin/users') || Request::is('admin/users-create') || Request::is('admin/edit-user/*') ? "active" : '' }}"><a href="{{route('users')}}">Administrator</a></li>
            </ul>
        </li>
        <li class="has-submenu {{Request::is('admin/pages') || Request::is('admin/page/create') || Request::is('admin/edit/page/*') ||  Request::is('admin/partner/create') || Request::is('admin/edit/partner/*')||
            Request::is('admin/slide-show') || Request::is('admin/slide-show/create') || Request::is('admin/discount') || Request::is('admin/discount-create') || Request::is('admin/edit/discount/*') || Request::is('admin/campaign') || Request::is('admin/team') || Request::is('admin/team/create') || Request::is('admin/edit/team/*') || Request::is('admin/campaign-create') || Request::is('admin/edit/campaign/*') || Request::is('admin/job') || Request::is('admin/job/create') || Request::is('admin/edit/job/*') ? "active" : '' }}"><a href="#"><i class="ion-edit"></i> <span class="nav-label">CMS</span></a>
            <ul class="list-unstyled">
                <li class="has-submenu {{ Request::is('admin/slide-show') || Request::is('admin/slide-show/create') || Request::is('admin/edit/slide-show/*') ? "active" : '' }}"><a href="{{route('slide-show')}}">Slide Show</a></li>
                <li class="has-submenu {{ Request::is('admin/pages') || Request::is('admin/page/create') || Request::is('admin/edit/page/*') ? "active":''}}"><a href="{{route('pages')}}">Page</a></li>
                <li class="has-submenu {{ Request::is('admin/discount') || Request::is('admin/discount-create') || Request::is('admin/edit/discount/*') ? "active":''}}"><a href="{{route('discount')}}">Discount</a></li>
                <li class="has-submenu {{ Request::is('admin/campaign') || Request::is('admin/campaign-create') || Request::is('admin/edit/campaign/*') ? "active":''}}"><a href="{{route('campaign')}}">Campaign</a></li>
                <li class="has-submenu {{ Request::is('admin/team') || Request::is('admin/team/create') || Request::is('admin/edit/team/*') ? "active":''}}"><a href="{{route('team')}}">Team</a></li>
                <li class="has-submenu {{ Request::is('admin/job') || Request::is('admin/job/create') || Request::is('admin/edit/job/*') ? "active":''}}"><a href="{{route('job')}}">Career</a></li>
            </ul>
        </li>
        <li class="has-submenu {{ Request::is('admin/address') || Request::is('admin/address/create') || Request::is('admin/edit/address/*') ? "active":''}}"><a href="{{route('address')}}">
            <i class="fa fa-map-marker" aria-hidden="true"></i> <span class="nav-label">Address</span></a>
        </li>
        @endif
        <li class="has-submenu {{ Request::is('admin/slide-show') || Request::is('admin/slide-show/create') || Request::is('admin/edit/slide-show/*') ? "active" : '' }}"><a href="{{route('slide-show')}}"> <i class="fa fa-picture-o" aria-hidden="true"></i> <span class="nav-label">Slide</span></a></li>
        <li class="has-submenu {{ Request::is('admin/leftslide') || Request::is('admin/leftslide-create') || Request::is('admin/edit/leftslide/*')  ? "active":''}}"><a href="{{route('leftslide')}}">
            <i class="fa fa-picture-o" aria-hidden="true"></i> <span class="nav-label">Left Slide</span></a>
        </li>
        <li class="has-submenu {{ Request::is('admin/advertise') || Request::is('admin/advertise-create') || Request::is('admin/edit/advertise/*')  ?'active':''}}"><a href="{{route('advertise')}}"><i class="fa fa-bullhorn"></i> <span class="nav-label">Advertise</span></a></li>
        <li class="has-submenu {{Request::is('admin/product') || Request::is('admin/create-product/*') ||  Request::is('admin/edit-product/*') ?'active':''}}"><a href="{{route('product')}}"><i class="fa fa-th"></i> <span class="nav-label">Product</span></a></li>
        <li class="has-submenu {{Request::is('admin/product-order') ?'active':''}}"><a href="{{route('product-order')}}"><i class="fa fa-truck"></i> <span class="nav-label">Order</span></a></li>
        <li class="has-submenu {{ Request::is('admin/category') || Request::is('admin/edit-category/*') || Request::is('admin/category-create') ?'active':''}}"><a href="{{route('category')}}"><i class="fa fa-list"></i> <span class="nav-label">Categories</span></a></li>
        <li class="has-submenu {{Request::is('admin/brand') || Request::is('admin/brand/create') || Request::is('admin/edit/brand/*')||
            Request::is('admin/brand') || Request::is('admin/brand-create')  ? "active" : '' }}"><a href="#"><i class="fa fa-apple"></i> <span class="nav-label">Brand</span></a>
            <ul class="list-unstyled">
                <li class="has-submenu {{ Request::is('admin/edit/brand/*') || Request::is('admin/brand-create') ? "active" : '' }}"><a href="{{route('brand-create')}}">Add Brand</a></li>
                <li class="has-submenu {{ Request::is('admin/brand') ? "active":''}}"><a href="{{route('brand')}}">Manage Brand</a></li>
            </ul>
        </li>
        <li class="has-submenu {{Request::is('admin/unit') || Request::is('admin/unit/create') || Request::is('admin/edit/unit/*')||
            Request::is('admin/unit') || Request::is('admin/unit-create')  ? "active" : '' }}"><a href="#"><i class="fa fa-pencil"></i> <span class="nav-label">Unit</span></a>
            <ul class="list-unstyled">
                <li class="has-submenu {{ Request::is('admin/edit/unit/*') || Request::is('admin/unit-create') ? "active" : '' }}"><a href="{{route('unit-create')}}">Add Unit</a></li>
                <li class="has-submenu {{ Request::is('admin/unit') ? "active":''}}"><a href="{{route('unit')}}">Manage Unit</a></li>
            </ul>
        </li>
        <li class="has-submenu {{Request::is('admin/variant') || Request::is('admin/variant/create') || Request::is('admin/edit/variant/*')||
            Request::is('admin/variant') || Request::is('admin/variant-create')  ? "active" : '' }}"><a href="#"><i class="fa fa-asterisk"></i> <span class="nav-label">Variant</span></a>
            <ul class="list-unstyled">
                <li class="has-submenu {{ Request::is('admin/edit/variant/*') || Request::is('admin/variant-create') ? "active" : '' }}"><a href="{{route('variant-create')}}">Add Variant</a></li>
                <li class="has-submenu {{ Request::is('admin/variant') ? "active":''}}"><a href="{{route('variant')}}">Manage Variant</a></li>
            </ul>
        </li>
        <li class="has-submenu {{Request::is('admin/supplier') || Request::is('admin/supplier/create') || Request::is('admin/edit/supplier/*')||
            Request::is('admin/supplier') || Request::is('admin/supplier-create')  ? "active" : '' }}"><a href="#"><i class="fa fa-user"></i> <span class="nav-label">Supplier</span></a>
            <ul class="list-unstyled">
                <li class="has-submenu {{ Request::is('admin/edit/supplier/*') || Request::is('admin/supplier-create') ? "active" : '' }}"><a href="{{route('supplier-create')}}">Add Supplier</a></li>
                <li class="has-submenu {{ Request::is('admin/supplier') ? "active":''}}"><a href="{{route('supplier')}}">Manage Supplier</a></li>
            </ul>
        </li>
        <li class="has-submenu {{ Request::is('admin/pages') || Request::is('admin/page/create') || Request::is('admin/edit/page/*') ? "active":''}}"><a href="{{route('pages')}}"> <i class="fa fa-file"></i> <span class="nav-label">Pages</span></a></li>
        <li class="has-submenu {{ Request::is('admin/logo') ?'active':''}}"><a href="{{route('logo')}}"><i class="fa fa-picture-o"></i> <span class="nav-label">Logo</span></a></li>
        @if(Auth::user()->role == 'admin')
        <li class="has-submenu {{Request::is('admin/customer') || Request::is('admin/customer/create') || Request::is('admin/edit/customer/*')||
            Request::is('admin/customer') || Request::is('admin/customer-create')  ? "active" : '' }}"><a href="#"><i class="fa fa-users"></i> <span class="nav-label">Customer</span></a>
            <ul class="list-unstyled">
                <li class="has-submenu {{ Request::is('admin/edit/customer/*') || Request::is('admin/customer-create') ? "active" : '' }}"><a href="{{route('customer-create')}}">Add Customer</a></li>
                <li class="has-submenu {{ Request::is('admin/customer') ? "active":''}}"><a href="{{route('customer')}}">Manage Customer</a></li>
            </ul>
        </li>
        <li class="has-submenu {{ Request::is('admin/payment') || Request::is('admin/payment/create') || Request::is('admin/edit/payment/*') ? "active":''}}"><a href="{{route('payment')}}">
            <i class="fa fa-money" aria-hidden="true"></i> <span class="nav-label">Payment</span></a>
        </li>
        <li class="has-submenu {{Request::is('admin/province') || Request::is('admin/province/create') || Request::is('admin/edit/province/*') ||  Request::is('admin/district') || Request::is('admin/district/create') || Request::is('admin/edit/district/*') || Request::is('admin/commune') || Request::is('admin/commune/create') || Request::is('admin/edit/commune/*') || Request::is('admin/village') || Request::is('admin/village/create') || Request::is('admin/edit/village/*') ? "active" : '' }}"><a href="#"><i class="ion-settings"></i> <span class="nav-label">Setting</span></a>
            <ul class="list-unstyled">
                <li class="has-submenu {{ Request::is('admin/province') || Request::is('admin/province/create') || Request::is('admin/edit/province/*') ? "active" : '' }}"><a href="{{route('province')}}">Province</a></li>
                <li class="has-submenu {{ Request::is('admin/district') || Request::is('admin/district/create') || Request::is('admin/edit/district/*') ? "active" : '' }}"><a href="{{route('district')}}">District</a></li>
                <li class="has-submenu {{ Request::is('admin/commune') || Request::is('admin/commune/create') || Request::is('admin/edit/commune/*') ? "active" : '' }}"><a href="{{route('commune')}}">Commune</a></li>
                <li class="has-submenu {{ Request::is('admin/village') || Request::is('admin/village/create') || Request::is('admin/edit/village/*') ? "active" : '' }}"><a href="{{route('village')}}">Villages</a></li>
            </ul>
        </li>
        <li class="has-submenu {{ Request::is('admin/list-comment') ? "active":''}}"><a href="{{route('list-comment')}}">
            <i class="fa fa-comment" aria-hidden="true"></i> <span class="nav-label">Comment</span></a>
        </li>
        <li class="has-submenu {{ Request::is('admin/visito-log') ? "active":''}}"><a href="{{route('visito-log')}}">
            <i class="fa fa-eye" aria-hidden="true"></i> Visitor <span class="badge bg-primary">{!!$visitlog?$visitlog:''!!}</span></a>
        </li>
        
        @endif
    </ul>
</nav>
<!-- Aside Ends-->