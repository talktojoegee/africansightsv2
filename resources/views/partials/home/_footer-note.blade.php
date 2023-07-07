@inject('menus','App\View\DynamicMenu')
<div id="footer" class="sticky-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-6">
                <img class="footer-logo" src="/assets/images/logo.png" alt="African Sights" style="width: 92px; height: 160px;">
                <br><br>
                <p>{{env('APP_DESCRIPTION')}}</p>
            </div>
            <div class="col-md-4 col-sm-6 ">
                <h4>Helpful Links</h4>
                <ul class="footer-links">
                    <li><a href="{{route('homepage')}}">Home</a></li>
                    <li><a href="{{route('register')}}">African Sights</a></li>
                    <li><a href="{{route('general-login')}}">Media Services</a></li>
                    <li><a href="{{route('general-login')}}">Contribute</a></li>
                    <li><a href="{{route('show-contact-us')}}">Shop</a></li>
                    <li><a href="{{route('show-contact-us')}}">Calendar</a></li>
                </ul>
                <ul class="footer-links">
                @foreach($menus::getPrimaryMenu() as $menu)
                        <li><a class="" href="{{ route('show-post-by-category', $menu->slug) }}">{{$menu->category_name ?? '' }}</a></li>
                    @endforeach
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-3  col-sm-12">
                <h4>Contact Us</h4>
                <div class="text-widget">
                    <i class="im im-icon-Map-Marker2"></i> <span>{{env('APP_ADDRESS')}}</span> <br>
                    <i class="im im-icon-Smartphone-4"></i> <span>{{env('APP_PHONE')}}</span><br>
                    <i class="im im-icon-At-Sign"></i> <span> <a href="mailto:{{env('APP_EMAIL')}}">{{env('APP_EMAIL')}}</a> </span><br>
                </div>
                <ul class="social-icons margin-top-20">
                    <li><a class="facebook" href="{{env('FACEBOOK_HANDLER')}}" target="_blank"><i class="icon-facebook"></i></a></li>
                    <li><a class="twitter" href="{{env('TWITTER_HANDLER')}}" target="_blank"><i class="icon-twitter"></i></a></li>
                    <li><a class="vimeo" href="{{env('INSTAGRAM_HANDLER')}}" target="_blank"><i class="icon-instagram"></i></a></li>
                </ul>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyrights">&copy; {{date('Y')}} {{config('app.name')}}. All Rights Reserved.</div>
            </div>
        </div>

    </div>

</div>
<div id="backtotop"><a href="{{route('homepage')}}#"></a></div>
