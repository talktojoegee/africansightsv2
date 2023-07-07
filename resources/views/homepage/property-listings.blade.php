@extends('layouts.homepage-layout')

@section('title')
    Property Listings
@endsection

@section('main-content')
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Property Listings</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('homepage')}}">Home</a></li>
                            <li>Property Listings</li>
                        </ul>
                    </nav>
                </div>
                @if($search)
                    <div class="col-md-12">
                        <div class="notification notice closeable">
                            <p><span>Search result for: </span> {{$searchTerm ?? '' }}</p>
                            <a class="close"></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 padding-right-30">
                <div class="row">
                    @if(count($listings) > 0)
                        @foreach($listings as $list)
                            <div class="col-lg-12 col-md-12">
                                <div class="listing-item-container list-layout">
                                    <a href="{{route('get-property-details', $list->getProperty->slug)}}" class="listing-item">
                                        <div class="listing-item-image">
                                            <img src="/assets/drive/property/{{$list->getProperty->getGalleryFeaturedImageByPropertyId($list->property_id)->attachment}}" alt="{{$list->getProperty->property_name ?? '' }}">
                                            <span class="tag">{{$list->getProperty->getPropertyType->type_name ?? '' }}</span>
                                        </div>
                                        <div class="listing-item-content">
                                            @if($list->listing_type == 1)
                                                <div class="listing-badge now-open">For Lease </div>
                                            @else
                                                <div class="listing-badge now-closed">For Sale </div>
                                            @endif
                                            <div class="listing-item-inner">
                                                <h3>{{$list->getProperty->property_name ?? '' }}</h3>
                                                <span class=""><i class="im im-icon-Wallet-2 mr-2"></i> ₦{{number_format($list->listing_amount,2)}}</span> <br>
                                                <span><i class="im im-icon-Map-Marker2 mr-2"></i> {{$list->getProperty->getLocation->state_name ?? '' }} </span>
                                                <div class="star-rating" >
                                                    <i class="im im-icon-Administrator mr-2" title="Realtor"></i>
                                                    <span class="text-truncate">{{ $list->getTenant->company_name ?? '' }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 col-md-12">
                            <blockquote class="text-center">
                                Sorry, there are currently no listings. You should check back anytime soon.
                            </blockquote>
                        </div>
                    @endif
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        {!! $listings->links() !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="sidebar">
                    <form action="{{route('search-property-listings')}}" method="get">
                        @csrf
                        <div class="widget margin-bottom-40">
                            <h3 class="margin-top-0 margin-bottom-30">Filter</h3>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <input type="text" name="searchTerm" placeholder="What are you looking for?" value="{{old('searchTerm')}}"/>
                                    @error('searchTerm') <i class="text-danger">{{$message}}</i> @enderror
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <input type="number" name="budget" placeholder="Budget" value="{{old('budget', 5000)}}"/>
                                </div>
                                @error('budget') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <select data-placeholder="All Categories" name="location" class="chosen-select" >
                                        <option selected disabled>All Locations</option>
                                        @foreach($locations as $key=>$location)
                                            <option value="{{$location->id}}" {{$key == 0 ? 'selected' : ''}}>{{$location->state_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('location') <i class="text-danger">{{$message}}</i> @enderror
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="button fullwidth">Filter</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
