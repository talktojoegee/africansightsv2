@extends('layouts.homepage-layout')

@section('title')
    Blog
@endsection

@section('main-content')
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h3>Showing posts in <mark class="color mr-2" style="padding: 3px; font-size: 18px;">{{$category->category_name ?? '' }} </mark> &nbsp; category</h3>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('homepage')}}">Home</a></li>
                            <li>Latest Articles</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="blog-page">
            <div class="row">
                <div class="col-lg-9 col-md-8 padding-right-30">
                    @if(count($articles) > 0)
                        <div class="row">
                            @foreach($articles as $article)
                                <div class="col-md-6 col-lg-6">
                                    <div class="blog-post">
                                        <a href="{{route('view-blog',$article->slug)}}" class="post-img">
                                            <img src="/assets/drive/blog/{{$article->featured_image ?? 'featured_image.png'}}" style="height: 278px;" alt="{{ $article->title ?? ''  }}">
                                        </a>
                                        <div class="post-content">
                                            <h3><a href="{{route('view-blog',$article->slug)}}">{{ strlen($article->title) > 47 ? substr($article->title,0,47).'...' : $article->title }} </a></h3>

                                            <ul class="post-meta">
                                                <li>{{date('d M, Y', strtotime($article->created_at))}}</li>
                                                @foreach($article->getFeaturedCategories as $cat)
                                                    <span class="blog-item-tag">{{$cat->getCategory->category_name ?? '' }}</span>
                                                @endforeach
                                                <li><a href="{{route('view-blog',$article->slug)}}">{{count($article->getPostComments)}} Comments</a></li>
                                            </ul>
                                            <p>{{ strlen( strip_tags($article->article_content)) > 116 ? substr(strip_tags($article->article_content),0,47).'...' : strip_tags($article->article_content) }}</p>
                                            <a href="{{route('view-blog',$article->slug)}}" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="blog-post">
                            <div class="post-content text-center">
                                There are currently <strong>no articles</strong> in the selected category
                            </div>
                        </div>
                    @endif

                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $articles->links() !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar right">
                        <!-- Widget -->
                        <div class="widget">
                            <h3 class="margin-top-0 margin-bottom-25">Search Blog</h3>
                            <form action="{{route('search-article')}}" method="get">
                                @csrf
                                <div class="search-blog-input">
                                    <div class="input">
                                        <input class="search-field" name="searchTerm" type="text" placeholder="Type and hit enter" value="{{old('searchTerm')}}"/>
                                        @error('searchTerm') <i class="text-danger">{{$message}}</i> @enderror
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget margin-top-40">
                            <h3>Got any questions?</h3>
                            <div class="info-box margin-bottom-10">
                                <p>Having any questions? Feel free to ask!</p>
                                <a href="mailto:contact@propertymanagerng.com" class="button fullwidth margin-top-20"><i class="fa fa-envelope-o"></i> Drop Us a Line</a>
                            </div>
                        </div>
                        <div class="widget margin-top-40">
                            <h3>Categories</h3>
                            <ul class="list-1">
                                @foreach($categories->take(10) as $cat)
                                    <li><a href="{{ route('show-post-by-category', $cat->slug) }}">{{$cat->category_name ?? '' }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <div class="margin-bottom-40"></div>
                        <div class="widget margin-top-40">
                            <h3>Popular Posts</h3>
                            <ul class="widget-tabs">
                                @foreach($populars as $pop)
                                    <li>
                                        <div class="widget-content">
                                            <div class="widget-thumb">
                                                <a href="{{route('view-blog', $pop->slug)}}">
                                                    <img src="/assets/drive/blog/{{$pop->featured_image ??'featured_image.png'}}" alt=""></a>
                                            </div>

                                            <div class="widget-text">
                                                <h5><a href="{{route('view-blog', $pop->slug)}}">{{ strlen($pop->title) > 47 ? substr($pop->title,0,47).'...' : $pop->title }}</a></h5>
                                                <span>{{date('d M, Y', strtotime($pop->created_at))}}</span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <div class="margin-bottom-40"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
