@extends('layouts.super-admin-layout')
@section('current-page')
    Manage Modules
@endsection
@section('title')
    Manage Modules
@endsection
@section('extra-styles')

@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-custom text-white">Add New Module</div>
                <div class="card-body">
                    <form action="{{route('show-app-modules')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Module Name <sup class="text-danger">*</sup></label>
                                    <input type="text" placeholder="Module Name" name="moduleName" value="{{old('moduleName')}}" class="form-control">
                                    @error('moduleName')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Area<sup class="text-danger">*</sup></label>
                                    <select name="area" id="area"
                                            class="form-control">
                                        <option value="0">General</option>
                                        <option value="1">Super-admin</option>
                                    </select>
                                    @error('area')<i class="text-danger">{{$message}}</i>@enderror
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
                <div class="card-header bg-custom text-white">{{config('app.name')}} Modules</div>
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
                                <th class="wd-15p">Module Name</th>
                                <th class="wd-15p">Area</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$module->module_name ?? '' }}</td>
                                    <td>
                                        @if($module->area == 0)
                                            <span class="text-info">General</span>
                                        @else
                                            <span class="text-danger">Super-admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#moduleModal_{{$module->id}}" class="btn btn-light">View <i class="bx bx-pencil text-custom"></i> </a>
                                        <div id="moduleModal_{{$module->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Edit Module</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('edit-app-module')}}" method="post" autocomplete="off">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Module Name <sup class="text-danger">*</sup></label>
                                                                        <input type="text" placeholder="Module Name" name="moduleName" value="{{old('moduleName', $module->module_name)}}" class="form-control">
                                                                        @error('moduleName')<i class="text-danger">{{$message}}</i>@enderror
                                                                        <input type="hidden" name="moduleId" value="{{$module->id}}">
                                                                    </div>
                                                                      <div class="form-group">
                                                                        <label for="">Area<sup class="text-danger">*</sup></label>
                                                                          <select name="area" id="area"
                                                                                  class="form-control">
                                                                              <option value="0">General</option>
                                                                              <option value="1">Super-admin</option>
                                                                          </select>
                                                                        @error('area')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>

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
