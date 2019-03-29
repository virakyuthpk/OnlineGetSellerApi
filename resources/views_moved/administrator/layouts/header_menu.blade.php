 <!-- Header -->
<header class="top-head container-fluid">
    <button type="button" class="navbar-toggle pull-left">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <!-- Right navbar -->
    <ul class="list-inline navbar-right top-menu top-right-menu">
        <!-- user login dropdown start-->
        <li class="dropdown text-center">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="username">{{Auth::user()->username}}</span> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                <li><a href="{{route('admin-logout')}}"><i class="fa fa-sign-out"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->       
    </ul>
    <!-- End right navbar -->

</header>
<!-- Header Ends -->