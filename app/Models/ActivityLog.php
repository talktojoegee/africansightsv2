<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasFactory;

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    static public function logActivity($tenant, $userId, $type, $subject, $activity){
        $log = new ActivityLog();
        $log->tenant_id = $tenant;
        $log->user_id = $userId;
        $log->subject = $subject;
        $log->type = $type;
        $log->log = $activity;
        $log->save();
    }

    public function getTenantActivityLog($tenantId){
        return ActivityLog::where('tenant_id', $tenantId)->orderBy('id', 'DESC')->get();
    }
    public function getTenantRecentActivityLog($tenantId){
        return ActivityLog::where('tenant_id', $tenantId)->orderBy('id', 'DESC')->take(5)->get();
    }
    public function getTenantUserActivityLog($tenantId, $userId){
        return ActivityLog::where('tenant_id', $tenantId)->where('user_id', $userId)->orderBy('id', 'DESC')->get();
    }
    public function getAllActivityLog(){
        return ActivityLog::orderBy('id', 'DESC')->get();
    }

    public function getAllTenantAuditReportByDateRange(Request $request){
        return ActivityLog::where('tenant_id', Auth::user()->tenant_id)
            ->whereBetween('created_at', [$request->startDate, $request->endDate])->orderBy('id', 'DESC')->get();
    }
}
