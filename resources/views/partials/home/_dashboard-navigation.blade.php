<div class="dashboard-nav">
    <div class="dashboard-nav-inner">

        <ul data-submenu-title="Main">
            <li class="{{ request()->routeIs('residence-dashboard') ? 'active' : ''}}"><a href="{{route('residence-dashboard')}}"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
            <li class="{{request()->routeIs('my-messages') ? 'active' : '' }}"><a href="{{route('my-messages')}}"><i class="sl sl-icon-envelope-open"></i> Messages </a></li>
            <li class="{{ request()->routeIs('my-invoices') ? 'active' : ''}}"><a href="{{route('my-invoices')}}"><i class="im im-icon-Money-2"></i> Invoices </a></li>
            <li class="{{request()->routeIs('my-receipts') ? 'active' : '' }}"><a href="{{route('my-receipts')}}"><i class="im im-icon-Receipt-3"></i> Receipts</a></li>
        </ul>

        <ul data-submenu-title="Listings">
            <li><a><i class="im im-icon-Box-Full"></i> Work Order</a>
                <ul>
                    <li class="{{ request()->routeIs('my-new-work-order') ? 'active' : ''}}"><a href="{{route('my-new-work-order')}}">New Request</a></li>
                    <li class="{{ request()->routeIs('my-work-orders') ? 'active' : ''}}"><a href="{{route('my-work-orders')}}">Manage Requests </a></li>
                </ul>
            </li>
            <li class="{{ request()->routeIs('my-persons') ? 'active' : ''}}"><a href="{{route('my-persons')}}"><i class="im im-icon-Business-ManWoman"></i> Persons</a></li>
            <li class="{{ request()->routeIs('my-agreement') ? 'active' : ''}}"><a href="{{route('my-agreement')}}"><i class="fa fa-legal"></i> Agreement</a></li>
        </ul>

        <ul data-submenu-title="Account">
            <li><a href="{{route('residence-profile', ['account'=>$account, 'slug'=>Auth::user()->uuid])}}"><i class="sl sl-icon-user"></i> My Profile</a></li>
            <li><a href="{{route('logout')}}"><i class="sl sl-icon-power"></i> Logout</a></li>
        </ul>

    </div>
</div>
