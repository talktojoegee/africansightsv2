@extends('layouts.super-admin-layout')
@section('current-page')
    Overview
@endsection
@section('title')
    Overview
@endsection
@section('extra-styles')

@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="row mt-3">
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-2 text-dark font-size-18">Last Year</p>
                            <h3 class="mb-0 number-font">{{number_format( $lastYear->count() )}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-2 text-primary font-size-18">This Year</p>
                            <h3 class="mb-0 number-font">{{number_format( $articles->count() )}}</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-2 font-size-18 text-info">Last Month</p>
                            <h3 class="mb-0 number-font">{{number_format( $lastMonth->count() )}}</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-2 text-success font-size-18">This Month</p>
                            <h3 class="mb-0 number-font">{{number_format( $currentMonth->count() )}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-8">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Recent Articles</h3></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="wd-15p">Date</th>
                                <th class="wd-15p">Title</th>
                                <th class="wd-15p">Author</th>
                                <th class="wd-15p">Category</th>
                                <th class="wd-15p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($recentArticles as $article)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{date('d M, Y', strtotime($article->created_at))}}</td>
                                    <td>{{ strlen($article->title) > 32 ? substr($article->title,0,29).'...' : $article->title }}</td>
                                    <td>{{$article->getAuthor->first_name ?? '' }} {{$article->getAuthor->last_name ?? '' }}</td>
                                    <td>
                                        @foreach($article->getFeaturedCategories as $cat)
                                            {{ $cat->getCategory->category_name ?? '' }},
                                        @endforeach
                                    </td>
                                    <td>

                                        <div class="btn-group">
                                            <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('read-article', $article->slug) }}"> <i class="bx bx-book-open text-info"></i> View Article</a>
                                                <a class="dropdown-item" href="{{route('edit-article', $article->slug)}}"> <i class="bx bx-pencil text-warning"></i> Edit Article</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-target="#deleteArticleModal_{{$article->id}}" data-bs-toggle="modal"> <i class="bx bxs-trash text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                        <div id="deleteArticleModal_{{$article->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Are you sure?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-wrap">This action cannot be undone. Are you sure you want to <span class="text-danger">delete</span> <strong><i>{{ $article->title ?? ''  }}</i></strong>?</p>
                                                        <form action="{{ route('delete-article') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="articleId" value="{{ $article->id }}">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Recent Comments</h3></div>
                <div class="card-body">
                    <div class="activity-block">
                        <ul class="task-list user-tasks">
                            @foreach($recentComments as $comment)
                            <li class="mt-3">
                                <h6>{{$comment->name ?? '' }} <sup class=" text-info fs-12"> commented on </sup>
                                </h6> <span class="text-muted fs-11">
                                    <a href="{{ route('read-article', $comment->getPost->slug) }}" target="_blank">{{$comment->getPost->title ?? '' }}</a>
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

@endsection
