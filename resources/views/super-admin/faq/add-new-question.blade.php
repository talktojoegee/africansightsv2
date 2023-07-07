@extends('layouts.super-admin-layout')
@section('title')
    Add New FAQ
@endsection
@section('current-page')
    Add New FAQ
@endsection
@section('extra-styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                    <form action="{{route('show-new-faq')}}" method="post" autocomplete="off" id="addPropertyForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-header text-white bg-custom mb-2">Add New Question
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 lg-12">
                                <div class="form-group">
                                    <label for="">Question <sup class="text-danger">*</sup></label>
                                    <textarea name="question" style="resize: none;" placeholder="Type question here..." class="form-control">{{old('question')}}</textarea>
                                    <br> @error('question')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">Answer</label>
                                        <div id="editor" style="height: 250px;"></div>
                                        <textarea name="answer" id="hiddenContent" style="display: none">{{old('hiddenContent')}}</textarea>
                                        @error('answer') <i class="text-danger">{{$message}}</i> @enderror
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(document).ready(function(){
            let options = {
                placeholder: 'Type answer to the question here...',
                theme: 'snow'
            };
            let quill = new Quill('#editor', options);
            $('#addPropertyForm').on('submit',function(){
                $('#hiddenContent').val(quill.root.innerHTML);
            })
        });
    </script>
@endsection
