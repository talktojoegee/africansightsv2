@extends('layouts.super-admin-layout')
@section('current-page')
    Article Details
@endsection
@section('extra-styles')
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('breadcrumb-action-btn')
    Article Details
@endsection

@section('main-content')
    @if(session()->has('success'))
        <div class="row" role="alert">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>

                            {!! session()->get('success') !!}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="pt-3">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <div>
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <a href="javascript: void(0);" class="badge bg-light font-size-12">
                                                <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> Title
                                            </a>
                                        </div>
                                        <h4>{{$article->title ?? '' }}</h4>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>
                                                    <p class="text-muted mb-2">Categories</p>
                                                    <h5 class="font-size-15">
                                                        @foreach($article->getFeaturedCategories as $cat)
                                                            {{$cat->getCategory->category_name ?? '' }},
                                                        @endforeach
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <p class="text-muted mb-2">Date</p>
                                                    <h5 class="font-size-15">{{date('d M, Y', strtotime($article->created_at))}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <p class="text-muted mb-2">Post by</p>
                                                    <h5 class="font-size-15">{{$article->getAuthor->first_name ?? '' }} {{$article->getAuthor->last_name ?? '' }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="my-5">
                                        <img src="/assets/drive/blog/{{$article->featured_image ?? 'featured_image.png'}}" alt="" class="img-thumbnail mx-auto d-block">
                                    </div>

                                    <hr>

                                    <div class="mt-4">
                                        {!! $article->article_content ?? ''  !!}

                                        <hr>

                                        <div class="mt-5">
                                            <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Comments :</h5>

                                            <div>
                                                @if(count($article->getPostComments) > 0)
                                                    @foreach($article->getPostComments as $comment)
                                                         <div class="d-flex py-3">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-xs">
                                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                                        <i class="bx bxs-user"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="font-size-14 mb-1">{{$comment->name ?? '' }} <small class="text-muted float-end">{{ \Carbon\Carbon::create($comment->created_at)->diffForHumans()}}</small></h5>
                                                                <p class="text-muted">
                                                                    @if($comment->status == 0)
                                                                        <sup><i class="mdi mdi-timer-sand text-info"></i> </sup>
                                                                    @elseif($comment->status == 1)
                                                                        <sup><i class="mdi mdi-check text-success"></i></sup>
                                                                    @elseif($comment->status == 2)
                                                                        <sup><i class="mdi mdi-close text-danger"></i></sup>
                                                                    @endif {{ $comment->comment ?? '' }}
                                                                </p>
                                                                <div>
                                                                    @if($comment->status == 0)
                                                                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#approveModal_{{$comment->id}}" class="text-success"><i class="mdi mdi-check"></i> Approve</a> &nbsp;&nbsp;
                                                                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#declineModal_{{$comment->id}}" class="text-danger ml-4"><i class="mdi mdi-close"></i> Decline</a>
                                                                    @endif
                                                                    @if($comment->status == 1)
                                                                            <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#declineModal_{{$comment->id}}" class="text-danger ml-4"><i class="mdi mdi-close"></i> Decline</a>
                                                                    @elseif($comment->status == 2)
                                                                            <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#approveModal_{{$comment->id}}" class="text-success"><i class="mdi mdi-check"></i> Approve</a>
                                                                    @endif
                                                                        <div id="approveModal_{{$comment->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="myModalLabel">Are you sure?</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p class="text-wrap">Are you sure you want to approve this comment?</p>
                                                                                        <form action="{{ route('action-article-comment') }}" method="post">
                                                                                            @csrf
                                                                                            <input type="hidden" name="commentId" value="{{ $comment->id }}">
                                                                                            <input type="hidden" name="status" value="1">
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                                                                                                <button type="submit" class="btn btn-success waves-effect waves-light">Approve</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div id="declineModal_{{$comment->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="myModalLabel">Are you sure?</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p class="text-wrap">Are you sure you want to decline this comment?</p>
                                                                                        <form action="{{ route('action-article-comment') }}" method="post">
                                                                                            @csrf
                                                                                            <input type="hidden" name="commentId" value="{{ $comment->id }}">
                                                                                            <input type="hidden" name="status" value="2">
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                                                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Decline</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>


@endsection

@section('extra-scripts')


@endsection
