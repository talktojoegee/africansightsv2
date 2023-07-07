<!DOCTYPE html>
<head>
    <title>{{config('app.name')}} | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/home/css/style.css">
    <link rel="stylesheet" href="/home/css/main-color.css" id="colors">
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
    </style>
    @yield('extra-style')
</head>