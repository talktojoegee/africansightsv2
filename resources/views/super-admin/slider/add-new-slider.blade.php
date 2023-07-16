@extends('layouts.super-admin-layout')
@section('current-page')
    Add New Slider
@endsection
@section('extra-styles')
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
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('add-new-slider')}}" method="post" autocomplete="off" id="addPropertyForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-header text-white bg-custom mb-2">Add New Slider
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Title <sup class="text-danger">*</sup></label>
                                <input type="text" placeholder="Title" name="title" id="title" value="{{old('title')}}" class="form-control">
                                <br> @error('title')<i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Button Link <small class="text-muted">(Optional)</small></label>
                                <input type="text" placeholder="Button Link" name="buttonLink" id="buttonLink" value="{{old('buttonLink')}}" class="form-control">
                                <br> @error('buttonLink')<i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Status <sup class="text-danger">*</sup></label> <br>
                                <select name="status" style="width: 300px;" id="status" class="form-control select2 select2-multiple ">
                                    <option value="1">Active</option>
                                    <option value="0">Deactivate</option>
                                </select>
                                <br> @error('status')<i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Description <sup class="text-danger">*</sup></label>
                                <textarea name="description" placeholder="Enter a brief description here." id="description" style="resize: none;" class="form-control">{{ old('description') }}</textarea>
                                <br> @error('description')<i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group">
                                <label for="">Image <sup class="text-danger">*</sup></label> <br>
                                <input type="file"  name="image"  class="form-control-file">
                                <br> @error('image')<i class="text-danger">{{$message}}</i>@enderror
                            </div>


                            <div class="col-md-12">
                                <div class="form-group d-flex justify-content-center mb-3 mt-2">
                                    <button type="submit" class="btn btn-custom btn-lg waves-effect waves-light"> Submit <i class="bx bxs-right-arrow ml-2"></i></button>
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
@endsection
