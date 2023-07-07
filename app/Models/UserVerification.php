<?php

namespace App\Models;

use App\Models\Dump\LeaseApplication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserVerification extends Model
{
    use HasFactory;

    public function createNewUserToBeVerified(LeaseApplication $applicant,  $startDate, $endDate, $tenantSub, $listingId, $propertyId){
        $tobe = new UserVerification();
        $tobe->first_name = $applicant->first_name ?? '';
        $tobe->last_name = $applicant->last_name ?? '';
        $tobe->mobile_no = $applicant->mobile_no ?? '';
        $tobe->email = $applicant->email ?? '';
        $tobe->lease_app_id = $applicant->id ?? '';
        $tobe->listing_id = $listingId;
        $tobe->property_id = $propertyId;
        //$tobe->password = $request->password ?? '';
        //$tobe->password = bcrypt('password123');
        $tobe->uuid = Str::uuid();
        $tobe->slug = Str::random(11);
        $tobe->start_date = $startDate;
        $tobe->end_date = $endDate;
        $tobe->tenant_id = $applicant->tenant_id;
        $tobe->active_sub_key = $tenantSub;
        $tobe->save();
        return $tobe;
    }

    public function getUserToBeVerifiedBySlug($slug){
        return UserVerification::where('slug', $slug)->first();
    }

    public function verifyUser($userId, $status){
        $user = UserVerification::find($userId);
        $user->status = $status;
        $user->save();
    }

    public function getUserToBeVerifiedById($userId){
        return UserVerification::find($userId);
    }
}
