<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title> {{config('app.name')}}  | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="App description goes here..." name="description" />
    <meta content="{{config('app.name')}}" name="PoweredBy" />
    <link rel="shortcut icon" href="/assets/drive/logo/{{Auth::user()->getTenant->logo ?? 'logo.png'}}">
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    @yield('extra-styles')

</head>
