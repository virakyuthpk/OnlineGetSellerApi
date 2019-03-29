<div class="vendor-left">
	<h4>Menus</h4>
	<a href="{{route('product-vendor')}}"><p class="has-submenu {{ Request::is('saller/product-vendor')?'active':''}}"><i class="fa fa-archive " aria-hidden="true"></i> Create Product</p></a>
	<a href="{{route('order-vendor-product')}}"><p class="has-submenu {{ Request::is('saller/order-vendor-product')?'active':''}}"><i class="fa  fa-shopping-cart " aria-hidden="true"></i>Order Histrory</p></a>
	<a href="{{route('vendor-profile')}}"><p class="has-submenu {{ Request::is('saller/vendor-profile')?'active':''}}"><i class="fa fa-user " aria-hidden="true"></i> Profile Setting</p></a>
	<a href="{{route('vendor-acount')}}"><p class="has-submenu {{ Request::is('saller/vendor-acount') ||  Request::is('saller/vendor-config') ?'active':''}}"><i class="fa fa-university " aria-hidden="true"></i> Your Shop </p></a>
	<a href="{{route('member-logout')}}"><p><i class="fa fa-sign-out " aria-hidden="true"></i> Logout</p></a>
</div>