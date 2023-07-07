<header id="header-container" class="fixed fullwidth dashboard">
    <div id="header" class="not-sticky">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="{{route('residence-dashboard')}}"><img src="/home/images/logo.png" alt=""></a>
                    <a href="{{route('residence-dashboard')}}" class="dashboard-logo"><img src="/home/images/logo2.png" alt=""></a>
                </div>
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
                    </button>
                </div>
                <nav id="navigation" class="style-1">
                    <ul id="responsive">

                        <li><a href="javascript:void(0);">Menu</a>
                            <ul>
                                <li><a href="{{route('residence-dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('my-messages')}}">Messages</a></li>
                                <li><a href="{{route('my-invoices')}}">Invoices</a></li>
                                <li><a href="{{route('my-receipts')}}">Receipts</a></li>
                                <li><a href="{{route('my-work-orders')}}">Work Orders</a></li>
                                <li><a href="{{route('my-agreement')}}">Agreement</a></li>
                                <li><a href="{{route('residence-profile', ['account'=>$account, 'slug'=>Auth::user()->uuid])}}">My Profile</a></li>
                                <li><a href="{{route('logout')}}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="clearfix"></div>

            </div>
            <div class="right-side">
                <div class="header-widget">
                    <div class="user-menu">
                        <div class="user-name"><span>
                                <img src="/assets/drive/avatar/{{Auth::user()->image ?? 'avatar.png'}}" alt=""></span>My Account</div>
                        <ul>
                            <li><a href="{{route('residence-dashboard')}}"><i class="sl sl-icon-briefcase"></i> Dashboard</a></li>
                            <li><a href="{{route('residence-profile', ['account'=>$account, 'slug'=>Auth::user()->uuid])}}"><i class="sl sl-icon-user"></i> Profile</a></li>
                            <li><a href="{{route('my-messages')}}"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
                            <li><a href="dashboard-bookings.html"><i class="im im-icon-Gear"></i> Settings</a></li>
                            <li><a href="{{route('logout')}}"><i class="sl sl-icon-power"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
