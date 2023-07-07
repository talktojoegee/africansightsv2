@extends('layouts.homepage-layout')

@section('title')
    Property Details
@endsection

@section('main-content')

    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-lg-8 col-md-8 padding-right-30">
                <div id="titlebar" class="listing-titlebar">
                    <div class="listing-titlebar-title">
                        <h2>{{$property->property_name ?? '' }}<span class="listing-tag">{{$property->getPropertyType->type_name ?? '' }}</span></h2>
                        <span>
						<a href="listings-single-page-2.html#listing-location" class="listing-address">
							<i class="fa fa-map-marker"></i>
							{{$property->getLocation->state_name ?? '' }}
						</a>
					</span>
                        <div class="star-rating">
                            <div class="">
                                <span class="listing-tag" style="font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif">₦{{number_format($listing->listing_amount,2)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="notification success closeable">
                        <p><span>Success!</span> {!! session()->get('success') !!}</p>
                        <a class="close"></a>
                    </div>
                @endif
                <!-- Listing Nav -->
                <div id="listing-nav" class="listing-nav-container">
                    <ul class="listing-nav">
                        <li><a href="listings-single-page-2.html#listing-overview" class="active">Overview</a></li>
                        <li><a href="listings-single-page-2.html#listing-gallery">Gallery</a></li>
                    </ul>
                </div>
                <div id="listing-overview" class="listing-section">
                    <ul class="apartment-details">
                        <li>{{$property->no_of_rooms ?? 0}} rooms</li>
                        <li>{{$property->no_of_sitting_rooms ?? 0}} sitting rooms</li>
                    </ul>
                    {!! $property->description ?? ''  !!}

                    <div class="clearfix"></div>
                    <!-- Amenities -->
                    <h3 class="listing-desc-headline">Features</h3>
                    <ul class="listing-features">
                        <li>{!! $property->kitchen == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Kitchen</li>
                        <li>{!! $property->dryer == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Dryer</li>
                        <li>{!! $property->borehole == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Borehole</li>
                        <li>{!! $property->pool == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Pool</li>
                        <li>{!! $property->security == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Security</li>
                        <li>{!! $property->car_park == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Car Park</li>
                        <li>{!! $property->garage == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Garage</li>
                        <li>{!! $property->laundry == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Laundry</li>
                        <li>{!! $property->store_room == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Store Room</li>
                        <li>{!! $property->balcony == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Balcony</li>
                        <li>{!! $property->elevator == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Elevator</li>
                        <li>{!! $property->play_ground == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Play Ground</li>
                        <li>{!! $property->lounge == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Lounge</li>
                        <li>{!! $property->washer == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Washer</li>
                        <li>{!! $property->air_conditioning == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Air Conditioning</li>
                        <li>{!! $property->carbon_monoxide_alarm == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Smoke Alarm</li>
                        <li>{!! $property->tv == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Television</li>
                        <li>{!! $property->wifi == 1 ? "<i class='sl sl-icon-check text-success'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!} Wifi</li>
                    </ul>
                </div>
                <!-- Slider -->
                <div id="listing-gallery" class="listing-section">
                    <h3 class="listing-desc-headline margin-top-70">Gallery</h3>
                    <div class="listing-slider-small mfp-gallery-container margin-bottom-0">
                        @foreach($property->getPropertyGalleryImages as $gallery)
                            <a href="/assets/drive/property/{{$gallery->attachment ?? ''}}" data-background-image="/assets/drive/property/{{$gallery->attachment ?? ''}}" class="item mfp-gallery" title="{{$property->property_name ?? '' }}"></a>
                        @endforeach
                    </div>
                </div>
                <!-- Add Review Box -->
                <div id="add-review" class="add-review-box">

                    <h3 class="listing-desc-headline margin-bottom-10">Send Message</h3>
                    <p class="comment-notes">Your email address will not be published.</p>
                    <form id="add-comment" class="add-comment" action="{{route('send-message')}}" method="post">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Full Name:</label>
                                    <input type="text" name="fullName" value="{{old('fullName')}}" placeholder="Full Name"/>
                                    @error('fullName') <i class="text-danger">{{$message}}</i> @enderror
                                </div>
                                <input type="hidden" name="tenantId" value="{{$property->tenant_id}}">
                                <div class="col-md-6">
                                    <label>Email Address:</label>
                                    <input type="text" name="email" placeholder="Email Address" value="{{old('email')}}"/>
                                    @error('email') <i class="text-danger">{{$message}}</i> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Subject:</label>
                                    <input type="text"  placeholder="Subject" name="subject" value="{{old('subject')}}"/>
                                    @error('subject') <i class="text-danger">{{$message}}</i> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No.:</label>
                                    <input type="text" value="{{old('mobileNo')}}" name="mobileNo" placeholder="Mobile No."/>
                                    @error('mobileNo') <i class="text-danger">{{$message}}</i> @enderror
                                </div>
                            </div>

                            <div>
                                <label>Message:</label>
                                <textarea style="resize: none;" cols="40" rows="3" name="message" placeholder="Message {{$property->getRealtor->company_name ?? '' }}">{{old('message')}}</textarea>
                                @error('message') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            @error('g-recaptcha-response')
                            <i class="text-danger">{{$message}}</i>
                            @enderror
                        </fieldset>

                        <button class="button" type="submit">Submit Message</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 margin-top-75 sticky">
                <div class="verified-badge with-tip" data-tip-content="Listing belongs to the business owner or manager.">
                    <i class="im im-icon-Business-Man"></i> Realtor
                    <div class="tip-content" style="width: 373.328px; max-width: 373.328px;">Listing belongs to the business owner or manager.
                    </div>
                </div>
                <div class="boxed-widget margin-top-35">
                    <div class="hosted-by-title">
                        <h4>
                            <a href="#">{{$property->getRealtor->company_name ?? '' }}</a>
                        </h4>
                        <a href="#" class="hosted-by-avatar"><img src="/assets/drive/logo/{{$property->getRealtor->logo ?? 'logo.png' }}" alt="{{$property->getRealtor->company_name ?? '' }}"></a>
                    </div>
                    <ul class="listing-details-sidebar">
                        <li><i class="sl sl-icon-phone"></i> {{$property->getRealtor->phone_no ?? '' }}</li>
                        <li><i class="fa fa-envelope-o"></i>
                            <a href="mailto:{{$property->getRealtor->email ?? '' }}">{{$property->getRealtor->email ?? '' }}</a>
                        </li>
                    </ul>
                    <ul class="listing-details-sidebar social-profiles">
                        <li><a href="{{$property->getRealtor->facebook ?? env('FACEBOOK_HANDLER') }}" target="_blank" class="facebook-profile"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                        <li><a href="{{$property->getRealtor->twitter ?? env('TWITTER_HANDLER') }}" target="_blank" class="twitter-profile"><i class="fa fa-twitter"></i> Twitter</a></li>
                        <li><a href="{{$property->getRealtor->instagram ?? env('INSTAGRAM_HANDLER') }}" target="_blank" class="twitter-profile"><i class="fa fa-instagram"></i> Instagram</a></li>
                    </ul>
                    <!-- Reply to review popup -->
                    <a href="{{url()->current()}}#add-review" class="send-message-to-owner button">
                        <i class="sl sl-icon-envelope-open"></i> Send Message
                    </a>
                </div>
                <div class="listing-share margin-top-40 margin-bottom-40 no-border">
                    <ul class="share-buttons margin-top-40 margin-bottom-0">
                        <li><a class="fb-share" href="{{env('FACEBOOK_HANDLER')}}" target="_blank"><i class="fa fa-facebook"></i> Share</a></li>
                        <li><a class="twitter-share" href="{{env('TWITTER_HANDLER')}}" target="_blank"><i class="fa fa-twitter"></i> Tweet</a></li>
                        <li><a class="gplus-share" href="{{env('INSTAGRAM_HANDLER')}}" target="_blank"><i class="fa fa-instagram"></i> Share</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <form action="{{route('submit-lease-application')}}" method="post">
                    @csrf
                    <div id="booking-widget-anchor" class="boxed-widget booking-widget margin-top-35">
                        <h3><i class="im im-icon-Box-Full "></i> Lease Application</h3>
                        <div class="row with-forms  margin-top-0">
                            <div class="col-lg-12">
                                <input type="text" name="firstName" value="{{old('firstName')}}" placeholder="First Name" >
                                @error('firstName') <i class="text-danger">{{$message}}</i> @enderror
                                <input type="hidden" name="listingId" value="{{$listing->id}}">
                                <input type="hidden" name="leasePeriod" value="{{$listing->frequency}}">
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="lastName" value="{{old('lastName')}}" placeholder="Surname" >
                                @error('lastName') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="email" value="{{old('email')}}" placeholder="Email Address" >
                                @error('email') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="mobileNo" value="{{old('mobileNo')}}" placeholder="Mobile No." >
                                @error('mobileNo') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="col-12">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                    <i class="text-danger">{{$message}}</i>
                                    @enderror
                            </div>
                            <div class="col-lg-12" style="margin-top:100px;">
                                <button type="submit" class="button book-now fullwidth margin-top-5">Submit Application</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>

        </div>
    </div>

@endsection
