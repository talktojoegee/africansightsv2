@extends('layouts.super-admin-layout')
@section('current-page')
    Manage Sliders
@endsection
@section('extra-styles')

@endsection
@section('breadcrumb-action-btn')
    Manage Sliders
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
        @foreach($sliders as $key=>$slide)
            <div class="col-xl-6">
                <div id="sliderModal_{{$slide->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('edit-slide')}}" method="post" autocomplete="off" id="addPropertyForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="card-header text-white bg-custom mb-2">Edit New Slider
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="">Title <sup class="text-danger">*</sup></label>
                                                <input type="text" placeholder="Title" name="title" id="title" value="{{old('title', $slide->caption)}}" class="form-control">
                                                <br> @error('title')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="">Button Link <small class="text-muted">(Optional)</small></label>
                                                <input type="text" placeholder="Button Link" name="buttonLink" id="buttonLink" value="{{old('buttonLink', $slide->link)}}" class="form-control">
                                                <br> @error('buttonLink')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="">Status <sup class="text-danger">*</sup></label> <br>
                                                <select name="status" style="width: 300px;" id="status" class="form-control ">
                                                    <option value="1" {{ $slide->status == 1 ? 'selected' : null }}>Active</option>
                                                    <option value="0" {{ $slide->status == 0 ? 'selected' : null }}>Deactivate</option>
                                                </select>
                                                <br> @error('status')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="">Description <sup class="text-danger">*</sup></label>
                                                <textarea name="description" placeholder="Enter a brief description here." id="description" style="resize: none;" class="form-control">{{ old('description', $slide->description) }}</textarea>
                                                <br> @error('description')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Image <sup class="text-danger">*</sup></label> <br>
                                                <input type="file"  name="image"  class="form-control-file">
                                                <br> @error('image')<i class="text-danger">{{$message}}</i>@enderror
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group d-flex justify-content-center mb-3 mt-2">
                                                    <input type="hidden" name="slideId" value="{{ $slide->id }}">
                                                    <button type="submit" class="btn btn-custom btn-lg waves-effect waves-light"> Save changes <i class="bx bxs-right-arrow ml-2"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleCaption" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active ">
                                    <img src="/assets/drive/cloud/{{$slide->attachment ?? 'slide.jpg'}}" alt="..." class="d-block img-fluid">
                                    <div class="carousel-caption d-none d-md-block text-white-50">
                                        <h5 class="text-white">{{$slide->caption ?? ''}}</h5>
                                        <p>{{$slide->description ?? ''}}</p>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaption" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="btn-group mt-2 float-end">
                            <button data-bs-target="#sliderModal_{{$slide->id}}" data-bs-toggle="modal" class="btn-warning btn-sm btn"> Edit <i class="bx bx-pencil"></i> </button>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection

@section('extra-scripts')




@endsection
