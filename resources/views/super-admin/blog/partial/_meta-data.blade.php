<meta name="title" content="{{ $article->title ?? '' }}"/>
<meta name="keywords" content="{{ $article->keywords ?? substr(strip_tags($article->article_content),0,20) }}"/>
<meta name="description" content="{{ $article->meta_description ?? substr(strip_tags($article->article_content),0,180) }}"/>
<meta name="robots" content="index,follow"/>
<meta name="revisit-after" content="7 days">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">

<meta name="title" content="{{ $article->title }}">
<meta name="author" content="{{ env('APP_NAME')}}">
<meta name="url" content="{{ env('APP_URL') }}">

<meta name="og_image" content="/assets/drive/blog/{{  $article->featured_image ?? '' }}"/>
<meta name="og_secureImage" content="/assets/drive/blog/{{  $article->featured_image ?? '' }}"/>
<meta name="og_imageAlt" content="{{ $article->title }}"/>
{{--<meta name="og_imageType" content=" $meta->og_imageType }}"/>--}}

<meta name="rating" content="General">
<meta property=”og:title” content="{{ $article->title }}"/>
<meta property="og:description" content="{{ $article->meta_description ?? substr(strip_tags($article->article_content),0,50) }}"/>
{{--<meta property=”og:type” content=” $meta->og_type }}”/>--}}
<meta property="og:locale" content="en_us" />
<meta property="og:sitename" content="{{ env('APP_NAME') }}" />
<meta property="og:url" content="{{ env('APP_URL') }}"/>
<meta name="twitter:card" content="summary"/>
{{--<meta name="twitter:site" content=" setting('site.twitter_site') }}"/>
<meta name="twitter:creator" content=" setting('site.twitter_creator') }}"/>--}}
