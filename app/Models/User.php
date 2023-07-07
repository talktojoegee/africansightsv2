<?php

namespace App\Models;

use App\Models\Dump\Bank;
use App\Models\Dump\BulkSmsAccount;
use App\Models\Dump\Invoice;
use App\Models\Dump\LeaseApplication;
use App\Models\Dump\OccupantPerson;
use App\Models\Dump\PhoneGroup;
use App\Models\Dump\Receipt;
use App\Models\Dump\SenderId;
use App\Models\Dump\Tenant;
use App\Models\Dump\TenantNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function getUserActivityLogs(){
        return $this->hasMany(ActivityLog::class, 'user_id')->orderBy('id', 'DESC');
    }




    public function checkFirstDigit($number){
        $digit = substr($number, 0,1);
        if($digit == '0'){
            return '0'; //first number starts with 0
        }elseif($digit == '+'){
            return '+';
        }else{
            return 's'; //some #
        }
    }

    public function appendCountryCode($number){
        $country_code = "234";
        $phone_no = "";
        $digit = $this->checkFirstDigit($number);
        $length = strlen($number);
        if($digit == '0'){
            #Remove the 0
            $stripped_phone = substr($number,1,$length - 1);
            $phone_no = $country_code.$stripped_phone;
            return $phone_no;
        }elseif( $digit == 's'){ //2348032404359, 08032889972, 7036005031, +2349023849871
            if(substr($number,0,3) == '234'){
                return $number;
            }else{
                return $country_code.$number;
            }
        }elseif($digit == '+'){
            return substr($number,1,$length-1);
        }
    }

    public function createUserAsTenant(LeaseApplication $applicant,  $startDate, $endDate, $tenantSub){
        $user = new User();
        $user->first_name = $applicant->first_name;
        $user->last_name = $applicant->surname;
        $user->mobile_no = $this->appendCountryCode($applicant->mobile_no);
        $user->username = Str::slug($applicant->first_name).'_'.Str::random(4);
        $user->email = $applicant->email;
        $user->is_admin = 2; //as residence | tenant | client role
        $user->password = bcrypt('password123');
        $user->uuid = Str::uuid();
        $user->api_token = Str::random(60);
        $user->start_date = $startDate;
        $user->end_date = $endDate;
        $user->tenant_id = $applicant->tenant_id;
        $user->active_sub_key = $tenantSub;
        $user->save();
        return $user;
    }

    public function createUser(Request $request, $tenant){
        $password = $request->password;
        $user = new User();
        $user->first_name = $request->firstName;
        $user->mobile_no = $this->appendCountryCode($request->phoneNumber);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->is_admin = 1; //manager role
        $user->password = bcrypt($password);
        $user->uuid = Str::uuid();
        $user->api_token = Str::random(60);
        $user->start_date = $tenant->start_date;
        $user->end_date = $tenant->end_date;
        $user->tenant_id = $tenant->id;
        $user->active_sub_key = $tenant->active_sub_key;
        $user->save();
        return $user;
    }

    public function activateTenantAccount(UserVerification $userV, Request $request){
        $password = $request->password;
        $user = new User();
        $user->first_name = $userV->first_name;
        $user->last_name = $userV->last_name;
        $user->mobile_no = $this->appendCountryCode($userV->mobile_no);
        $user->username = $request->username;
        $user->email = $userV->email;
        $user->is_admin = 2; //tenant role
        $user->password = bcrypt($password);
        $user->uuid = $userV->uuid;
        $user->api_token = Str::random(60);
        $user->start_date = $userV->start_date;
        $user->end_date = $userV->end_date;
        $user->tenant_id = $userV->tenant_id;
        $user->active_sub_key = $userV->active_sub_key;
        $user->save();
        return $user;
    }


    public function apiTokenGenerator(){
        $user = User::find(Auth::user()->id);
        $user->api_token = Str::random(60);
        $user->save();
    }

    public function getUserByUuid($uuid){
        return User::where('uuid', $uuid)->first();
    }
     public function getUserById($id){
        return User::find( $id);
    }

    public function updateUser(Request $request, $mobile){
        $user = User::find($request->id);
        $user->first_name = $request->firstName;
        $user->mobile_no = $request->phoneNumber;
        //$user->email = $request->email;
        //$user->password = bcrypt($request->password);
        $user->uuid = Str::uuid();
        $user->save();
        return $user;
    }

    public function editUser(Request $request){
        $user = User::find($request->userId);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->mobile_no = $request->mobileNo;
        //$user->email = $request->email;
        //$user->username = bcrypt($request->username);
        $user->save();
        return $user;
    }
    public function getUserByEmail($email){
        return User::where('email', $email)->first();
    }
    public function getUserByUsername($username){
        return User::where('username', $username)->first();
    }

    public function getTenantNotifications(){
        return $this->hasMany(TenantNotification::class, 'tenant_id');
    }
    public function getTenantBanks(){
        return $this->hasMany(Bank::class, 'tenant_id', 'tenant_id');
    }

    public function getToken($token){
        return User::select('api_token')->where('api_token', $token)->first();
    }
    public function getUserByUserType($type){
        return User::where('is_admin', $type)->orderBy('first_name', 'ASC')->get();
    }

    public function getTenantUserByUserType($type, $tenantId){
        return User::where('is_admin', $type)->where('tenant_id', $tenantId)->orderBy('first_name', 'ASC')->get();
    }
    public function getTenantUsers($tenantId){
        return User::where('tenant_id', $tenantId)->orderBy('first_name', 'ASC')->get();
    }

    public function getTenantUserByUserTypeById($type, $tenantId, $id){
        return User::where('is_admin', $type)->where('tenant_id', $tenantId)->where('id', $id)->orderBy('first_name', 'ASC')->first();
    }
    public function updateUserAccountStatus($user_id, $status, $key, $end_date){
        $user = User::find($user_id);
        $user->account_status = $status;
        $user->active_sub_key = $key;
        $user->start_date = now();
        $user->end_date = $end_date;
        $user->save();
    }
    public function setNewTeamMember(Request $request){
        $user = new User();
        $user->first_name = $request->first_name ;
        $user->surname = $request->last_name  ?? '';
        $user->mobile_no = $request->phone_no ?? '' ;
        $user->password = bcrypt('password123');
        $user->email = $request->email ?? '' ;
        $user->start_date = Auth::user()->start_date;
        $user->end_date = Auth::user()->end_date;
        $user->tenant_id = Auth::user()->tenant_id;
        $user->active_sub_key = Auth::user()->active_sub_key;
        $user->slug = Str::slug($request->first_name).'-'.substr(sha1(time()),32,40);
        $user->address = $request->address ?? '';
        $user->save();
    }

    public function updateAvatar(Request $request){
        if($request->hasFile('avatar'))
        {
            $extension = $request->avatar->getClientOriginalExtension();
            $filename = Str::random(11). '.' . $extension;
            $dir = 'assets/drive/avatar/';
            //$path = $request->file('avatar')->store('avatar', 's3');
            //$url = Storage::disk('s3')->url($path);
            //$filename = 'avatar/'.basename($path);
            $request->avatar->move(public_path($dir), $filename);
            $avatar = User::find(Auth::user()->id);
            $avatar->image = $filename;
            $avatar->save();
        }
    }



}
