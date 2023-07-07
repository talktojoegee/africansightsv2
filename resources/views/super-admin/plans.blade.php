@extends('layouts.super-admin-layout')
@section('current-page')
    Subscription Plans
@endsection
@section('title')
    Subscription Plans
@endsection
@section('extra-styles')

@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-custom text-white">Add New Subscription Plan</div>
                <div class="card-body">
                    <form action="{{route('show-plans')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Plan Name <sup class="text-danger">*</sup></label>
                                    <input type="text" placeholder="Plan Name" name="planName" value="{{old('planName')}}" class="form-control">
                                    @error('planName')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Duration <small>(In Days)</small> <sup class="text-danger">*</sup></label>
                                    <input type="number" placeholder="Duration" name="duration" value="{{old('duration')}}" class="form-control">
                                    @error('duration')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Amount <sup class="text-danger">*</sup></label>
                                    <input type="number" step="0.01" placeholder="Amount" name="amount" value="{{old('amount')}}" class="form-control">
                                    @error('amount')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="status" type="checkbox" id="statusId">
                                    <label class="form-check-label" for="status">Active?</label>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" style="resize: none" placeholder="Brief description of this subscription plan..." class="form-control">{{old('description')}}</textarea>
                                    @error('description') <i class="text-danger mt-2">{{$message}}</i>@enderror
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
                <div class="card-header bg-custom text-white">List of Subscription Plans</div>
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
                                <th class="wd-15p">Plan Name</th>
                                <th class="wd-15p">Duration</th>
                                <th class="wd-15p">Amount</th>
                                <th class="wd-15p">Status</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($plans as $plan)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$plan->plan_name ?? '' }}</td>
                                    <td>{{$plan->duration ?? '' }}</td>
                                    <td style="text-align: right">₦{{ number_format($plan->amount,2) }}</td>
                                    <td>{!! $plan->status == 1 ? "<label class='text-custom'>Active</label>" : "<label class='text-secondary'>Inactive</label>" !!}</td>
                                    <td>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#planModal_{{$plan->id}}" class="btn btn-custom">View <i class="bx bxs-eyedropper"></i> </a>
                                        <div id="planModal_{{$plan->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Edit Plan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('edit-plan')}}" method="post" autocomplete="off">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Plan Name <sup class="text-danger">*</sup></label>
                                                                        <input type="text" placeholder="Plan Name" name="planName" value="{{old('planName', $plan->plan_name)}}" class="form-control">
                                                                        @error('planName')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>
                                                                    <div class="form-group mt-2">
                                                                        <label for="">Duration <small>(In Days)</small> <sup class="text-danger">*</sup></label>
                                                                        <input type="number" placeholder="Duration" name="duration" value="{{old('duration',$plan->duration)}}" class="form-control">
                                                                        @error('duration')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>
                                                                    <div class="form-group mt-2">
                                                                        <label for="">Amount <sup class="text-danger">*</sup></label>
                                                                        <input type="number" step="0.01" placeholder="Amount" name="amount" value="{{old('amount', $plan->amount)}}" class="form-control">
                                                                        @error('amount')<i class="text-danger">{{$message}}</i>@enderror
                                                                        <input type="hidden" name="planId" value="{{$plan->id}}">
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="status" type="checkbox" id="statusId" {{$plan->status == 1 ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="status">Active?</label>
                                                                    </div>
                                                                    <div class="form-group mt-2">
                                                                        <label for="">Description</label>
                                                                        <textarea name="description" id="description" cols="30" rows="10" style="resize: none" placeholder="Brief description of this subscription plan..." class="form-control">{{old('description',$plan->description)}}</textarea>
                                                                        @error('description') <i class="text-danger mt-2">{{$message}}</i>@enderror
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
