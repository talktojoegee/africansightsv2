@extends('layouts.super-admin-layout')
@section('current-page')
    Manage Permissions
@endsection
@section('title')
    Manage Permissions
@endsection
@section('extra-styles')
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-custom text-white">Add New Permission</div>
                <div class="card-body">
                    <form action="{{route('show-app-permissions')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Permission Name <sup class="text-danger">*</sup></label>
                                    <input type="text" placeholder="Permission Name" name="name" value="{{old('name')}}" class="form-control">
                                    @error('name')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Module<sup class="text-danger">*</sup></label>
                                    <select name="module" id="module"
                                            class="form-control select2 ">
                                        @foreach($modules as $module)
                                        <option value="{{$module->id}}">{{$module->module_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('module')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">Guard<sup class="text-danger">*</sup></label>
                                    <select name="guard" id="guard"
                                            class="form-control">
                                        <option value="web">Web</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('guard')<i class="text-danger">{{$message}}</i>@enderror
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
                        <table id="datatable" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="wd-15p">Module</th>
                                <th class="wd-15p">Permission Name</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$permission->getModule->module_name ?? '' }}</td>
                                    <td>{{$permission->name ?? '' }}</td>
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
                                                        <form action="{{route('edit-app-permission')}}" method="post" autocomplete="off">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Permission Name <sup class="text-danger">*</sup></label>
                                                                        <input type="text" placeholder="Permission Name" name="name" value="{{old('name', $permission->name)}}" class="form-control">
                                                                        @error('name')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label for="">Module<sup class="text-danger">*</sup></label>
                                                                        <select name="module" id="module"
                                                                                class="form-control">
                                                                            @foreach($modules as $module)
                                                                                <option value="{{$module->id}}" {{ $module->id == $permission->module_id ? 'selected' : ''  }}>{{$module->module_name ?? '' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('module')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>
                                                                    <div class="form-group mt-3">
                                                                        <label for="">Guard<sup class="text-danger">*</sup></label>
                                                                        <select name="guard" id="guard"
                                                                                class="form-control">
                                                                            <option value="web" {{$permission->guard_name == 'web' ? 'selected' : '' }}>Web</option>
                                                                            <option value="admin" {{$permission->guard_name == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                        </select>
                                                                        @error('guard')<i class="text-danger">{{$message}}</i>@enderror
                                                                        <input type="hidden" name="permissionId" value="{{$permission->id}}">
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
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/js/pages/form-advanced.init.js"></script>
@endsection
