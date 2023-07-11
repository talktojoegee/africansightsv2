@include('partials.home._header')
<body>
<div id="wrapper">
    @include('partials.home._menu')

    @yield('main-content')


   @include('partials.home._footer-note')

</div>

@include('partials.home._footer-script')

</body>
</html>
