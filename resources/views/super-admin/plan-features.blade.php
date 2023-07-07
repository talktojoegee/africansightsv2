@extends('layouts.super-admin-layout')
@section('current-page')
     Plans Features
@endsection
@section('title')
     Plans Features
@endsection
@section('extra-styles')

@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-custom text-white">Add New Plan Features</div>
                <div class="card-body">
                    <form action="{{route('show-plan-features')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Subscription Plan</label>
                                    <select name="planId" id="plan" class="form-control">
                                        <option selected disabled>--Select plan--</option>
                                        @foreach($plans as $pl)
                                            <option value="{{$pl->id}}">{{$pl->plan_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('planId')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Number of Users <sup class="text-danger">*</sup></label>
                                    <input type="number" placeholder="Number of Users" name="noOfUsers" value="{{old('noOfUsers')}}" class="form-control">
                                    @error('noOfUsers')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Number of Properties <sup class="text-danger">*</sup></label>
                                    <input type="number" placeholder="Number of Properties" name="noOfProperties" value="{{old('noOfProperties')}}" class="form-control">
                                    @error('noOfProperties')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="onlineLeaseCollection" type="checkbox" id="onlineLeaseCollectionId">
                                    <label class="form-check-label" for="onlineLeaseCollection">Online Lease Collection?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="propertyListings" type="checkbox" id="propertyListingsId">
                                    <label class="form-check-label" for="propertyListings">Property Listings?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="reporting" type="checkbox" id="reportingId">
                                    <label class="form-check-label" for="reporting">Reporting?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="storage" type="checkbox" id="storageId">
                                    <label class="form-check-label" for="storage">Cloud storage?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="onlineLeaseApplication" type="checkbox" id="onlineLeaseApplicationId">
                                    <label class="form-check-label" for="onlineLeaseApplication">Online Lease Application?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="incomeExpenseTracking" type="checkbox" id="incomeExpenseTrackingId">
                                    <label class="form-check-label" for="incomeExpenseTracking">Income-Expense Tracking?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="bulkSms" type="checkbox" id="bulkSmsId">
                                    <label class="form-check-label" for="bulkSms">Bulk SMS?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="workOrder" type="checkbox" id="workOrderId">
                                    <label class="form-check-label" for="workOrder">Work Order?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="tenantPortal" type="checkbox" id="tenantPortalId">
                                    <label class="form-check-label" for="tenantPortal">Tenant Portal?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" name="vendorPortal" type="checkbox" id="vendorPortalId">
                                    <label class="form-check-label" for="vendorPortal">Vendor Portal?</label>
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
                <div class="card-header bg-custom text-white">List of Plans & Features</div>
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
                                                        <h5 class="modal-title" id="myModalLabel">Edit Plan Features</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('show-plan-features')}}" method="post" autocomplete="off">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-   group">
                                                                        <label for="">Subscription Plan</label>
                                                                        <select name="planId" id="plan" class="form-control">
                                                                            <option selected disabled>--Select plan--</option>
                                                                            @foreach($plans as $pla)
                                                                                <option value="{{$pla->id}}" {{$plan->id == $pla->id ? 'selected' : '' }}>{{$pla->plan_name ?? '' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('planId')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>
                                                                    <div class="form-group mt-2">
                                                                        <label for="">Number of Users <sup class="text-danger">*</sup></label>
                                                                        <input type="number" placeholder="Number of Users" name="noOfUsers" value="{{ $plan->getPlanFeaturesByPlanId($plan->id)->no_of_users ?? 0 }}" class="form-control">
                                                                        @error('noOfUsers')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>
                                                                    <div class="form-group mt-2">
                                                                        <label for="">Number of Properties <sup class="text-danger">*</sup></label>
                                                                        <input type="number" placeholder="Number of Properties" name="noOfProperties" value="{{ $plan->getPlanFeaturesByPlanId($plan->id)->no_of_properties ?? 0 }}" class="form-control">
                                                                        @error('noOfProperties')<i class="text-danger">{{$message}}</i>@enderror
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="onlineLeaseCollection" type="checkbox" {{ isset($plan->getPlanFeaturesByPlanId($plan->id)->online_lc) && $plan->getPlanFeaturesByPlanId($plan->id)->online_lc  == 1 ? 'checked' : '' }} id="onlineLeaseCollectionId">
                                                                        <label class="form-check-label" for="onlineLeaseCollection">Online Lease Collection?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="propertyListings" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->property_listings) && $plan->getPlanFeaturesByPlanId($plan->id)->property_listings == 1 ? 'checked' : '' }} type="checkbox" id="propertyListingsId">
                                                                        <label class="form-check-label" for="propertyListings">Property Listings?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->reporting) && $plan->getPlanFeaturesByPlanId($plan->id)->reporting == 1 ? 'checked' : '' }} name="reporting" type="checkbox" id="reportingId">
                                                                        <label class="form-check-label" for="reporting">Reporting?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->storage) && $plan->getPlanFeaturesByPlanId($plan->id)->storage == 1 ? 'checked' : '' }} name="storage" type="checkbox" id="storageId">
                                                                        <label class="form-check-label" for="storage">Cloud storage?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="onlineLeaseApplication" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->online_la) && $plan->getPlanFeaturesByPlanId($plan->id)->online_la == 1 ? 'checked' : '' }} type="checkbox" id="onlineLeaseApplicationId">
                                                                        <label class="form-check-label" for="onlineLeaseApplication">Online Lease Application?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="incomeExpenseTracking" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->income_ex_tracking) && $plan->getPlanFeaturesByPlanId($plan->id)->income_ex_tracking == 1 ? 'checked' : '' }} type="checkbox" id="incomeExpenseTrackingId">
                                                                        <label class="form-check-label" for="incomeExpenseTracking">Income-Expense Tracking?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="bulkSms" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->bulk_sms) && $plan->getPlanFeaturesByPlanId($plan->id)->bulk_sms == 1 ? 'checked' : '' }} type="checkbox" id="bulkSmsId">
                                                                        <label class="form-check-label" for="bulkSms">Bulk SMS?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="workOrder" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->work_order) && $plan->getPlanFeaturesByPlanId($plan->id)->work_order == 1 ? 'checked' : '' }} type="checkbox" id="workOrderId">
                                                                        <label class="form-check-label" for="workOrder">Work Order?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="tenantPortal" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->tenant_portal) && $plan->getPlanFeaturesByPlanId($plan->id)->tenant_portal == 1 ? 'checked' : '' }} type="checkbox" id="tenantPortalId">
                                                                        <label class="form-check-label" for="tenantPortal">Tenant Portal?</label>
                                                                    </div>
                                                                    <div class="form-check form-switch mt-3">
                                                                        <input class="form-check-input" name="vendorPortal" {{isset($plan->getPlanFeaturesByPlanId($plan->id)->vendor_portal) && $plan->getPlanFeaturesByPlanId($plan->id)->vendor_portal == 1 ? 'checked' : '' }} type="checkbox" id="vendorPortalId">
                                                                        <label class="form-check-label" for="vendorPortal">Vendor Portal?</label>
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
