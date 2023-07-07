@extends('layouts.super-admin-layout')
@section('current-page')
    Add New Article
@endsection
@section('extra-styles')
    <link href="/assets/summernote/summernote.min.css" rel="stylesheet">
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <form action="{{route('show-new-article')}}" method="post" autocomplete="off" id="addPropertyForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-header text-white bg-custom mb-2">Add New Article
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Title <sup class="text-danger">*</sup></label>
                                                <input type="text" placeholder="Title" name="title" id="title" value="{{old('title')}}" class="form-control">
                                                <br> @error('title')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Content</label>
                                                    <textarea name="postContent" id="summernote">{{old('postContent')}}</textarea>
                                                    @error('postContent') <i class="text-danger">{{$message}}</i> @enderror
                                                </div>
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
                                    <button type="submit" class="btn btn-custom btn-lg waves-effect waves-light"> Submit <i class="bx bx-plus ml-2"></i></button>
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
    <script src="/assets/summernote/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height:200,
               /* callbacks:{
                    onImageUpload:function (files, editor, welEditable) {
                        for(let i = files.length - 1; i>= 0; i--){
                            sendFiles(files[i], this);
                        }
                    }
                },*/
            });
        });
        function sendFiles(file, el){
            let formData = new FormData();
            formData.append('file', file);
            $.ajax({
                data: formData,
                type: "POST",
                url: "{{ route('upload-article-files') }}",
                cache: false,
                contentType: false,
                processData: false,
                success:function(url){
                    $(el).summernote('editor.insertImage', url);
                }
            });
        }
    </script>

@endsection
