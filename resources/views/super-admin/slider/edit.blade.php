@extends('layouts.super-admin-layout')
@section('current-page')
    Edit Article
@endsection
@section('extra-styles')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('breadcrumb-action-btn')

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
    @if($errors->any())
        {!! implode('', $errors->all("<div class='text-danger'>:message</div>")) !!}
    @endif

    <div class="row">
        <div class="col-md-12 col-xl-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('save-article-changes')}}" method="post" autocomplete="off" id="addPropertyForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-header text-white bg-custom mb-2">Edit Article
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Title <sup class="text-danger">*</sup></label>
                                                <input type="text" placeholder="Title" name="title" id="title" value="{{old('title', $article->title)}}" class="form-control">
                                                <br> @error('title')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Content</label>
                                                    <textarea name="postContent" id="summernote">{{ old('postContent', $article->article_content) }}</textarea>
                                                    @error('postContent') <i class="text-danger">{{$message}}</i> @enderror
                                                </div>
                                                <input type="hidden" name="postId" value="{{$article->id}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 lg-12">
                                            <div class="form-group">
                                                <label for="">Category<sup class="text-danger">*</sup></label>
                                                <select class="form-control select2 select2-multiple " multiple name="category[]">
                                                    @foreach($categories as $key => $cat)
                                                        <option value="{{$cat->id}}" {{$key == 0 ? 'selected' : '' }}>{{$cat->category_name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                <br> @error('category')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                            <div class="form-group">
                                                <label for="">Featured Image <sup class="text-danger">*</sup></label> <br>
                                                <input type="file"  name="featuredImage"  class="form-control-file">
                                                <br> @error('featuredImage')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group d-flex justify-content-center mb-3 mt-2">
                                    <button type="submit" class="btn btn-custom btn-lg waves-effect waves-light"> Save changes <i class="bx bxs-right-arrow ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/js/pages/form-advanced.init.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    {{--<script src="/assets/summernote-image-attribute-editor.js"></script>--}}

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height:200,
                /*      imageAttributes: {
                          icon: '<i class="note-icon-pencil"/>',
                          figureClass: 'figureClass',
                          figcaptionClass: 'captionClass',
                          captionText: 'Caption Goes Here.',
                          manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
                      },
                      lang: 'en-US',
                      popover: {
                          image: [
                              ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                              ['float', ['floatLeft', 'floatRight', 'floatNone']],
                              ['remove', ['removeMedia']],
                              ['custom', ['imageAttributes']],
                          ],
                      },*/

            });
        });
    </script>


@endsection
