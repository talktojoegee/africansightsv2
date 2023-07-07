@include('partials.dump._header')
<body data-sidebar="dark">
<div id="layout-wrapper">
    @include('partials.dump._top-bar')
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            @include('partials.dump._sidebar')
        </div>
    </div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">@yield('current-page')</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item "><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">@yield('current-page')</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                @php $current = \Carbon\Carbon::now(); @endphp

                    @if( $current->diffInDays(Auth::user()->end_date) < 7)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Whoops!</strong>
                                    <p>We're reminded that your subscription to our <i class="text-custom">{{$plan->plan_name ?? '' }}</i> plan
                                        will expire on {{date('d M, Y', strtotime(Auth::user()->end_date))}}. That's <code>{{$current->diffInDays(Auth::user()->end_date)}} days </code>
                                        {{strtotime(now()) < strtotime(Auth::user()->end_date) ? 'from today' : ' since expiration' }}.
                                        <a href="{{route('show-subscription-plans', ['account'=>$account])}}" target="_blank">Click here </a> to renew or subscribe to a new plan.</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif

                @yield('main-content')

            </div>
        </div>

        @include('partials.dump._footer')
    </div>

</div>
@include('partials.dump._footer-scripts')
