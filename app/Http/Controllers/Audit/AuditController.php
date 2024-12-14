<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use carbon\Carbon;
use App\Models\Audit;
class AuditController extends Controller
{
    public function createAuditTrail($fullname, $client_id, $activity, $role){
        $activity_timestamp = Carbon::now('Asia/Manila');
        $activity_timestamp_philippines = $activity_timestamp->toDateTimeString();
        $save = Audit::insert([
            'fullname' => $fullname,
            'client_id' => $client_id,
            'activity' => $activity,
            'role' => $role,
            'created_at' => $activity_timestamp_philippines
        ]);
    }
}
