@extends('layouts.homepage-layout')

@section('title')
    Contact us
@endsection

@section('main-content')
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Contact us</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('homepage')}}">Home</a></li>
                            <li>Contact us</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- Contact Details -->
            <div class="col-md-4">
                <h4 class="headline margin-bottom-30">Find Us There</h4>
                <!-- Contact Details -->
                <div class="sidebar-textbox">
                    <p>Collaboratively administrate channels whereas virtual. Objectively seize scalable metrics whereas proactive e-services.</p>
                    <ul class="contact-details">
                        <li><i class="im im-icon-Phone-2"></i> <strong>Phone:</strong> <span>+2348032404359 </span></li>
                        <li><i class="im im-icon-Globe"></i> <strong>Web:</strong> <span><a href="http://www.propertymanagerng.com/" target="_blank">https://www.propertymanagerng.com</a></span></li>
                        <li><i class="im im-icon-Envelope"></i> <strong>E-Mail:</strong> <span><a href="mailto:info@propertymanagerng.com">info@propertymanagerng.com</a></span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">

                <section id="contact" class="mb-3">
                    <h4 class="headline margin-bottom-35">Contact Form</h4>
                    @if(session()->has('success'))
                        <div class="notification success closeable">
                            <p><span>Success!</span> {!! session()->get('success') !!}</p>
                            <a class="close"></a>
                        </div>
                    @endif
                    <div id="contact-message"></div>
                    <form method="post" action="{{route('show-contact-us')}}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <input name="fullName" type="text" placeholder="Full Name"  value="{{old('fullName')}}"/>
                                    @error('fullName') <i class="text-danger">{{$message}}</i> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <input name="email" type="email" placeholder="Email Address" value="{{old('email')}}" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$"  />
                                    @error('email') <i class="text-danger">{{$message}}</i> @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <input name="subject" type="text" placeholder="Subject"  value="{{old('subject')}}"/>
                            @error('subject') <i class="text-danger">{{$message}}</i> @enderror
                        </div>
                        <div>
                            <textarea style="resize: none;" name="message" cols="40" rows="3" placeholder="Message" spellcheck="true" >{{old('comment')}}</textarea>
                            @error('message') <i class="text-danger">{{$message}}</i> @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="submit button">Submit Message</button>
                        <div class="mb-3" style="height: 30px;"></div>
                    </form>
                </section>
            </div>
            <!-- Contact Form / End -->

        </div>

    </div>
@endsection
