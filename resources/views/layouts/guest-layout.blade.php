@include('partials.dump._header')
<body data-sidebar="dark">
<div id="layout-wrapper">
    <div class="main-content">
        <div class="page-content">
            <div class="container">

                @yield('main-content')

            </div>
        </div>

        @include('partials.dump._footer')
    </div>

</div>
@include('partials.dump._footer-scripts')
