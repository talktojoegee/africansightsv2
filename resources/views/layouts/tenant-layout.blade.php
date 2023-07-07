@include('partials.home._header')
<body>
    <div id="wrapper">
        @include('partials.home._dashboard-menu')
        <div class="clearfix"></div>
        <div id="dashboard">
            <a href="javascript:void(0);" class="dashboard-responsive-nav-trigger">
                <i class="fa fa-reorder"></i> Dashboard Navigation
            </a>

            @include('partials.home._dashboard-navigation')
            <div class="dashboard-content">
                @include('partials.home._breadcrumb')
                @yield('dashboard-content')
                @include('partials.home._dashboard-footer')
            </div>
        </div>
    </div>
@include('partials.home._footer-script')

</body>
</html>
