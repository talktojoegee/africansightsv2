@extends('layouts.super-admin-layout')
@section('current-page')
    Categories
@endsection
@section('title')
    Categories
@endsection
@section('extra-styles')

@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-custom text-white">Add New Category</div>
                <div class="card-body">
                    <form action="{{route('show-blog-categories')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Category Name <sup class="text-danger">*</sup></label>
                                    <input type="text" placeholder="Category Name" name="categoryName" value="{{old('categoryName')}}" class="form-control">
                                    @error('categoryName')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group d-flex justify-content-center mt-2">
                                    <button type="submit" class="btn btn-sm btn-custom w-50"><i class="ti-check mr-2"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-custom text-white">List of Categories</div>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="wd-15p">Date</th>
                                <th class="wd-15p">Category Name</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($categories as $cat)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{ date('d M, Y', strtotime($cat->created_at)) }}</td>
                                    <td>{{$cat->category_name ?? '' }}</td>
                                    <td>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#categoryModal_{{$cat->id}}" class="btn btn-custom">View <i class="bx bxs-eyedropper"></i> </a>
                                        <div id="categoryModal_{{$cat->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Edit Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('edit-category')}}" method="post" autocomplete="off">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Category Name <sup class="text-danger">*</sup></label>
                                                                        <input type="text" placeholder="Category Name" name="categoryName" value="{{old('categoryName', $cat->category_name)}}" class="form-control">
                                                                        @error('categoryName')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>
                                                                    <input type="hidden" name="categoryId" value="{{$cat->id}}">
                                                                    <div class="form-group d-flex justify-content-center mt-2">
                                                                        <button type="submit" class="btn btn-sm btn-custom w-50"><i class="ti-check mr-2"></i> Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
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
    </div>
@endsection

@section('extra-scripts')

@endsection
