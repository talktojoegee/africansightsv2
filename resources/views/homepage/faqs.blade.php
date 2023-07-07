@extends('layouts.homepage-layout')

@section('title')
    Frequently Asked Questions
@endsection

@section('main-content')
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>Frequently Asked Questions</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('homepage')}}">Home</a></li>
                            <li>FAQS</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row">
            @foreach($faqs as $faq)
                <div class="col-md-6 col-lg-6">
                    <div class="style-2">
                        <div class="toggle-wrap">
                            <span class="trigger"><a href="javascript:void(0);"><i class="sl sl-icon-pin"></i>{{$faq->question ?? '' }} <i class="sl sl-icon-plus"></i> </a></span>
                            <div class="toggle-container">
                                {!! $faq->answer ?? '' !!}
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
