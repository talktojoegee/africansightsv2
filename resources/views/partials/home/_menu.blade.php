@inject('menus','App\View\DynamicMenu')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="">
            <div class="mobile-nav-toggle hidden-md hidden-lg">
                <a href="{{ route('homepage') }}" title="Menu">
                    <span><span></span><span></span></span>
                </a>
            </div>
            <div class="brand" style="padding: 35px 0px; height: auto; text-align: center; ">
                <a href="{{ route('homepage') }}">
                    <img height="100" width="160" src="/assets/images/logo.png" class="attachment-full size-full" alt="Culture tourist" decoding="async" loading="lazy" >
                </a>
                <h4 style="margin: 15px 0 0px 0px;">
                    ...sights and sounds of Africa
                </h4>
            </div>
        </div>
    </div>
</div>
<header id="header-container" class="no-shadow">
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
                    </button>
                </div>
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        <li><a class="{{ request()->routeIs('homepage') ? 'current' : ''}}" href="{{route('homepage')}}">Home</a></li>
                        @foreach($menus::getPrimaryMenu() as $menu)
                            <li><a class="{{ (request()->is('show-post-by-category')) ? 'current' : 'false ' }}" href="{{ route('show-post-by-category', $menu->slug) }}">{{$menu->category_name ?? '' }}</a></li>
                        @endforeach
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>
            <div class="right-side">
                <div class="header-widget">
                    <div class="user-menu">
                        <div class="user-name">
                            <a href="javascript:void(0);" >About us</a>
                        </div>
                        <ul>
                            <li><a href="#"><i class="im im-icon-Eye"></i>  African Sights</a></li>
                            <li><a href="#"><i class="im im-icon-Radio"></i> Media Services</a></li>
                            <li><a href="#"><i class="im im-icon-Money-Bag"></i> Contribute</a></li>
                            <li><a href="#"><i class="im im-icon-Shopping-Cart"></i> Shop</a></li>
                            <li><a href="#"><i class="im im-icon-Calendar"></i> Calendar</a></li>
                        </ul>
                    </div>

                    <a href="{{route('show-contact-us')}}" class="button border with-icon">Contact us <i class="sl sl-icon-envolope"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
