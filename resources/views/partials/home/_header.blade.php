<!DOCTYPE html>
<head>
    <title>{{config('app.name')}} | @yield('title')</title>
    @yield('meta-data')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '6501510113229349');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=6501510113229349&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
    <link rel="stylesheet" href="/home/css/style.css">
    <link rel="stylesheet" href="/home/css/main-color.css" id="colors">
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">
    <style>
        .star-rating img{
            width: 60px;display: inline-block;
            text-align: center;
            height: auto;
            border-radius: 50%;
            margin: 0 auto;
            border: 4px solid #fff;
            box-shadow: 0 2px 3px rgb(0 0 0 / 10%);
            box-sizing: content-box;
        }
       .js-cookie-consent-agree {
            width:100% !important; height:90px !important; background:#F91942 !important; color: #fff !important;
        }
    </style>
    @yield('extra-style')
</head>
