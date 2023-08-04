@extends('layouts.homepage-layout')

@section('title')
    Blog Details
@endsection

@section('main-content')
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>{{$article->title ?? '' }}</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('homepage')}}">Home</a></li>
                            <li>Details</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
   <div class="container">
       <div class="row">
           @if(session()->has('success'))
               <div class="notification success closeable">
                   <p><span>Success!</span> {!! session()->get('success') !!}</p>
                   <a class="close"></a>
               </div>
           @endif
               @if(session()->has('error'))
                   <div class="notification warning closeable">
                       <p><span>Whoops!</span> {!! session()->get('error') !!}</p>
                       <a class="close"></a>
                   </div>
               @endif
           <div class="col-lg-9 col-md-8 padding-right-30">
               <div class="blog-post single-post">
                   <img class="post-img" src="/assets/drive/blog/{{$article->featured_image ?? 'featured_image.png'}}" alt="{{$article->title ?? '' }}">
                   <div class="post-content">
                       <ul class="post-meta">
                           <li>{{date('d M, Y', strtotime($article->created_at))}}</li>
                            @foreach($article->getFeaturedCategories as $cat)
                               <li><a href="#">{{$cat->getCategory->category_name ?? '' }}</a></li>
                           @endforeach
                       </ul>
                   {!! $article->article_content ?? ''  !!}
                       <div class="clearfix"></div>
                   </div>
               </div>
               <div class="clearfix"></div>
               <h4 class="headline margin-top-25">Related Posts</h4>
               <div class="row">
                @foreach($related->take(2) as $rel)
                   <div class="col-md-6">
                       <a href="{{route('view-blog', $rel->slug)}}" class="blog-compact-item-container">
                           <div class="blog-compact-item">
                               <img src="/assets/drive/blog/{{$rel->featured_image ?? 'featured_image.png' }}" alt="">
                               @foreach($rel->getFeaturedCategories as $cat)
                                   <span class="blog-item-tag">{{$cat->getCategory->category_name ?? '' }}</span>
                               @endforeach
                               <div class="blog-compact-item-content">
                                   <ul class="blog-post-tags">
                                       <li>{{date('d M, Y', strtotime($rel->created_at))}}</li>
                                   </ul>
                                   <h3>{{ strlen($rel->title) > 47 ? substr($rel->title,0,47).'...' : $rel->title }}</h3>
                                   <p>{{ strlen( strip_tags($rel->article_content)) > 116 ? substr(strip_tags($rel->article_content),0,47).'...' : strip_tags($rel->article_content) }}</p>
                               </div>
                           </div>
                       </a>
                   </div>
                @endforeach
               </div>
               <div class="margin-top-50"></div>
               <!-- Reviews -->
               <section class="comments">
                   <h4 class="headline margin-bottom-35">Comments <span class="comments-amount">({{count($article->getPostComments)}})</span></h4>
                   <ul>
                       @if(count($article->getPostComments) > 0)
                       @foreach($article->getPostComments as $comment)
                            <li>
                           <div class="avatar">
                               <img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70" alt="" /></div>
                           <div class="comment-content">
                               <div class="arrow-comment"></div>
                               <div class="comment-by">{{$comment->name ?? '' }}<span class="date">{{date('d M, Y', strtotime($comment->created_at))}}</span>
                               </div>
                               {{ $comment->comment }}
                           </div>

                       </li>
                       @endforeach
                       @else
                            <li style="text-align: center;">This article has no comment. Be the <strong>first</strong> to leave a comment on it!</li>
                       @endif
                   </ul>
               </section>
               <div class="clearfix"></div>
               <div id="add-review" class="add-review-box">
                   <h3 class="listing-desc-headline margin-bottom-35">Leave Comment</h3>
                   <form id="add-comment" class="add-comment" action="{{route('leave-comment')}}" method="post">
                       @csrf
                       <fieldset>
                           <div class="row">
                               <div class="col-md-6">
                                   <label>Name:</label>
                                   <input type="text" value="{{old('name')}}" name="name" placeholder="Full Name"/>
                                   @error('name') <i class="text-danger">{{$message}}</i> @enderror
                               </div>

                               <div class="col-md-6">
                                   <label>Email:</label>
                                   <input type="email" value="{{old('email')}}" name="email" placeholder="Email Address"/>
                                   @error('email') <i class="text-danger">{{$message}}</i> @enderror
                                   <input type="hidden" name="postId" value="{{$article->id}}">
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <label>What's the sum of {{$num1}} and {{$num2}}</label>
                                   <input type="number" value="{{old('sum')}}" name="sum" placeholder="What's the sum..."/>
                                   <input type="hidden" name="num1" value="{{$num1}}">
                                   <input type="hidden" name="num2" value="{{$num2}}">
                                   @error('sum') <i class="text-danger">{{$message}}</i> @enderror
                               </div>
                           </div>
                           <div>
                               <label>Comment:</label>
                               <textarea cols="40" rows="3" name="comment" placeholder="Type your comment here...">{{old('comment')}}</textarea>
                               @error('comment') <i class="text-danger">{{$message}}</i> @enderror
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

                       </fieldset>

                       <button class="button" type="submit">Submit Comment</button>
                       <div class="clearfix"></div>
                   </form>
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
@endsection
